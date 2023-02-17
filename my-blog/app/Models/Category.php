<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categorys';

    static public function selectCategory(){
        $lang = session()->get('localeDB');
        
        $query = Category::select('id', 
        DB::raw("(case when category$lang is null then category else category$lang end) as category")
        )
        ->orderby('category')
        ->get();
        return $query;
    }
    


    //SELECT id, (case when category_fr is null then category else category_fr end) as category from categorys
}
