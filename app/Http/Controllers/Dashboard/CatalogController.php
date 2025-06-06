<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\Catalog\DestroyCatalogAction;
use App\Actions\Dashboard\Catalog\IndexCatalogAction;
use App\Actions\Dashboard\Catalog\StoreCatalogAction;
use App\Actions\Dashboard\Catalog\UpdateCatalogAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Catalog\CreateRequest;
use App\Http\Requests\Dashboard\Catalog\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexCatalogAction $action): Response
    {
        return Inertia::render('Dashboard/Catalog', ['catalogs' => $action()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request, StoreCatalogAction $action): RedirectResponse
    {
        $action($request);

        return redirect()->intended(route('dashboard.catalog.index', absolute: false));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, int $id, UpdateCatalogAction $action): RedirectResponse
    {
        $action($request, $id);

        return redirect()->intended(route('dashboard.catalog.index', absolute: false));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, DestroyCatalogAction $action): RedirectResponse
    {
        $action($id);

        return redirect()->intended(route('dashboard.catalog.index', absolute: false));
    }
}
