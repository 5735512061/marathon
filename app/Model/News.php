<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	protected $table = 'news';

	protected $fillable = [
    	'admin_id', 'title','title_eng', 'image_main', 'image_multi', 'news', 'news_eng', 'date'
    ];

    protected $primaryKey = 'id';
}
