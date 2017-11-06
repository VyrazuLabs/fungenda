<?php

namespace app\Helpers;

use App\Models\Category;

class Menu {
	public static function getRootCategories() {
		return Category::where('category_status', 1)
						->where('parent', 0)
						->get();
	}

	public static function getChildrens($category) {
		return $category->getChildrens;
	}
}