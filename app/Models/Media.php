<?php

namespace App\Models;


use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
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
        return $this->belongsTo('App\Models\User', 'uploaded_by');
    }
}