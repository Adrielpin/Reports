<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model {

	public function agency() {

		return $this->belongsTo('Models\Agency');

	}

	public function engineers() {

		return $this->hasManyThrough('Models\Enginner','Administrators_id','id');

	}
}
