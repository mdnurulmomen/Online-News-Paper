<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function setSettingsHeadlinesAttribute($headlines = array()){
        $this->headlines = json_encode($headlines);
    }
}
