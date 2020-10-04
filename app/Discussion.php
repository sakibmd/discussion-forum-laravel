<?php

namespace LaravelForum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelForum\Notifications\ReplyMarkedAsBestReply;

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

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function getBestReply(){
        return Reply::find($this->reply_id);
    }

    public function bestReply(){
        return $this->belongsTo(Reply::class, 'reply_id' );
    }

    // public function markAsBestReply(Reply $reply){
    //     $this->update([
    //         'reply_id' => $reply->id,
    //     ]);
    // }


    public function scopeFilterByChannels($builder){
        if(request()->query('channel')){
            $channel = Channel::where('slug',request()->query('channel') )->first();
            if($channel){
                return $builder->where('channel_id', $channel->id);
            }
            return $builder;
        }
        return $builder;
    }

}
