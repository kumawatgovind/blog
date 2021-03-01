<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{
    /**
     * get all categories
     *
     * @param  App\Request\Request  $request
     * @return Json
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        return new CategoryCollection($categories);
    }
}
