<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller{

    public function index(Category $category){
        return view('categories.index')->with(['posts' => $category->getByCategory()]);
    }
}

?>