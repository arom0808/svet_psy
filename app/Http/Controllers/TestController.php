<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Category;

class TestController extends Controller
{
    public function TestInit(){
        for($i = -1; $i < 4; ++$i){
            if($i > -1 ){
                $category = Category::create(['name'=>strval($i)]);
                for($j = 0; $j < 4; ++$j){
                    Quote::create(['text'=>(strval($i) . strval($j)), 'publisher_id'=>1, 'category_id'=>$category->id, 'author'=>'Великий Роман Анодин']);
                }
            }
            else{
                for($j = 0; $j < 4; ++$j){
                    Quote::create(['text'=>(strval($i) . strval($j)), 'publisher_id'=>1, 'category_id'=>null, 'author'=>'Великий Роман Анодин']);
                }
            }
        }
    }
}
