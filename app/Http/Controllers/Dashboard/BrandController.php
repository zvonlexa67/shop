<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\Brand\DestroyAction;
use App\Actions\Dashboard\Brand\IndexAction;
use App\Actions\Dashboard\Brand\StoreAction;
use App\Actions\Dashboard\Brand\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Brand\StoreRequest;
use App\Http\Requests\Dashboard\Brand\UpdateRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class BrandController extends Controller
{
    public function index(IndexAction $action): Response
    {
        return Inertia::render('dashboard/brand/Index', $action());
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action($request->all());

        return redirect()->intended(route('dashboard.brand.index'));
    }

    public function update(UpdateRequest $request, UpdateAction $action): RedirectResponse
    {
        $action($request->all());

        return redirect()->intended(route('dashboard.brand.index'));
    }

    public function destroy(int $id, DestroyAction $action): RedirectResponse
    {
        $action($id);

        return redirect()->intended(route('dashboard.brand.index'));
    }
}
