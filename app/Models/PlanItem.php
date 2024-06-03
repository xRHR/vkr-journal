<?php

namespace App\Models;

use App\Traits\DatetimeTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PlanItem extends Model implements HasMedia
{
    use DatetimeTrait;
    use HasFactory;
    use InteractsWithMedia; 

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
    public function deadline_formatted()
    {
        return $this->getFormattedDate($this->deadline);
    }
    public function deadline_formatted_without_year()
    {
        return $this->getFormattedDateWithoutYear($this->deadline);
    }
}
