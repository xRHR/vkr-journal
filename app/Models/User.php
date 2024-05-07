<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'patronymic',
        'email',
        'password',
        'status_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function icon() {
        if ($this->status->title == "Студент") {
            return "fa-solid fa-user-graduate";
        }
        if ($this->status->title == "Научный руководитель") {
            return "fa-solid fa-user-tie";
        }
        if ($this->status->title == "Администратор") {
            return "fa-solid fa-user-shield";
        } else {
            return "fa-solid fa-user";
        }

    }
    public function fullname() {
        return $this->lastname . ' ' . $this->firstname . ' ' . $this->patronymic;
    }
    public function fullnameShort() {
        return $this->lastname . ' ' . mb_substr($this->firstname, 0, 1) . '.' . mb_substr($this->patronymic, 0, 1) . '.';
    }
    public function status() {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function miscInfo() {
        return $this->hasOne(UserMiscInfo::class, 'user_id');
    }

    public function professor() {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function students() {
        return $this->hasMany(User::class, 'professor_id');
    }
    public function plans() {
        return $this->hasMany(Plan::class,'owner_id');
    }
    public function plan() {
        return $this->belongsTo(Plan::class,'plan_id');
    }
}
