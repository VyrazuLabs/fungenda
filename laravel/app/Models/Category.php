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
}
