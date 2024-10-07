<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $fillable = ['comment_id', 'user_id', 'content', 'parent_reply_id'];
    public function comment()
    {
        return $this->belongsTo(Comments::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parentReply()
    {
        return $this->belongsTo(Reply::class, 'parent_reply_id');
    }
}
