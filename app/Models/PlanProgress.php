<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_item_id',
    ];
    public function planItem()
    {
        return $this->belongsTo(PlanItem::class);
    }
}
