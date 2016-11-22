<?php namespace Acme\BookShop\Models;

use Model;

/**
 * Series Model
 */
class Series extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_bookshop_series';

    use \October\Rain\Database\Traits\Validation;

    public $rules = [
        'title' => 'required|unique:acme_bookshop_series',
        // 'slug' => 'required',
        'price' => 'required',
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $this->attributes['title'] );
    }


    public function authors()
    {
        $authors_id = $this->books()->groupBy("author_id")->get(["author_id"])->toArray(); 
        return \Acme\BookShop\Models\Author::whereIn('id',  $authors_id)->get();
    }

    public function levels()
    {
        $levels_id = $this->books()->groupBy("level_id")->get(["level_id"])->toArray(); 
        return \Acme\BookShop\Models\Level::whereIn('id',  $levels_id)->get();
    }

    public function categories()
    {
        $categories_id = $this->books()->groupBy("category_id")->get(["category_id"])->toArray(); 
        return \Acme\BookShop\Models\Category::whereIn('id',  $categories_id)->get();
    }


    public function publishers()
    {
        $publishers_id = $this->books()->groupBy("publisher_id")->get(["publisher_id"])->toArray(); 
        return \Acme\BookShop\Models\Publisher::whereIn('id',  $publishers_id)->get();
    }

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = ["books"=>['Acme\Bookshop\Models\Book'] ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = ['image' => 'System\Models\File',];
    public $attachMany = [];

}