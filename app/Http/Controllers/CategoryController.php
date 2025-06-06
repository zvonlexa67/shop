<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Actions\Category\IndexAction;

class CategoryController extends Controller
{
    public function index(string $slug, IndexAction $action): Response
    {

        // dd($action($slug)['products']());

        return Inertia::render('category/Index', $action($slug));
        
    }
}
