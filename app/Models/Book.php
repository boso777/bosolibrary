<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'description', 'author', 'cover_image', 'user_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function attachments() 
    {
        return $this->hasMany(Attachment::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
