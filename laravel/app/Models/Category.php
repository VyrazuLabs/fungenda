<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = [
    						'category_id',
    						'name',
    						'parent',
    						'description',
    						'category_status',
    						'created_by'
    					  ];

	public function getParent() {
		return $this->hasOne('App\Models\Category','category_id','parent'); 
	}	

    public function getChildrens() {
        return $this->hasMany('App\Models\Category','parent','category_id'); 
    }	
}
