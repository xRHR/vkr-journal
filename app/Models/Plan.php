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
        'owner_id',
        'is_deleted',
    ];

    public function items()
    {
        return $this->hasMany(PlanItem::class, 'plan_id')->where('is_deleted', 0);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function descriptionShort()
    {
        $description = $this->description;
        // if (strlen($description) > 40) {
        //     $description = substr($description, 0, 40) . '...';
        // }
        return $description;
    }
    public function participants()
    {
        return $this->hasMany(User::class, 'plan_id');
    }
}
