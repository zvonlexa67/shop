<?php

namespace App\Actions\Dashboard\Api\Brand;

use App\Http\Resources\Dashboard\Brand\OptionCollection;
use App\Models\Brand;

class OptionAction
{
	public function __invoke(): OptionCollection
	{
		return OptionCollection::make(Brand::orderBy('id')->get());
	}
}