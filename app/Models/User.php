<?php

namespace App\Models;

use App\Models\Role;
use Spatie\MediaLibrary\HasMedia;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }
}
