<?php

namespace app\Helpers;

use App\Models\Link;

class Links {
	
	public static function getFacebookLinks(){
		return Link::first()->facebook;
	}

	public static function getTwitterLinks(){
		return Link::first()->twitter;
	}
	
	public static function getLinkedinLinks(){
		return Link::first()->linkedin;
	}

	public static function getGooglePlusLinks(){
		return Link::first()->google_plus;
	}

	public static function getPinterestLinks(){
		return Link::first()->pinterest;
	}

	public static function getMailIdLinks(){
		return Link::first()->mail_id;
	}
}