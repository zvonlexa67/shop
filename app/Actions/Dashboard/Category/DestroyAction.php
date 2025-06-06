<?php

namespace App\Actions\Dashboard\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class DestroyAction
{
    public function __invoke($category_id): array
    {
        if ($category_id > 0) {
            $result = Category::descendantsAndSelf($category_id);

            $arrIds = [];

            foreach($result as $category) {
                $arrIds[] = $category->id;
                $this->deleteDirection($category->id);
                Category::whereId($category->id)->delete();
            }

            Category::destroy($arrIds);
            Category::clearCache();
        }

        return [ 'id' => 1 ];
    }

    protected function deleteDirection(int $id): void
    {
        if (is_dir(config('filesystems.disks.public.root') . Category::STORAGE_DIR_IMAGES . $id)) {
            Storage::disk('public')->deleteDirectory(Category::STORAGE_DIR_IMAGES . $id);
        }
        
        if (is_dir(config('filesystems.disks.public.root') . Category::STORAGE_DIR_ICONS . $id)) {
            Storage::disk('public')->deleteDirectory(Category::STORAGE_DIR_ICONS . $id);
        }
    }
}
