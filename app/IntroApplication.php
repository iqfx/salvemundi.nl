<?php

    namespace App;

    use App\Helpers\HasEncryptedAttributes;
    use Carbon\Carbon;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use InvalidArgumentException;
    use Throwable;

    /**
     * Class IntroApplication
     *
     * @package App
     * @property int                    $id
     * @property string|null            $pcn
     * @property string                 $first_name
     * @property string                 $last_name
     * @property string                 $phone
     * @property string                 $email
     * @property Carbon                 $birthday
     * @property string                 $shirt_size
     * @property string                 $remarks
     * @property bool                   $alcohol
     * @property int                    $extra_shirt
     * @property int                    $same_sex_rooms
     * @property string                 $status
     * @property string                 $ip_address
     * @property string|null            $email_confirmation_token
     * @property Carbon|null            $created_at
     * @property Carbon|null            $updated_at
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
     * @mixin Eloquent
     * @method static Builder|IntroApplication whereTransactionAmount($value)
     * @method static Builder|IntroApplication whereTransactionId($value)
     * @method static Builder|IntroApplication whereTransactionStatus($value)
     * @property string                 $contact_phone
     * @property string                 $gender
     * @property string                 $address
     * @property string                 $city
     * @property string                 $postal
     * @method static Builder|IntroApplication whereAddress($value)
     * @method static Builder|IntroApplication whereCity($value)
     * @method static Builder|IntroApplication whereContactPhone($value)
     * @method static Builder|IntroApplication whereGender($value)
     * @method static Builder|IntroApplication wherePostal($value)
     * @method static Builder|IntroApplication newModelQuery()
     * @method static Builder|IntroApplication newQuery()
     * @method static Builder|IntroApplication query()
     * @property int|null               $introduction_id
     * @property string                 $type
     * @method static Builder|IntroApplication whereIntroductionId($value)
     * @method static Builder|IntroApplication whereType($value)
     * @property string|null            $country
     * @property-read Introduction|null $introduction
     * @property-read Transaction       $transaction
     * @method static Builder|IntroApplication whereCountry($value)
     * @property int|null               $transaction_id
     * @property string                 $contact_name
     * @property string                 $contact_relation
     * @method static Builder|IntroApplication whereContactName($value)
     * @method static Builder|IntroApplication whereContactRelation($value)
     * @property string|null            $allergies
     * @property string|null            $medication
     * @property string|null            $diet_preferences
     * @method static Builder|IntroApplication whereAllergies($value)
     * @method static Builder|IntroApplication whereDietPreferences($value)
     * @method static Builder|IntroApplication whereMedication($value)
     */
    class IntroApplication extends Model {
        use HasEncryptedAttributes;
        const STATUS_PAID = 'paid', STATUS_SEE_TRANSACTION = 'see_transaction',
            STATUS_RESERVED = 'reserved', STATUS_REFUNDED = 'refunded',
            STATUS_EMAIL_UNCONFIRMED = 'email_unconfirmed';
        const TYPE_RESERVATION = 'reservation', TYPE_SIGNUP = 'signup', TYPE_ANONYMISED = 'anonymised';
        public $fillable = [
            'pcn', 'first_name', 'last_name', 'phone', 'email', 'address', 'city', 'postal',
            'country', 'gender', 'contact_phone', 'birthday', 'shirt_size', 'remarks',
            'alcohol', 'extra_shirt', 'same_sex_rooms', 'contact_name', 'contact_relation',
            'allergies', 'medication', 'diet_preferences'
        ];
        protected $encrypted = [
            'pcn', 'first_name', 'last_name', 'phone', 'email', 'shirt_size', 'remarks', 'ip_address',
            'contact_phone', 'address', 'city', 'postal', 'country',
            'gender', 'contact_phone', 'contact_name', 'contact_relation',
            'allergies', 'medication', 'diet_preferences'
        ];
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
         * @param array $attributes
         *
         * @return void
         */
        public function __construct(array $attributes = []) {
            parent::__construct($attributes);
        }


        /**
         * @return bool
         */
        public function isPaid() {
            return $this->status === self::STATUS_PAID;
        }

        /**
         * @param $birthday
         *
         * @return Carbon
         */
        public function setBirthdayAttribute($birthday) {
            try {
                return $this->attributes['birthday'] = Carbon::createFromTimestamp(strtotime($birthday));
            } catch (InvalidArgumentException $exception) {
                return $this->attributes['birthday'] = null;
            }
        }

        /**
         * @return int
         * @todo Fix function (baseer op Introduction::class)
         */
        public function calculateIntroCosts() {
            //            $intro    = 60;
            //            $security = 20;
            //            $costs    = $intro + $security;
            //            if ($this->extra_shirt) $costs += 9;

            return $this->introduction->price;
        }

        /**
         * @return BelongsTo
         */
        public function transaction() {
            return $this->belongsTo(Transaction::class);
        }

        /**
         * @return BelongsTo
         */
        public function introduction() {
            return $this->belongsTo(Introduction::class);
        }

        /**
         * Save the model to the database.
         *
         * @param array $options
         *
         * @return bool
         */
        public function save(array $options = []) {
            return parent::save($options);
        }

        /**
         * @throws Throwable
         */
        public function anonymise() {
            $this->email_confirmation_token = null;
            $this->pcn                      = null;
            $this->type                     = self::TYPE_ANONYMISED;
            $anonymiseFields                = [
                'first_name', 'last_name', 'phone', 'email', 'birthday', 'remarks',
                'ip_address', 'contact_phone', 'address', 'postal',
                'contact_name', 'contact_relation'
            ];
            foreach ($anonymiseFields as $field) {
                $this[$field] = '***';
            }
            return $this->saveOrFail();
        }

        /**
         * @return bool
         */
        public function isAnonymised() {
            return $this->type === self::TYPE_ANONYMISED;
        }

        /**
         * @param bool $personal
         *
         * @return array
         */
        public function getJSON($personal = true) {
            $return = [
                'id'                 => $this->id,
                'status'             => $this->status,
                'display_status'     => trans('admin.intro.applications.status_' . $this->status),
                'transaction'        => $this->transaction ? [
                    'id'             => $this->transaction->id,
                    'url'            => config('mollie.transaction_url') . $this->transaction->transaction_id,
                    'transaction_id' => $this->transaction->transaction_id,
                    'status'         => $this->transaction->transaction_status,
                    'display_status' => trans('admin.transactions.status.' . $this->transaction->transaction_status),
                ] : null,
                'created_at'         => $this->created_at,
                'display_created_at' => $this->created_at->format(trans('datetime.format.date_and_time')),
                'link'               => route('admin.intro.applications.show', ['intro' => $this->introduction, 'application' => $this])
            ];
            if ($personal) {
                $return['last_name']  = $this->last_name;
                $return['first_name'] = $this->first_name;
            }
            return $return;
        }
    }
