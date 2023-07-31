<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class GalleryImageMulti extends Model
{
	protected $table = 'gallery_image_multis';

	protected $fillable = [
    	'gallery_id', 'image_multi'
    ];

    protected $primaryKey = 'id';
}
