<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'user_id', 'content', 'created_at', 'updated_at'];
    public function getPosts()
    {
        return    $this->belongsTo(Post::class);
        // return  $this->hasManyThrough(Comment::class, Post::class);
    }
    public  function getUsers()
    {
        return    $this->belongsTo(User::class, 'user_id');
    }
}