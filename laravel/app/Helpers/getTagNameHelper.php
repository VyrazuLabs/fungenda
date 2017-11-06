<?php

namespace app\Helpers;

use App\Models\Tag;

class getTagNameHelper{

	//Get tag name
	static function getTagName($tag_id){

		$tag_name = Tag::where('tag_id',$tag_id)->pluck('tag_name');
		foreach ($tag_name as $value) {
			return $value;
		}
	}
}