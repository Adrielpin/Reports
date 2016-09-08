<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Analyst extends Model
{

	public function enginner() {

		return $this->belongsTo('Models\Enginner');

	}

	public function customers() {

		return $this->belongsToMany('Models\Customer');

	}
}
