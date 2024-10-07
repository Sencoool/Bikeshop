<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryControllerApi extends Controller
{
    public function category_list(){
        $categories = Category::all();
        return response()->json(array('ok' => true,'categories' => $categories));
    }
}
