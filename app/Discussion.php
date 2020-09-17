<?php

namespace LaravelForum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discussion extends Model
{
    
    protected $fillable = [
        'title', 'content', 'slug', 'user_id', 'channel_id'
    ];
    
    
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
