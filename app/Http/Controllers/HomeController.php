<?php

namespace App\Http\Controllers;

use App\Actions\Home\IndexAction;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(IndexAction $action): Response
    {
        return Inertia::render('home/Home', $action());
    }
}
