<?php namespace Acme\BookShop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Acme\BookShop\Models\Book;

/**
 * Books Back-end Controller
 */
class Books extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Acme.BookShop', 'bookshop', 'books');
    }

    public function onDelete()
    {
        $checkedIds = post('checked');
        if ((is_array($checkedIds)) && (count($checkedIds) > 0)) {
            $deleted = Book::whereIn('id', $checkedIds)->delete();
            if (!$deleted) {
                return \Flash::error('sorry books have\'nt  been deleted ?');
            }
        }

        \Flash::success(\Lang::get('backend::lang.list.delete_selected_success', [
            'name' => 'deleted '
        ]));


        return $this->listRefresh();
    }
}