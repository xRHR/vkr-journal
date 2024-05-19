<?php

namespace App\Models;

use App\Models\PlanItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'owner_id'
    ];

    public function items() {
        return $this->hasMany(PlanItem::class, 'plan_id');
    }
    public function owner() {
        return $this->belongsTo(User::class,'owner_id');
    }
    public function descriptionShort()
    {
        $description = $this->description;
        // if (strlen($description) > 40) {
        //     $description = substr($description, 0, 40) . '...';
        // }
        return $description;
    }
}
