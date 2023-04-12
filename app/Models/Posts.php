<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_id',
        'page_id',
        'group_id',
        'post_type_id',
        'post_privacy_id',
        'heading',
        'description',
        'hashtags',
        'is_edited',
        'view_count'
    ];


     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getKeyType()
    {
        return 'string';
    }

    public $incrementing = false;


    ///Relations///

    public function postType(){
        return $this->belongsTo(PostType::class, 'post_type_id');
    }

    public function postPrivacy(){
        return $this->belongsTo(PostPrivacy::class, 'post_privacy_id');
    }

    public function postMedia(){
        return $this->hasMany(PostMedia::class, 'post_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reflections(){
        return $this->hasMany(Reflection::class, 'post_id');
    }

    public function rate(){
        return $this->hasMany(Rate::class, 'post_id');
    }

    public function jobs(){
        return $this->hasOne(PostJobs::class, 'post_id', 'id');
    }

    public function shared(){
        return $this->belongsTo(self::class, 'post_id', 'id');
    }

    public function postShared(){
        return $this->hasMany(self::class, 'post_id', 'id');
    }

    public function applicants(){
        return $this->belongsToMany(User::class, 'job_applicants', 'job_id', 'applicant_id');
    }

    public function group(){
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }

    public function userApplicant(){
        return $this->belongsToMany(User::class, 'job_applicants', 'job_id', 'applicant_id')
        ->withTimestamps()->withPivot('applicant_id', 'job_id')->where('applicant_id', auth()->id());
    }
    

}
