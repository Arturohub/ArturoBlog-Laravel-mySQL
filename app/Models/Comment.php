<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "blog_id",
        "comment",
        "parent_comment_id",
        "likes"

    ];

    public function user(){
        return $this->belongsTo(User::class, "user_id");

    }

    public function blog(){
        return $this->belongsTo(Blog::class, "blog_id");
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id')->with('replies');
    }

    public function likes()
{
    return $this->hasMany(Like::class);
}
    
}


