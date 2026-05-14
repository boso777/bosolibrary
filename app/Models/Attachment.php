<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{

    protected $fillable = ['path', 'name', 'book_id'];

    public function book() {
        return $this->belongsTo(Book::class);
    }

}
