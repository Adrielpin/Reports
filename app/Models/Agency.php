<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model {

    public function administrators() {

        return $this->hasMany('Models\Administrator');

    }

}
