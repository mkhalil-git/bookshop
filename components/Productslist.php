<?php namespace Acme\Bookshop\Components;

use Cms\Classes\ComponentBase;
use Acme\Bookshop\Models\Book;
use Acme\Bookshop\Models\Category;
use Acme\Bookshop\Models\Author;
use Acme\Bookshop\Models\Sereis;
use Acme\Bookshop\Models\Publisher;
use Acme\Bookshop\Models\Level;

class Productslist extends ComponentBase
{
    private $booksQ ;

    public function componentDetails()
    {
        return [
            'name'        => 'Productslist Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [

            'blockTitle' => [
                'description'       => 'block title ',
                'title'             => 'block title ',
                'type'              => 'string',
                'group'             => 'books',

            ],

            'max' => [
                'description'       => 'The most amount of books allowed',
                'title'             => 'Max items',
                'default'           => 10,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The Max Items value is required and should be integer.',
                'group'             => 'books',

            ],

            'orderBy' => [
                'description'       => 'how to order books ',
                'title'             => 'order',
                'default'           => 'title',
                'type'              => 'dropdown',
                'required'          => true,
                'options'          => ['title'=>'title', 'publishDate'=>'publish Date', 'created_at'=>'date of create', 'ordinal'=>'ordinal'],
                'group'             => 'books',

            ],
            'orderDirection' => [
                'description'       => 'order direction ',
                'title'             => 'order direction',
                'default'           => 'asc',
                'type'              => 'dropdown',
                'options'          => ['asc'=>'ascending', 'desc'=>'descending'],
                'group'             => 'books',

            ],

             'categoryFilter' => [
                'description'       => 'filter by category ',
                'title'             => 'filter by category ',
                'type'              => 'checkbox',
                'group'             => 'booksFilters',
            ],

             'levelFilter' => [
                'description'       => 'filter by level ',
                'title'             => 'filter by level ',
                'type'              => 'checkbox',
                'group'             => 'booksFilters',
            ],

             'tagFilter' => [
                'description'       => 'filter by tag ',
                'title'             => 'filter by tag ',
                'type'              => 'checkbox',
                'group'             => 'booksFilters',
            ],

             'orderDirection' => [
                'description'       => 'filter by publisher ',
                'title'             => 'filter by publisher ',
                'type'              => 'checkbox',
                'group'             => 'booksFilters',
            ],

             'orderDirection' => [
                'description'       => 'filter by author ',
                'title'             => 'filter by publisher ',
                'type'              => 'checkbox',
                'group'             => 'booksFilters',
            ],
        ];
    }


    public function init()
    {
        // var_dump(\Request::all());
        // dd(\Request::all());
        $orderBy    = $this->property('orderBy', 'title');
        $orderDir   = $this->property('orderDirection', 'asc');

        // $this->booksQ = Book::orderBy($orderBy, $orderDir);
        $this->booksQ = Book::orderBy("series_id")->orderBy("ordinal")->orderBy("title");
        $this->applyFilters();
    }

    private function applyFilters()
    {
        if (\Request::has('series')) {
            $entityTerm = \Request::get('series');
            $entity = Series::where('title', 'like', $entityTerm)->first();
            if ($entity)
                $this->booksQ->where("series_id", $entity->id);

        }elseif(\Request::has('level')){
            $entityTerm = \Request::get('level');
            $entity = Level::where('name', 'like', $entityTerm)->first();
            if ($entity)
                $this->booksQ->where("level_id", $entity->id);

        }elseif(\Request::has('publisher')){
            $entityTerm = \Request::get('publisher');
            $entity = Publisher::where('name', 'like', $entityTerm)->first();
            if ($entity)
                $this->booksQ->where("publisher_id", $entity->id);

        }elseif(\Request::has('author')){
            $entityTerm = \Request::get('author');
            $entity = Author::where('name', 'like', $entityTerm)->first();
            if ($entity)
                $this->booksQ->where("author_id", $entity->id);

        }elseif(\Request::has('category')){
            $entityTerm = \Request::get('category');
            $entity = Category::where('name', 'like', $entityTerm)->first();
            if ($entity)
                $this->booksQ->where("category_id", $entity->id);
        }

        if (\Request::has('q')) {
            $q = \Request::get('q') ;
            $this->booksQ->where("title", 'like', '%'. $q . '%' );
        }

        if (\Request::has('orderBy')) {
            $orderBy = \Request::get('orderBy');
            if (in_array($orderBy, ["title", "created_at", "price", "ordinal"] )) {
                $this->booksQ->orderBy($orderBy);
            }
        }

    }

    public function pageTitle()
    {
        return $this->title ;
    }


    public function filteredBooks()
    {
        // $this->applyFilters();
        $result = $this->booksQ->paginate(12);
        $all = \Request::all();
        foreach ($all as $key => $value) {
            $result->addQuery($key, $value);
        }

        return $result; 
    }

    public function categories()
    {
        $orderBy = "ordinal";
        return Category::orderBy($orderBy)->orderBy("name")->lists('name');
    }

    public function levels()
    {
        $orderBy = "ordinal";
        return Level::orderBy($orderBy)->orderBy("name")->lists('name');
    }

    public function publishers()
    {
        $orderBy = "ordinal";
        return Publisher::orderBy($orderBy)->orderBy("name")->lists('name');
    }

    public function author()
    {
        $orderBy = "ordinal";
        return Author::orderBy($orderBy)->orderBy("name")->lists('name');
    }

    public function series()
    {
        $orderBy = "ordinal";
        return Series::orderBy($orderBy)->orderBy("title")->lists('title');
    }

}
