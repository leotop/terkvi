<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Churches extends Model {

	protected $table = 'churches';

	public function scopeofType($query, $type)
	{
		return $query->where('title', 'LIKE', '%'.$type.'%');
	}

}
