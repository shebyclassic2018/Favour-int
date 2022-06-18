<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class VisitService extends Model {

    protected $table = 'visits';
    
    public function visitsCounter() {
        return visits($this);
    }

    public function visits() {
        return visits($this)->relation();
    }
}