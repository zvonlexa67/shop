<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\Chapter\DestroyChapterAction;
use App\Actions\Dashboard\Chapter\ShowChapterAction;
use App\Actions\Dashboard\Chapter\StoreChapterAction;
use App\Actions\Dashboard\Chapter\UpdateChapterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Chapter\CreateRequest;
use App\Http\Requests\Dashboard\Chapter\UpdateRequest;
use App\Http\Resources\Dashboard\Chapter\ChapterCollection;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ChapterController extends Controller
{
    public function store(CreateRequest $request, StoreChapterAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.chapter.show', ['chapter' => $action($request)], absolute: false));
    }

    public function show(int $id, ShowChapterAction $action): Response
    {
        return Inertia::render('Dashboard/Chapter', [
            'catalog_id' => $id,
            'chapters' => ChapterCollection::make($action($id)),
        ]);
    }

    public function update(UpdateRequest $request, int $id, UpdateChapterAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.chapter.show', ['chapter' => $action($request, $id)], absolute: false));
    }

    public function destroy(int $id, DestroyChapterAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.chapter.show', ['chapter' => $action($id)], absolute: false));
    }
}
