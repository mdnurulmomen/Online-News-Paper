<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function setSettingsHeadlinesAttribute($headlines = array()){
        $this->headlines = json_encode($headlines);
    }

    public function getNewsHeadlinesAttribute($headlines = array()){
        $headlines = json_decode($this->headlines);
        $headlineNews = News::whereIn('id', $headlines)->orderByRaw('FIELD(id,'.implode(',',$headlines).')')->get();
        return $headlineNews;
    }
}
