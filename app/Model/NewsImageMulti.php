<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class NewsImageMulti extends Model
{
	protected $table = 'news_image_multis';

	protected $fillable = [
    	'news_id', 'image_multi'
    ];

    protected $primaryKey = 'id';
}
