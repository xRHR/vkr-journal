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
    public function planProgress() {
        return $this->hasMany(PlanProgress::class,'user_id');
    }
    public function updatePlanProgress() {
        $plan_items_ids = $this->plan->items->pluck('id')->toArray();
        $plan_progress_plan_item_ids = $this->planProgress()->pluck('plan_item_id')->toArray();
        $items_that_still_exist = array_intersect($plan_items_ids, $plan_progress_plan_item_ids);
        $items_that_are_new = array_diff($plan_items_ids, $plan_progress_plan_item_ids);
        $items_that_are_deleted = array_diff($plan_progress_plan_item_ids, $plan_items_ids);
        dd($items_that_still_exist, $items_that_are_new, $items_that_are_deleted);
        // foreach ($this->plan->items as $item) {
        //     if (PlanProgress::where('user_id', $this->id)->where('plan_item_id', $item->id)->count() == 0) {
                
        //     }
        // }
    }
}
