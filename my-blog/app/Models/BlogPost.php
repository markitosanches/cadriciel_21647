<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    /*
    protected $table = 'Blog';
    protected $primaryKey = "blog_id";  blogs  id
    */

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'categorys_id'
    ];

    public function blogHasUser(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function blogHasCategory(){
        return $this->hasOne('App\Models\Category', 'id', 'categorys_id');
    }

    /*public function selectUser(){
        return $this->Select(DB::raw('concat(fistname, " ", lastName) as name'))
                ->join('users', 'users.id', '=', 'user_id')
                ->get();
    }*/
}
