<?php

    namespace App\Http\Controllers\Member;

    use App\Helpers\PaymentHelper;
    use App\Http\Controllers\Controller;
    use App\Mail\MembershipRenewPaymentConfirmation;
    use App\Member;
    use App\Membership;
    use App\Transaction;
    use App\Year;
    use Carbon\Carbon;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\View\View;
    use Mollie\Api\Exceptions\ApiException;
    use Mollie\Api\Exceptions\IncompatiblePlatform;
    use Throwable;

    /**
     * Class MembershipController
     *
     * @package App\Http\Controllers\Member
     */
    class MembershipController extends Controller {
        /**
         * @return RedirectResponse
         * @throws ApiException
         * @throws IncompatiblePlatform
         */
        public function renew() {
            $user   = Auth::user();
            $member = $user->member;

            if ($member->isCurrentlyMember()) {
                return back(302, [], route('member.about_me'))->withErrors(['renew_membership' => trans('member.membership.renew.already_renewed')]);
            }

            //            dd($member);
            $transaction = new Transaction();
            $transaction->save();

            $mollie  = new PaymentHelper();
            $payment = $mollie->payments->create([
                "amount"      => [
                    'currency' => 'EUR',
                    'value'    => config('mollie.renew_costs')
                ],
                "description" => trans('member.membership.payment.description', ['first_name' => $member->first_name, 'last_name' => $member->last_name]),
                "redirectUrl" => route('member.membership.confirm_payment', ['transaction' => $transaction]),
                "webhookUrl"  => route('webhook.payment.renew_membership', ['member' => $member]),
                'metadata'    => [
                    'member_id'      => $member->id,
                    'transaction_id' => $transaction->id
                ]
            ]);
            $transaction->update([
                'member_id'          => $member->id,
                'transaction_id'     => $payment->id,
                'transaction_status' => $payment->status,
                'transaction_amount' => $payment->amount->value
            ]);
            return view('member.membership.payment_redirect', [
                'links' => $payment->_links
            ]);
        }

        /**
         * @param Transaction $transaction
         *
         * @return Factory|RedirectResponse|View
         * @throws ApiException
         * @throws IncompatiblePlatform
         */
        public function confirmPayment(Transaction $transaction) {
            $user   = Auth::user();
            $member = $user->member;

            $payment = $transaction->getMollieTransaction();
            if ($payment->metadata->member_id != $member->id) {
                abort(404);
            }
            \Log::debug('Teruggestuurd van de betaling', ['payment' => $payment]);
            if (!$payment->isOpen() && !$payment->isPaid()) {
                return redirect()->route('member.about_me')->withErrors(['renew_membership' => trans('member.membership.payment.failed')]);
            }
            return view('member.membership.payment_confirmation', [

            ]);
        }

        /**
         * @param Member  $member
         * @param Request $request
         *
         * @return string
         * @throws Throwable
         */
        public function confirmPaymentWebhook(Member $member, Request $request) {

            if (!$request->has('id')) abort(400);

            $mollie = new PaymentHelper();
            try {
                $payment = $mollie->payments->get($request->get('id'));
                if ($payment->metadata->member_id != $member->id) {
                    abort(400);
                }
                \Log::debug('Webhook aangeroepen', ['payment' => $payment]);

                /** @var Transaction $transaction */
                $transaction = Transaction::findOrFail($payment->metadata->transaction_id);
                $transaction->update([
                    'transaction_id'     => $payment->id,
                    'transaction_status' => $payment->hasRefunds() ? 'refunded' : $payment->status,
                    'transaction_amount' => $payment->amount->value
                ]);

                if ($payment->isPaid() && !$payment->hasRefunds()) {
                    if (!$member->isCurrentlyMember()) {
                        // Stuur een bevestiging naar de administratie
                        //                        $mail = new NewMemberApplication($application);
                        //                        $mail->to(config('mail.application_to.address'), config('mail.application_to.name'));

                        //                        Mail::queue($mail);

                        $membership                 = Membership::createNewMembership();
                        $membership->year_id        = Year::getCurrentYear()->id;
                        $membership->transaction_id = $transaction->id;
                        $membership                 = $member->memberships()->save($membership);

                        // Stuur een bevestiging naar de gebruiker zelf
                        $mail = new MembershipRenewPaymentConfirmation($member, $membership);
                        $mail->to($member->email, $member->first_name . ' ' . $member->last_name);
                        Mail::queue($mail);

                        Log::debug("Lidmaatschap verlengd", [$member, $membership]);
                    }
                } else {
                    if ($payment->hasRefunds()) {
                        // Lidmaatschap stopzetten
                        /** @var Membership $membership */
                        $membership              = $member->memberships()->where('transaction_id', $transaction->id)->firstOrFail();
                        $membership->valid_until = Carbon::today();
                        $membership->saveOrFail();
                    }
                    if ($payment->isCanceled() || $payment->isExpired() || $payment->isFailed() || (!$payment->isPaid() && !$payment->isOpen())) {
                        Log::debug('De betaling is geannuleerd of is verlopen en het lidmaatschap zal niet worden verlengd', ['payment' => $payment]);
                    }
                }

            } catch (ApiException $exception) {
                Log::error($exception);
                abort(400);
            }
            return 'OK';
        }


    }
