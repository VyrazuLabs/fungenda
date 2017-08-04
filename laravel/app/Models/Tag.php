<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
    		'tag_id',
    		'tag_name',
    		'description',
    		'status',
    		'created_by',
    		'updated_by',
    ];
}
