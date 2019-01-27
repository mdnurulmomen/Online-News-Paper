<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = ['id'];
    protected $table = "settings";

    public function getNewsHeadlinesAttribute()
    {
        $headlines = json_decode($this->headlines);
        $headlineNews = News::whereIn('id', $headlines)->orderByRaw('FIELD(id,'.implode(',',$headlines).')')->get();
        return $headlineNews;
    }

    public function getNewsSubheadlinesAttribute()
    {
        $subHeadlines = json_decode($this->sub_headlines);
        $subHeadlines = News::whereIn('id', $subHeadlines)->orderByRaw('FIELD(id,'.implode(',',$subHeadlines).')')->get();
        return $subHeadlines;
    }

    public function getFrontCategoriesAttribute()
    {
        $prioritizedCategories = json_decode($this->index_categories);
        return $prioritizedCategories;
    }

    public function getFooterCategoriesAttribute()
    {
        $footerCategories = json_decode($this->categories_footer);
        return $footerCategories;
    }

    public function setSettingsHeadlinesAttribute($headlines = array())
    {
        $this->headlines = json_encode($headlines);
    }

    public function setSettingsSubHeadlinesAttribute($subHeadlines = array())
    {
        $this->sub_headlines = json_encode($subHeadlines);
    }

    public function setCategoryPriorityAttribute($idCategories = array())
    {
        $this->index_categories = json_encode($idCategories);
    }

    public function setCategoryFooterAttribute($idCategories = array())
    {
        $this->categories_footer = json_encode($idCategories);
    }
}
