<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PlanItem extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia; 

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
