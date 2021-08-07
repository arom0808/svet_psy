<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    function users()
    {
        $search_expression = request()->input('search');
        $search_expression = !is_null($search_expression) ? $search_expression : "";
        $page_index = request()->input('page');
        $page_index = !is_null($search_expression) && is_numeric($page_index) ? $page_index : 1;
        $pages_count = DB::table('users');
        if ($search_expression != "") {
            $pages_count = $pages_count->where('name', 'like', '%' . $search_expression . '%')
                ->orWhere('email', 'like', '%' . $search_expression . '%');
        }
        $pages_count = $pages_count->count();
        $pages_count += $pages_count % 5 === 0 ? 0 : 5 - $pages_count % 5;
        $pages_count /= 5;
        $users = User::orderBy('id')->offset($page_index * 5 - 5)->limit(5);
        if ($search_expression != "") {
            $users = $users->where('name', 'like', '%' . $search_expression . '%')->orWhere('email', 'like', '%' . $search_expression . '%');
        }
        $users = $users->get();
        return view('admin_users', ['users' => $users, 'pages_count' => $pages_count, 'search_expression' => $search_expression, 'page_index' => $page_index]);
    }
}
