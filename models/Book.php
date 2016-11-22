<?php namespace Acme\BookShop\Models;

use Model;

/**
 * Book Model
 */
class Book extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_bookshop_books';

    use \October\Rain\Database\Traits\Validation;

    public $rules = [
        'title' => 'required|unique:acme_bookshop_books',
        'ordinal' => 'integer',
        // 'slug' => 'required',
        'numberOfPages' => 'required|integer',
        'price' => 'required|numeric',
        'language' => 'required',
        'ISBN' => 'required',
        'publishDate' => 'required',

        // 'author_id' => 'required|integer',
        // 'publisher_id' => 'required|integer',
        // 'level_id' => 'required|integer',
        // 'category_id' => 'integer',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_replace(' ', '-', $this->attributes['title'] );
    }

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'author' =>['Acme\BookShop\Models\Author'],
        'publisher' =>['Acme\BookShop\Models\Publisher'],
        'category' =>['Acme\BookShop\Models\Category'],
        'level' =>['Acme\BookShop\Models\Level'],
        'series' =>['Acme\BookShop\Models\Series'],
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'image' => 'System\Models\File',
    ];
    public $attachMany = [];

    public function getLanguageOptions()
    {
        return ["AR"=>'AR', "EN"=>"EN"];
    }

}