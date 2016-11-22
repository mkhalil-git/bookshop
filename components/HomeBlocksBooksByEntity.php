<?php namespace Acme\Bookshop\Components;

use Cms\Classes\ComponentBase;
use Acme\BookShop\Models\Book;
use Acme\BookShop\Models\Series;
use Acme\BookShop\Models\Level;

class HomeBlocksBooksByEntity extends ComponentBase
{

     public function componentDetails()
    {
        return [
            'name'        => 'book by certain entity Component',
            'description' => 'home block for books by entity'
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

            'entity' => [
                'description'       => 'The the entity you want get books using it like author, level, category, and tags',
                'title'             => 'entity ',
                'default'           => 'Level',
                'type'              => 'dropdown',
                'group'             => 'entity',
                'options'           => ['Author'=> 'author', 'Category'=> 'category', 'Level'=> 'level', 'Tag'=>'tag' ],
            ],

            'entityMax' => [
                'description'       => 'The most amount of entity allowed',
                'title'             => 'Max items',
                'default'           => 5,
                'type'              => 'string',
                'group'             => 'entity',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The Max Items value is required and should be integer.'
            ],
            'orderEntityBy' => [
                'description'       => 'how would you like to order entity ',
                'title'             => 'order',
                'default'           => 'name',
                'type'              => 'dropdown',
                'group'             => 'entity',
                'required'          => true,
                'options'          => ['name'=>'name', 'created_at'=>'date of create', 'ordinal'=>'ordinal'],
            ],
            'orderEntityDirection' => [
                'description'       => 'order direction ',
                'title'             => 'order direction',
                'default'           => 'asc',
                'group'             => 'entity',
                'type'              => 'dropdown',
                'options'          => ['asc'=>'ascending', 'desc'=>'descending']
            ],


            'bookMax' => [
                'description'       => 'The most amount of books allowed for EACH ENTITY',
                'title'             => 'Max items',
                'default'           => 3,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The Max Items value is required and should be integer.',
                'group'             => 'books',

            ],

            'orderBooksBy' => [
                'description'       => 'how to order books ',
                'title'             => 'order',
                'default'           => 'title',
                'type'              => 'dropdown',
                'required'          => true,
                'options'          => ['title'=>'title', 'publishDate'=>'publish Date', 'created_at'=>'date of create', 'ordinal'=>'ordinal'],
                'group'             => 'books',

            ],
            'orderBooksDirection' => [
                'description'       => 'books order direction ',
                'title'             => 'order direction',
                'default'           => 'asc',
                'type'              => 'dropdown',
                'options'          => ['asc'=>'ascending', 'desc'=>'descending'],
                'group'             => 'books',
            ],
        ];
    }

    public function entities()
    {
        $entityName       = $this->property('entity', 'Level');

        $entityOrderBy    = $this->property('orderEntityBy', 'name');
        $entityOrderDir   = $this->property('orderEntityDirection', 'asc');
        $entityMax        = (int) $this->property('entityMax');

        $bookOrderBy    = $this->property('orderBooksBy', 'name');
        $bookOrderDir   = $this->property('orderBooksDirection', 'asc');
        $bookMax        = (int) $this->property('bookMax');

        $classname = "Acme\BookShop\Models\\" . $entityName ;

        return $classname::orderBy($entityOrderBy, $entityOrderDir)->whereHas(
        "books", function ($q) use ($bookOrderBy, $bookOrderDir, $bookMax)
        {
             $q->orderBy($bookOrderBy, $bookOrderDir);
        })->take($entityMax)->get()->each(function ($entity) use ($bookMax)
        {
                $entity->entityBooks = $entity->books->take($bookMax);
        });

    }

    public function title()
    {
        $title = "books by " . $this->property('entity', 'Level');
        return $this->property('blockTitle', $title);
    }

}