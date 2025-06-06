<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Actions\Dashboard\Product\IndexAction;
use App\Actions\Dashboard\Product\StoreAction;
use App\Actions\Dashboard\Product\UpdateAction;
use App\Actions\Dashboard\Product\StoreImageAction;
use App\Actions\Dashboard\Product\StoreSortImagesAction;
use App\Actions\Dashboard\Product\DestroyAction;
use App\Actions\Dashboard\Product\DestroyImageAction;
use App\Actions\Dashboard\Product\StoreDescriptionAction;
use App\Actions\Dashboard\Product\StoreCharacteristicsAction;
use App\Actions\Dashboard\Product\StorePriceAction;
use App\Actions\Dashboard\Product\SyncCategoriesAction;

use App\Http\Requests\Dashboard\Product\StoreRequest;
use App\Http\Requests\Dashboard\Product\UpdateRequest;
use App\Http\Requests\Dashboard\Product\StoreImageRequest;
use App\Http\Requests\Dashboard\Product\StoreSortImagesRequest;
use App\Http\Requests\Dashboard\Product\StoreDescriptionRequest;
use App\Http\Requests\Dashboard\Product\StoreCharacteristicsRequest;
use App\Http\Requests\Dashboard\Product\StorePriceRequest;
use App\Http\Requests\Dashboard\Product\DestroyImageRequest;
use App\Http\Requests\Dashboard\Product\SyncCategoriesRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Redirect;
use Inertia\Response;
use Inertia\Inertia;

class ProductController extends Controller
{
  public function index(int $product_id, IndexAction $action): Response
  {
    return Inertia::render('dashboard/product/Index', $action($product_id));
  }
    // public function index(int $category_id, int $product_id, IndexAction $action): Response
    // {
    //     return Inertia::render('dashboard/product/Index', $action($category_id, $product_id));
    // }

  public function store(StoreRequest $request, StoreAction $action): RedirectResponse
  {
    return redirect()->intended(route('dashboard.product.index', $action($request->all())));
  }

    public function update(UpdateRequest $request, UpdateAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.product.index', $action($request->all())));
    }

    public function destroy(int $category_id, int $product_id, DestroyAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.product.index', $action($category_id, $product_id)));
    }

  public function storeImage(StoreImageRequest $request, StoreImageAction $action): RedirectResponse
  {
    return redirect()->intended(route('dashboard.product.index', $action($request->all())));
  }
    
  public function destroyImage(DestroyImageRequest $request, DestroyImageAction $action): RedirectResponse
  {
    return redirect()->intended(route('dashboard.product.index', $action($request->all())));
  }

  public function storeSortImages(StoreSortImagesRequest $request, StoreSortImagesAction $action): RedirectResponse
  {
    return redirect()->intended(route('dashboard.product.index', $action($request->all())));
  }

  public function syncCategories(SyncCategoriesRequest $request, SyncCategoriesAction $action): RedirectResponse
  {
    return redirect()->route('dashboard.product.index', $action($request->all()));
  }

  public function storeDescription(StoreDescriptionRequest $request, StoreDescriptionAction $action): RedirectResponse
  {
      return redirect()->intended(route('dashboard.product.index', $action($request->all())));
  }






  
    public function storeCharacteristics(StoreCharacteristicsRequest $request, StoreCharacteristicsAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.product.index', $action($request->all())));
    }

    public function storePrice(StorePriceRequest $request, StorePriceAction $action): RedirectResponse
    {
        return redirect()->intended(route('dashboard.product.index', $action($request->all())));
    }
}
