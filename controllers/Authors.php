<?php namespace Acme\Bookshop\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Acme\Bookshop\Models\Author;

/**
 * Authors Back-end Controller
 */
class Authors extends Controller
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

        BackendMenu::setContext('Acme.Bookshop', 'bookshop', 'authors');
    }

    public function onDelete()
    {
        $checkedIds = post('checked');
        if ((is_array($checkedIds)) && (count($checkedIds) > 0)) {
            
            $authors = Author::whereIn('id', $checkedIds)->get();

            foreach ($authors as $author) {
                if ($author->books->count()) {
                    return \Flash::error("$author->name has books , unable to delete!");
                }
            }

            $deleted = Author::whereIn('id', $checkedIds)->delete();
            if (!$deleted) {
                return \Flash::error('sorry authors have\'nt  been deleted ?');
            }
        }

        \Flash::success(\Lang::get('backend::lang.list.delete_selected_success', [
            'name' => 'deleted '
        ]));


        return $this->listRefresh();
    }
}