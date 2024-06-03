<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Chapter extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable = ['title', 'thesis_id', 'order'];

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }
    public function final_version()
    {
        return $this->belongsTo(Media::class, 'final_version_id');
    }
}
