<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Home\IndexAction;
use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
    public function index(IndexAction $action): Response
    {
        return Inertia::render('index/Index', $action());
    }
}
