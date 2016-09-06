<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engineer extends Model
{
	public function administrator() {

		return $this->belongsTo('Models\Administrator');

	}

	public function analyst() {

		return $this->belongsToMany('Models\Analyst');

	}

}
