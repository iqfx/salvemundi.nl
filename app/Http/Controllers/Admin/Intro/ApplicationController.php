<?php

    namespace App\Http\Controllers\Admin\Intro;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\Intro\UpdateApplication;
    use App\IntroApplication;
    use App\Introduction;
    use App\Mail\ConfirmIntroApplication;
    use App\Mail\IntroApplicationPaymentRequest;
    use Exception;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\View\View;
    use Psr\SimpleCache\InvalidArgumentException;
    use Throwable;

    /**
     * Class ApplicationController
     *
     * @package App\Http\Controllers\Admin\Intro
     */
    class ApplicationController extends Controller {


        public function __construct() {
            $this->middleware('permission:view introduction signups');
            $this->middleware('permission:edit introduction signups')->only(['create', 'store', 'edit', 'update', 'sendEmailConfirmationReminder', 'sendPaymentReminder']);
            $this->middleware('permission:delete introduction signups')->only(['destroy', 'getDeleteConfirmation']);
        }

        /**
         * @param Introduction $intro
         *
         * @return Factory|View
         */
        public function index(Introduction $intro) {
            return redirect()->route('admin.intro.show', [$intro]);
        }

        /**
         * Show the form for creating a new resource.
         *
         */
        public static function create() {
            abort(501);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  Request         $request
         * @param Introduction     $intro
         * @param IntroApplication $application
         */
        public static function store(Request $request, Introduction $intro, IntroApplication $application) {
            abort(501);
        }

        /**
         * @param Introduction     $intro
         *
         * @param IntroApplication $aanmeldingen
         *
         * @return Factory|View
         */
        public static function show(Introduction $intro, IntroApplication $aanmeldingen) {
            return view('admin.intro.applications.show', [
                'application'  => $aanmeldingen,
                'introduction' => $intro
            ]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param Introduction     $intro
         * @param IntroApplication $aanmeldingen
         *
         * @return Factory|View
         */
        public static function edit(Introduction $intro, IntroApplication $aanmeldingen) {
            if ($aanmeldingen->isAnonymised()) return back();
            return view('admin.intro.applications.edit', [
                'application'  => $aanmeldingen,
                'introduction' => $intro
            ]);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param Introduction      $intro
         * @param IntroApplication  $aanmeldingen
         * @param UpdateApplication $request
         *
         * @return RedirectResponse
         */
        public static function update(Introduction $intro, IntroApplication $aanmeldingen, UpdateApplication $request) {
            if($aanmeldingen->isAnonymised()) return back();
            $aanmeldingen->update($request->all());
            return back()->with('success', trans('admin.intro.applications.edit.success'));
        }

        /**
         * @param Introduction     $intro
         * @param IntroApplication $application
         * @param Request          $request
         *
         * @return RedirectResponse
         * @throws InvalidArgumentException
         */
        public function sendEmailConfirmationReminder(Introduction $intro, IntroApplication $application, Request $request) {
            if ($application->isAnonymised()) abort(400);
            $key = 'admin.intro.throttle.email_reminder:' . $application->id;
            if (Cache::has($key)) {
                return back()->withErrors(['mail' => trans('admin.intro.applications.reminder_throttle')]);
            }
            $mail = new ConfirmIntroApplication($application);
            $mail->to($application->email, $application->first_name . ' ' . $application->last_name);
            Mail::queue($mail);
            Cache::set($key, time(), 10080);
            return back()->with('success', trans('admin.intro.applications.email_confirmation_reminder_sent'));
        }


        /**
         * @param Introduction     $intro
         * @param IntroApplication $application
         * @param Request          $request
         *
         * @return RedirectResponse
         * @throws InvalidArgumentException
         * @throws Throwable
         */
        public function sendPaymentReminder(Introduction $intro, IntroApplication $application, Request $request) {
            if ($application->isAnonymised()) abort(400);
            $key = 'admin.intro.throttle.payment_reminder:' . $application->id;
            if (Cache::has($key)) {
                return back()->withErrors(['mail' => trans('admin.intro.applications.reminder_throttle')]);
            }
            $mail = new IntroApplicationPaymentRequest($application);
            if ($application->email_confirmation_token === null) {
                $application->email_confirmation_token = str_random(64);
                $application->saveOrFail();
            } else {
                $mail->subject(trans('email.intro.payment_request_reminder.subject', ['name' => $application->first_name . ' ' . $application->last_name]));
            }
            $mail->to($application->email, $application->first_name . ' ' . $application->last_name);
            Mail::queue($mail);
            Cache::set($key, time(), 10080);
            return back()->with('success', trans('admin.intro.applications.payment_reminder_sent'));
        }

        /**
         * @param Introduction     $intro
         * @param IntroApplication $application
         *
         * @return RedirectResponse
         */
        public function getDeleteConfirmation(Introduction $intro, IntroApplication $application) {
            if ($application->isAnonymised() ||
                ($application->status != IntroApplication::STATUS_PAID &&
                    $application->status != IntroApplication::STATUS_SEE_TRANSACTION)) {
                return view('admin.intro.applications.delete', [
                    'application'  => $application,
                    'introduction' => $intro
                ]);
            }
            return back();

        }


        /**
         * @param Introduction $intro
         *
         * @return Factory|View
         */
        public function spreadsheet(Introduction $intro) {
            return view('admin.intro.applications.spreadsheet', [
                'introduction'            => $intro,
                'confirmed_count'         => $intro->applications()->where('status', '=', IntroApplication::STATUS_PAID)->count(),
                'reservations_count'      => $intro->applications()->where('status', '=', IntroApplication::STATUS_RESERVED)->count(),
                'email_unconfirmed_count' => $intro->applications()->where('status', '=', IntroApplication::STATUS_EMAIL_UNCONFIRMED)->count()
            ]);
        }

        /**
         * @param Introduction     $intro
         *
         * @param IntroApplication $aanmeldingen
         *
         * @return RedirectResponse
         * @throws Exception
         */
        public function destroy(Introduction $intro, IntroApplication $aanmeldingen) {
            if ($aanmeldingen->isAnonymised() ||
                ($aanmeldingen->status != IntroApplication::STATUS_PAID ||
                    $aanmeldingen->status != IntroApplication::STATUS_SEE_TRANSACTION)) {
                $aanmeldingen->delete();
                return redirect()->route('admin.intro.show', ['intro' => $intro])->with('success', trans('admin.intro.applications.delete.deleted'));
            }
            return back();
        }
    }
