<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    //Make it possbile to fill author title and body with own data
    protected $table = 'blogs';
    protected $fillable = ['title', 'body', 'author_ID'];

    public function author(){
        return $this->belongsTo(Author::class, "author_ID", "author_ID");
    }
}
