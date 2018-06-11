<?php

    namespace App;

    use App\Helpers\HasEncryptedAttributes;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;

    /**
 * Class IntroApplication
 *
 * @package App
 * @property int                 $id
 * @property string|null         $pcn
 * @property string              $first_name
 * @property string              $last_name
 * @property string              $phone
 * @property string              $email
 * @property \Carbon\Carbon      $birthday
 * @property string              $shirt_size
 * @property string              $remarks
 * @property bool                $alcohol
 * @property int                 $extra_shirt
 * @property int                 $same_sex_rooms
 * @property string              $status
 * @property string              $ip_address
 * @property string|null         $email_confirmation_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static Builder|IntroApplication whereAlcohol($value)
 * @method static Builder|IntroApplication whereBirthday($value)
 * @method static Builder|IntroApplication whereCreatedAt($value)
 * @method static Builder|IntroApplication whereEmail($value)
 * @method static Builder|IntroApplication whereEmailConfirmationToken($value)
 * @method static Builder|IntroApplication whereExtraShirt($value)
 * @method static Builder|IntroApplication whereFirstName($value)
 * @method static Builder|IntroApplication whereId($value)
 * @method static Builder|IntroApplication whereIpAddress($value)
 * @method static Builder|IntroApplication whereLastName($value)
 * @method static Builder|IntroApplication wherePcn($value)
 * @method static Builder|IntroApplication wherePhone($value)
 * @method static Builder|IntroApplication whereRemarks($value)
 * @method static Builder|IntroApplication whereSameSexRooms($value)
 * @method static Builder|IntroApplication whereShirtSize($value)
 * @method static Builder|IntroApplication whereStatus($value)
 * @method static Builder|IntroApplication whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string              $transaction_id
 * @property string              $transaction_status
 * @property float               $transaction_amount
 * @method static Builder|IntroApplication whereTransactionAmount($value)
 * @method static Builder|IntroApplication whereTransactionId($value)
 * @method static Builder|IntroApplication whereTransactionStatus($value)
 * @property string              $contact_phone
 * @property string              $gender
 * @property string              $address
 * @property string              $city
 * @property string              $postal
 * @method static Builder|IntroApplication whereAddress($value)
 * @method static Builder|IntroApplication whereCity($value)
 * @method static Builder|IntroApplication whereContactPhone($value)
 * @method static Builder|IntroApplication whereGender($value)
 * @method static Builder|IntroApplication wherePostal($value)
 */
    class IntroApplication extends Model {
        use HasEncryptedAttributes;
        const STATUS_APPROVED = 'approved', STATUS_ON_HOLD = 'on_hold',
            STATUS_NEW = 'new', STATUS_DENIED = 'denied',
            STATUS_UNDER_REVIEW = 'under_review', STATUS_BLOCKED = 'blocked',
            STATUS_EMAIL_UNCONFIRMED = 'email_unconfirmed';
        public $fillable = ['pcn', 'first_name', 'last_name', 'phone', 'email', 'address', 'city', 'postal', 'gender', 'contact_phone',
                            'birthday', 'shirt_size', 'remarks', 'alcohol', 'extra_shirt', 'same_sex_rooms'];
        protected $encrypted = ['pcn', 'first_name', 'last_name', 'phone', 'email', 'shirt_size', 'remarks', 'ip_address',
                                'contact_phone', 'address', 'city', 'postal', 'gender', 'contact_phone'];
        protected $attributes = [
            'status' => self::STATUS_EMAIL_UNCONFIRMED
        ];
        protected $casts = [
            'birthday'       => 'date',
            'alcohol'        => 'boolean',
            'extra_shirt'    => 'boolean',
            'same_sex_rooms' => 'boolean',
        ];
        protected $dates = [
            'birthday'
        ];

        /**
         * Create a new Eloquent model instance.
         *
         * @param  array $attributes
         *
         * @return void
         */
        public function __construct(array $attributes = []) {
            $this->transaction_id = strtoupper(str_random(5));
            parent::__construct($attributes);
        }

        /**
         * @param $birthday
         *
         * @return \Carbon\Carbon
         */
        public function setBirthdayAttribute($birthday) {
            try {
                return $this->attributes['birthday'] = Carbon::createFromTimestamp(strtotime($birthday));

            } catch (\InvalidArgumentException $exception) {
                return $this->attributes['birthday'] = null;
            }
        }

        /**
         * @return int
         */
        public function calculateIntroCosts() {
            $intro = 15;
            $costs = $intro;
            if ($this->extra_shirt) $costs += 9;

            return $costs;
        }

        /**
         * Save the model to the database.
         *
         * @param  array $options
         *
         * @return bool
         */
        public function save(array $options = []) {
            return parent::save($options);
        }


    }