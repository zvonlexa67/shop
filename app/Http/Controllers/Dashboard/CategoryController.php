<?php

namespace App\Http\Controllers\Dashboard;

// use App\Actions\Dashboard\Category\AppendAction;

use App\Actions\Dashboard\Category\Api\GetSmartAction;
use App\Actions\Dashboard\Category\Api\GetCompareAction;
use App\Actions\Dashboard\Category\Api\SyncSmartAction;
use App\Actions\Dashboard\Category\Api\SyncCompareAction;

use App\Actions\Dashboard\Category\CreateAction;
use App\Actions\Dashboard\Category\DestroyAction;
use App\Actions\Dashboard\Category\IndexAction;
use App\Actions\Dashboard\Category\UpdateAction;
use App\Actions\Dashboard\Category\DetachAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CreateRequest;
use App\Http\Requests\Dashboard\Category\UpdateRequest;
use App\Http\Requests\Dashboard\Category\SyncSmartRequest;
use App\Http\Requests\Dashboard\Category\SyncCompareRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\JsonResponse;
// use Request;

class CategoryController extends Controller
{
	public function index(int $id, IndexAction $action): Response
	{
		return Inertia::render('dashboard/category/Index', $action($id));
	}

    // public function append(int $category_id, CreateRequest $request, AppendAction $action): RedirectResponse
    // {
    //     return redirect()->intended(route('dashboard.category.index', $action($category_id, $request->all())));
    // }

	// public function attach(int $category_id, int $characteristic_id, AttachAction $action): RedirectResponse
	// {
	// 	return redirect()->intended(route('dashboard.category.index', $action($category_id, $characteristic_id)));
	// }

	public function detach(int $category_id, int $characteristic_id, DetachAction $action): RedirectResponse
	{
		return redirect()->intended(route('dashboard.category.index', $action($category_id, $characteristic_id)));
	}

	public function create(CreateRequest $request, CreateAction $action): RedirectResponse
	{
		return redirect()->intended(route('dashboard.category.index', $action($request->all())));
	}

	public function update(UpdateRequest $request, UpdateAction $action): RedirectResponse
	{
		return redirect()->intended(route('dashboard.category.index', $action($request->all())));
	}

	public function destroy(int $id, DestroyAction $action): RedirectResponse
	{
		return redirect()->intended(route('dashboard.category.index', $action($id)));
	}

  public function smart(int $cat_id, int $gr_id, GetSmartAction $action): JsonResponse
  {
    return response()->json($action($cat_id, $gr_id));
  }

  public function syncSmart(SyncSmartRequest $request, SyncSmartAction $action): void
  {
    $action($request->all());
  }

  public function compare(int $cat_id, int $gr_id, GetCompareAction $action): JsonResponse
  {
    return response()->json($action($cat_id, $gr_id));
  }

  public function syncCompare(SyncCompareRequest $request, SyncCompareAction $action): void
  {
    $action($request->all());
  }
}
