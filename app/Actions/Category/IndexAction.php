<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Http\Resources\Category\IndexCollection;
use App\Http\Resources\Category\IndexProductCollection;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class IndexAction
{
    public function __invoke(string $slug): array
    {
        // $category = Category::query()->where('slug', $slug)->first();
        $category = Category::with('products')->where('slug', $slug)->first();

        // dd($category);

        return [
            'categories' => fn() => Category::getAll(),
            'list_categories' => fn() => $this->Categories($category->id),
            'breadcrumbs' => fn() => $this->BreadCrumbs($category),
            'products' => fn() => $this->Products($category->products),
        ];
    }

    protected function Categories($id): IndexCollection
    {
        return IndexCollection::make(Category::query()
            ->where('parent_id', $id)
            ->orderBy('sort')
            ->orderBy('id')
            ->get()
        );
    }

    protected function BreadCrumbs(Category $category): IndexCollection
    {
        return IndexCollection::make($category->ancestors->sortBy('id')->push($category));
    }

    protected function Products($products): AnonymousResourceCollection
    {
        return ProductResource::collection($products);
    }
    // protected function Products($category): IndexProductCollection
    // {
    //     return IndexProductCollection::make($category->products);
    // }
}
