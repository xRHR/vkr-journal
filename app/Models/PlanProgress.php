<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PlanProgress extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia; 

    protected $fillable = [
        'user_id',
        'plan_item_id',
    ];
    public function plan_item()
    {
        return $this->belongsTo(PlanItem::class);
    }
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }
    public function is_deadline_passed()
    {
        return $this->plan_item->deadline < now();
    }
    public function is_overdue()
    {
        return (!$this->is_done) && ($this->plan_item->deadline < now());
    }
    public function is_done_late()
    {
        return $this->done_at > $this->plan_item->deadline;
    }
}
