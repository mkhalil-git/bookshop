<?php namespace Acme\Bookshop\Components;

use Cms\Classes\ComponentBase;
use Acme\BookShop\Models\Book;
use Acme\BookShop\Models\Series;
class HomeBlocksBooks extends ComponentBase
{

     public function componentDetails()
    {
        return [
            'name'        => 'HomeBlocks_books Component',
            'description' => 'home block for books '
        ];
    }

    public function defineProperties()
    {
        return [
            'blockTitle' => [
                'description'       => 'block title ',
                'title'             => 'block title ',
                'type'              => 'string',
            ],

            'max' => [
                'description'       => 'The most amount of books allowed',
                'title'             => 'Max items',
                'default'           => 10,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The Max Items value is required and should be integer.'
            ],

            'orderBy' => [
                'description'       => 'how to order books ',
                'title'             => 'order',
                'default'           => 'title',
                'type'              => 'dropdown',
                'required'          => true,
                'options'          => ['title'=>'title', 'publishDate'=>'publish Date', 'created_at'=>'date of create', 'ordinal'=>'ordinal']
            ],
            'orderDirection' => [
                'description'       => 'order direction ',
                'title'             => 'order direction',
                'default'           => 'asc',
                'type'              => 'dropdown',
                'options'          => ['asc'=>'ascending', 'desc'=>'descending']
            ],
        ];
    }

    public function books()
    {
        $orderBy    = $this->property('orderBy', 'name');
        $orderDir   = $this->property('orderDirection', 'asc');
        $max        = (int) $this->property('max');

        return Book::orderBy($orderBy, $orderDir)->take($max)->get();
    }

     public function title()
    {
        return $this->property('blockTitle');
    }

}