<?php

namespace App\Models;

use App\Traits\DatetimeTrait;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use DatetimeTrait;
    /**
     * Boot events
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($media) {
            if ($user = auth()->getUser()) {
                $media->uploaded_by = $user->id;
            }
        });
    }

    /**
     * User relationship (one-to-one)
     * @return App\Models\User
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
    public function created_at_diff()
    {
        return $this->getDiffHumans($this->created_at);
    }
}