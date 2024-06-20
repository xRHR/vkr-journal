<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMiscInfo extends Model
{
    use HasFactory;
    protected $table = 'user_misc_info';
    // Определение отношения к Group
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
