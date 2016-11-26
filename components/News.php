<?php namespace Acme\Bookshop\Components;

use Cms\Classes\ComponentBase;

class News extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'news Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'max' => [
            'description'       => 'The most amount of news allowed',
            'title'             => 'Max items',
            'default'           => 3,
            'type'              => 'string',
            'validationPattern' => '^[0-9]+$',
            'validationMessage' => 'The Max Items value is required and should be integer.'
                        ],
        ];
    }
  
    public function allNews()
    {
        return \Acme\BookShop\Models\News::orderBy("startDate", "desc")->get();
    }
    public function recentNews()
    {
        $max = $this->property('max', 3);
        return \Acme\BookShop\Models\News::orderBy("startDate", "desc")->limit($max)->get();
    }
     

}