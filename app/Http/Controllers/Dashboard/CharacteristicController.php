<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Actions\Dashboard\Characteristic\Api\GetGroupsAction;
use App\Actions\Dashboard\Characteristic\IndexAction;
use App\Actions\Dashboard\Characteristic\UpdateAction;
use App\Actions\Dashboard\Characteristic\CreateAction;
use App\Actions\Dashboard\Characteristic\DestroyAction;
use App\Http\Requests\Dashboard\Characteristic\UpdateRequest;
use App\Http\Requests\Dashboard\Characteristic\CreateRequest;
use App\Http\Resources\Dashboard\Characteristic\GroupCollection;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CharacteristicController extends Controller
{
  public function index(int $characteristic_id, IndexAction $action): Response
  {
    return Inertia::render('dashboard/characteristic/Index', $action($characteristic_id));
  }

  public function update(UpdateRequest $request, UpdateAction $action): RedirectResponse
  {
    return redirect()->intended(route('dashboard.characteristic.index', $action($request)));
  }

  public function create(CreateRequest $request, CreateAction $action): RedirectResponse
  {
    return redirect()->intended(route('dashboard.characteristic.index', $action($request)));
  }

  public function destroy(int $characteristic_id, DestroyAction $action): RedirectResponse
  {
    return redirect()->intended(route('dashboard.characteristic.index', $action($characteristic_id)));
  }

  public function groups(GetGroupsAction $action): GroupCollection
  {
    return GroupCollection::make($action());
  }

  public function chars(int $id)
  {
    
  }
}
