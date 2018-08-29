<?php

    namespace App\Http\Controllers\Member;

    use App\Http\Controllers\Controller;
    use App\Membership;
    use Illuminate\Support\Facades\Auth;
    use Intervention\Image\Constraint;

    /**
     * Class IndexController
     *
     * @package App\Http\Controllers\Member
     */
    class IndexController extends Controller {


        /**
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function getAboutView() {
            $user = Auth::user();
            return view('member.index', [
                'user'       => $user,
                'member'     => $user->member,
                'year_from'  => Membership::calculateFiscalYearStart(),
                'year_until' => Membership::calculateFiscalYearEnd()
            ]);
        }

        /**
         * @return mixed
         */
        public function getOwnPhoto() {
            $member = Auth::user()->member;
            return $member->getImageObject()->resize(400, null, function (Constraint $constraint) {
                $constraint->aspectRatio();
            })->response();
        }

    }
