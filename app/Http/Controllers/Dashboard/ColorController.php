<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\Color\DestroyAction;
use App\Actions\Dashboard\Color\IndexAction;
use App\Actions\Dashboard\Color\StoreAction;
use App\Actions\Dashboard\Color\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Color\StoreRequest;
use App\Http\Requests\Dashboard\Color\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ColorController extends Controller
{
    public function index(IndexAction $action): Response
    {
        return Inertia::render('dashboard/color/Index', $action());
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action($request->all());

        return redirect()->intended(route('dashboard.color.index'));
    }

    public function update(UpdateRequest $request, UpdateAction $action): RedirectResponse
    {
        $action($request->all());

        return redirect()->intended(route('dashboard.color.index'));
    }

    public function destroy(int $id, DestroyAction $action): RedirectResponse
    {
        $action($id);

        return redirect()->intended(route('dashboard.color.index'));
    }
}
