<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (! function_exists('maxIndexDir')) {
  function maxIndexDir($dirs = [])
  {
    $arrIndex = [];

    foreach ($dirs as $dir) {
      $arr = explode('/', $dir);
      $arrIndex[] = (int) end($arr);
    }

    return $arrIndex ? max($arrIndex) : -1;
  }
}

if (! function_exists('indexDirPictureImage')) {
  function indexDirPictureImage($dir = '')
  {
    $arr = explode('/', $dir);
    array_pop($arr);

    return array_pop($arr);
  }
}

if (! function_exists('reInstanceArray')) {
  function reInstanceArray($arr = [])
  {
    $new = [];
    foreach ($arr as $val) {
      $new[] = $val;
    }

    return $new;
  }
}

if (! function_exists('UlidFileName')) {
  function UlidFileName($exp = 'file')
  {
    return ((string) Str::ulid()).'.'.$exp;
  }
}

if (! function_exists('deleteStorageDirId')) {
  function deleteStorageDirId($path, $id)
  {
    if (is_dir(config('filesystems.disks.public.root').$path.$id)) {
      Storage::disk('public')->deleteDirectory($path.$id);
    }
  }
}

if (! function_exists('valueTypeCharacteristic')) {
  function valueTypeCharacteristic($value)
  {
    return
      $value === null ?
        null :
          match (count($value)) {
            1 => $value['value'],
            default => $value,
          };
  }
}
