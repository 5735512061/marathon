<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
	protected $table = 'counters';

	protected $fillable = [
    	'name', 'day', 'month', 'year', 'time', 'status'
    ];

    protected $primaryKey = 'id';
}
