<?php

    namespace App;

    use App\Helpers\HasEncryptedAttributes;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;

    /**
     * App\CampingApplication
     *
     * @property int                 $id
     * @property string              $pcn
     * @property string              $first_name
     * @property string              $last_name
     * @property string              $phone
     * @property string              $email
     * @property string              $status
     * @property string              $ip_address
     * @property string              $application_hash
     * @property string|null         $email_confirmation_token
     * @property \Carbon\Carbon|null $created_at
     * @property \Carbon\Carbon|null $updated_at
     * @method static Builder|CampingApplication whereApplicationHash($value)
     * @method static Builder|CampingApplication whereCreatedAt($value)
     * @method static Builder|CampingApplication whereEmail($value)
     * @method static Builder|CampingApplication whereEmailConfirmationToken($value)
     * @method static Builder|CampingApplication whereFirstName($value)
     * @method static Builder|CampingApplication whereId($value)
     * @method static Builder|CampingApplication whereIpAddress($value)
     * @method static Builder|CampingApplication whereLastName($value)
     * @method static Builder|CampingApplication wherePcn($value)
     * @method static Builder|CampingApplication wherePhone($value)
     * @method static Builder|CampingApplication whereStatus($value)
     * @method static Builder|CampingApplication whereUpdatedAt($value)
     * @mixin \Eloquent
     */
    class CampingApplication extends Model {
        use HasEncryptedAttributes;
        protected $encrypted = ['pcn', 'first_name', 'last_name', 'phone', 'email', 'ip_address'];
        const STATUS_APPROVED = 'approved', STATUS_ON_HOLD = 'on_hold',
            STATUS_NEW = 'new', STATUS_DENIED = 'denied',
            STATUS_UNDER_REVIEW = 'under_review', STATUS_BLOCKED = 'blocked',
            STATUS_EMAIL_UNCONFIRMED = 'email_unconfirmed';

        public $fillable = ['pcn', 'first_name', 'last_name', 'phone', 'email'];
        protected $attributes = [
            'status' => self::STATUS_EMAIL_UNCONFIRMED
        ];
        /**
         * @return string
         */
        public function getApplicationHash() {
            return sha1($this->pcn);
        }

        /**
         * Save the model to the database.
         *
         * @param  array $options
         *
         * @return bool
         */
        public function save(array $options = []) {
            $this->application_hash = $this->getApplicationHash();
            return parent::save($options);
        }

    }
