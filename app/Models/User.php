<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Cache;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'social_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'balance',
        'password',
        'experience',
        'profile_pic',
        'banner',
        'rating',
        'headline',
        'current_position',
        'education',
        'country',
        'city',
        'industry',
        'sub_industry',
        'work_location',
        'job_title',
        'employee_type_id',
        'recent_company',
        'is_student',
        'otp',
        'session_price',
        'stripe_customer_id',
        'industry_type_id',
        'is_active_job_title',
        'show_company_name',
        'job_type_id',
        'company_id'
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string)Str::uuid();
        });
    }

    public function getKeyType()
    {
        return 'string';
    }

    public $incrementing = false;


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id' => 'string'
    ];

    public function setPasswordAttribute($value){
        $pswd       = Hash::make($value);
        $this->attributes['password'] = $pswd;
    }

    public function posts()
    {
        return $this->hasMany(Posts::class, 'user_id');
    }

    public function experience()
    {
        return $this->hasMany(Experience::class, 'user_id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'user_id', 'id');
    }

    public function pagesfollow()
    {
        return $this->belongsToMany(Page::class, 'page_followers');
    }

    public function apply()
    {
        return $this->belongsToMany(Posts::class, 'job_applicants', 'applicant_id', 'job_id');
    }

    public function consultation()
    {
        return $this->belongsToMany(User::class, 'consultations', 'consult_from', 'consult_with')
            ->withPivot('consult_type', 'desc', 'attachment', 'date', 'time', 'is_accepted', 'meeting_id', 'session_price', 'skilled_talk_percentage', 'actual_payment_earned')
            ->withTimestamps();
    }

    public function makeFriend()
    {
        return $this->belongsToMany(User::class, 'friends', 'request_from', 'request_to')
            ->withPivot('is_accepted')
            ->withTimestamps();
    }

    public function skills(){
        return $this->hasMany(Skill::class, 'user_id', 'id');
    }

    public function notifications(){
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }

    public function subscription()
    {
        return $this->belongsToMany(Subscription::class, 'user_subscriptions', 'user_id', 'subscription_id')
            ->withTimestamps()
            ->withPivot('id', 'valid_till');
    }

    public function getSubscription()
    {
        $user = User::with('subscription')->findOrFail(auth()->id());
//        dd($user);
        $subsctiptions = $user->subscription;
        $subscription = '';
        if ($subsctiptions) {

            foreach ($subsctiptions as $sub) {
                $packageDate = Carbon::parse($sub->pivot->valid_till);
                $is_expired = Carbon::now()->gt($packageDate);
                if (!$is_expired) {
                    $subscription = $sub;
                    break;
                }
            }
        }
        return $subscription;
    }
    public function savePost(){
        return $this->belongsToMany(Posts::class,'user_save_posts','user_id','post_id','id');
    }

    public function withdrawals(){
        return $this->hasMany(Withdrawal::class, 'user_id', 'id');
    }

    public function UserEbanks(){
        return $this->hasMany(UserEbank::class, 'user_id', 'id');
    }

    public function isOnline(){
        return Cache::has("user-is-online-".$this->id);
    }

    public function industry()
    {
        return $this->hasOne(IndustryTypes::class);
    }

    public function job()
    {
        return $this->hasOne(JobTypes::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

}
