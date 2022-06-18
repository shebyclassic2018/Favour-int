<?php

namespace App\Models;

use App\Models\Roots\Role;
use App\Models\Peoples\Logs;
use App\Models\Mophs\Likable;
use App\Models\Peoples\Agent;
use App\Models\Services\Cart;
use App\Models\Peoples\Account;
use App\Models\Mophs\Contactable;
use Spatie\MediaLibrary\HasMedia;
use Laravel\Passport\HasApiTokens;
use App\Models\Peoples\Appointment;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['role_id', 'name', 'email','phone', 'password'];
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password','remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
        ->singleFile()
        ->useFallbackUrl(config('app.placeholder') . '160.png')
        ->useFallbackPath(config('app.placeholder') . '160.png')
        ->$this->registerMediaCollections(function (Media $media) {
            try {
                $this->addMediaConversion('thumb')
                    ->width(160)
                    ->height(160);
            } catch (\Exception $e) {
            }
        });
    }


    # TYPICAL RELATIONSHIPS
    ## BELONG
    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    ## HAS
    ### ONE TO ONE
    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function agent()
    {
        return $this->hasOne(Agent::class);
    }


    ### ONE TO MANY
    public function logs()
    {
        return $this->hasMany(Logs::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }






    # MOPHIC RELATIONSHIPS
    ## ONE
    public function contactable()
    {
        return $this->morphOne(Contactable::class, 'contactable');
    }

    ## MANY
    public function likers()
    {
        return $this->morphMany(Likable::class, 'liker');
    }


    # HELPER FRUCTIONS
    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }
}
