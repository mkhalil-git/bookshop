<?php namespace Acme\Bookshop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;


/**
 * News Back-end Controller
 */
class News extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Acme.Bookshop', 'bookshop', 'news');
    }



    public function onDelete()
    {
        $checkedIds = post('checked');
        if ((is_array($checkedIds)) && (count($checkedIds) > 0)) {

           
            
            $deleted = \Acme\Bookshop\Models\News::whereIn('id', $checkedIds)->delete();
            if (!$deleted) {
                return \Flash::error('sorry News have\'nt  been deleted ?');
            }
        }

        \Flash::success(\Lang::get('backend::lang.list.delete_selected_success', [
            'name' => 'deleted '
        ]));


        return $this->listRefresh();
    }
}