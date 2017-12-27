<?php

namespace app\Helpers;

use App\Models\Link;

class Links {
	
	public static function getFacebookLinks(){
		if(!empty(Link::first())){
			return Link::first()->facebook;
		}
		else{
			return "#";
		}
	}

	public static function getTwitterLinks(){
		if(!empty(Link::first())){
			return Link::first()->twitter;
		}
		else{
			return "#";
		}
	}
	
	public static function getLinkedinLinks(){
		if(!empty(Link::first())){
			return Link::first()->linkedin;
		}
		else{
			return "#";
		}
	}

	public static function getGooglePlusLinks(){
		if(!empty(Link::first())){
			return Link::first()->google_plus;
		}
		else{
			return "#";
		}
	}

	public static function getPinterestLinks(){
		if(!empty(Link::first())){
			return Link::first()->pinterest;
		}
		else{
			return "#";
		}
	}

	public static function getMailIdLinks(){
		if(!empty(Link::first())){
			return Link::first()->mail_id;
		}
		else{
			return "#";
		}
	}
}