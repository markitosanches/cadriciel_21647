<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categorys';

    static public function selectCategory(){
        $query = Category::select()
        ->orderby('category')
        ->get();
        return $query;
    }
}
