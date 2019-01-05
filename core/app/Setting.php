<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function setSettingsHeadlinesAttribute($headlines = array()){
        $this->headlines = json_encode($headlines);
    }

    public function setCategoryPriorityAttribute($idCategories = array()){
        $this->prioritizedCategories = json_encode($idCategories);
    }

    public function getNewsHeadlinesAttribute(){
        $headlines = json_decode($this->headlines);
        $headlineNews = News::whereIn('id', $headlines)->orderByRaw('FIELD(id,'.implode(',',$headlines).')')->get();
        return $headlineNews;
    }

    public function getPrioritizedCategoriesAttribute(){
        $prioritizedCategories = json_decode($this->frontcategories);
//        $headlineNews = News::whereIn('id', $headlines)->orderByRaw('FIELD(id,'.implode(',',$headlines).')')->get();
        return $prioritizedCategories;
    }
}
