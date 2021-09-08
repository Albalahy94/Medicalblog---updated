<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;
    public function getUsers()
    {
        return   $this->belongsTo(User::class, 'user_id');
    }
    public  function getComments()
    {
        return    $this->hasMany(Comment::class);
    }
    protected $fillable = [
        'name',
        'user_id',
        'description',
        'tag',
        'category',
        'file',
    ];
}