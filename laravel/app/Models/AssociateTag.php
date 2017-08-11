<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociateTag extends Model
{
    protected $table = 'associate_tags';

    protected $fillable = [
    		'user_id',
    		'entity_id',
    		'entity_type',
    		'tags_id'
    ];
}
