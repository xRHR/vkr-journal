<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'status_id',
        'professor_id',
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

    public function icon()
    {
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
    public function fullname()
    {
        return $this->lastname . ' ' . $this->firstname . ' ' . $this->patronymic;
    }
    public function fullnameGenitive()
    {
        return $this->miscInfo->lastname_genitive . ' ' . $this->miscInfo->firstname_genitive . ' ' . $this->miscInfo->patronymic_genitive;
    }
    
    public function fullnameShort()
    {
        return $this->lastname . ' ' . mb_substr($this->firstname, 0, 1) . '.' . mb_substr($this->patronymic, 0, 1) . '.';
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function miscInfo()
    {
        return $this->hasOne(UserMiscInfo::class, 'user_id');
    }
    public function group()
    {
        return $this->miscInfo->group();
    }

    public function specialty()
    {
        return $this->group->specialty();
    }

    public function department()
    {
        return $this->specialty->department();
    }

    public function faculty()
    {
        return $this->department->faculty();
    }

    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function students()
    {
        return $this->hasMany(User::class, 'professor_id');
    }
    public function plans()
    {
        return $this->hasMany(Plan::class, 'owner_id')->where('is_deleted', 0);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
    public function planProgresses()
    {
        return $this->hasMany(PlanProgress::class, 'user_id')
            ->join('plan_items', 'plan_progress.plan_item_id', '=', 'plan_items.id')
            ->orderBy('plan_items.deadline', 'asc')
            ->select('plan_progress.*'); // Include select to avoid ambiguity in the future
    }
    public function progressPercentage()
    {
        return (int) ($this->planProgresses()->where('done_at', '!=', null)->count() / $this->planProgresses()->count() * 100);
    }
    public function progressConfirmedPercentage()
    {
        return (int) ($this->planProgresses()->where('confirmed', 1)->count() / $this->planProgresses()->count() * 100);
    }
    public function theses()
    {
        return $this->hasMany(Thesis::class, 'student_id')->where('is_deleted', 0);
    }

}
