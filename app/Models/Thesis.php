<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'student_id', 'professor_id', 'defense_date'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
    public function documents()
    {
        return $this->hasMany(ThesisDocument::class);
    }
}
