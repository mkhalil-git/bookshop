<?php namespace Acme\Bookshop\Models;

use Model;

/**
 * News Model
 */
class News extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_bookshop_news';

    use \October\Rain\Database\Traits\Validation;

    public $rules = [
        'title' => 'required',
        'description' => 'required',
    ];

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
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = ['image' => 'System\Models\File'];
    public $attachMany = [];

}