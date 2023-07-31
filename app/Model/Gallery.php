<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
	protected $table = 'gallerys';

	protected $fillable = [
    	'admin_id', 'title', 'title_eng', 'image_main', 'date'
    ];

    protected $primaryKey = 'id';
}
