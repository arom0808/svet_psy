<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuotesController extends Controller
{
    function search($searchExpression){
        return view('quotes', ['searchExpression' => $searchExpression]);
    }
}
