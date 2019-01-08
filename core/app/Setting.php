<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function setSettingsHeadlinesAttribute($headlines = array()){
        $this->headlines = json_encode($headlines);
    }

    public function setCategoryPriorityAttribute($idCategories = array()){
        $this->categories_priority = json_encode($idCategories);
    }

    public function getNewsHeadlinesAttribute(){
        $headlines = json_decode($this->headlines);
        $headlineNews = News::whereIn('id', $headlines)->orderByRaw('FIELD(id,'.implode(',',$headlines).')')->get();
        return $headlineNews;
    }

    public function getNewsSubheadlinesAttribute(){
        $subHeadlines = json_decode($this->sub_headlines);
        $subHeadlines = News::whereIn('id', $subHeadlines)->orderByRaw('FIELD(id,'.implode(',',$subHeadlines).')')->get();
        return $subHeadlines;
    }

    public function getPrioritizedCategoriesAttribute(){
        $prioritizedCategories = json_decode($this->categories_priority);
        // $prioritizedCategoryNews = News::whereIn('category_id', $prioritizedCategories)->orderByRaw('FIELD(id,'.implode(',',$prioritizedCategories).')')->get();
        return $prioritizedCategories;
    }
}
