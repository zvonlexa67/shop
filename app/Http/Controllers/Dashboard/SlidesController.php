<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\Sliders\DestroySlidesAction;
use App\Actions\Dashboard\Sliders\IndexAction;
use App\Actions\Dashboard\Sliders\StoreAction;
use App\Actions\Dashboard\Sliders\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Slide\CreateRequest;
use App\Http\Requests\Dashboard\Slide\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class SlidesController extends Controller
{
    public function index(IndexAction $action): Response
    {
        return Inertia::render('dashboard/slide/Index', $action());
    }

    public function store(CreateRequest $request, StoreAction $action): RedirectResponse
    {
        $action($request->all());

        return redirect()->intended(route('dashboard.slides.index', absolute: false));
    }

    public function update(UpdateRequest $request, UpdateAction $action): RedirectResponse
    {
        $action($request->all());

        return redirect()->intended(route('dashboard.slides.index', absolute: false));
    }

    public function destroy(int $id, DestroySlidesAction $action): RedirectResponse
    {
        $action($id);

        return redirect()->intended(route('dashboard.slides.index', absolute: false));
    }
}
