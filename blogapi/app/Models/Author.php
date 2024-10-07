<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //Make it possbile to fill firstname and lastname with own data
    use HasFactory;
    protected $primaryKey = 'author_ID';
    protected $table = 'author';
    protected $fillable = ['firstname', 'lastname'];

    public function blogposts(){
        return $this->hasMany(Blog::class, "author_ID", "author_ID");
    }
}
