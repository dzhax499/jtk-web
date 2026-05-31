<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Category;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->with(['parent', 'children'])
            ->orderBy('name')
            ->get();

        return CategoryResource::collection($categories);
    }
}
