<?php namespace Acme\BookShop;

use Backend;
use System\Classes\PluginBase;

/**
 * BookShop Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'BookShop',
            'description' => 'book shop for alex publisher',
            'author'      => 'Acme',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        // return []; // Remove this line to activate

        return [
            'Acme\BookShop\Components\HomeBlocksBooks' => 'booksBLock',
            'Acme\BookShop\Components\HomeBlocksSeries' => 'seriesBLock',
            'Acme\BookShop\Components\HomeBlocksBooksByEntity' => 'booksByEntityBlock',
            'Acme\BookShop\Components\Productslist' => 'productsList',
            'Acme\BookShop\Components\Serieslist' => 'seriesList',
            'Acme\BookShop\Components\News' => 'newsList',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'acme.bookshop.some_permission' => [
                'tab' => 'BookShop',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        // return []; // Remove this line to activate

        return [
            'bookshop' => [
                'label'       => 'BookShop',
                'url'         => Backend::url('acme/bookshop/books'),
                'icon'        => 'icon-leaf',
                'permissions' => ['acme.bookshop.*'],
                'order'       => 500,


            'sideMenu' => [
                'author' => [
                    'label'       => 'Author',
                    'icon'        => 'icon-copy',
                    'url'         => Backend::url('acme/bookshop/authors'),
                    'permissions' => ['acme.bookshop.*']
                ],
                'publisher' => [
                    'label'       => 'publisher',
                    'icon'        => 'icon-copy',
                    'url'         => Backend::url('acme/bookshop/publishers'),
                    'permissions' => ['acme.bookshop.*']
                ],

                'level' => [
                    'label'       => 'level',
                    'icon'        => 'icon-copy',
                    'url'         => Backend::url('acme/bookshop/levels'),
                    'permissions' => ['acme.bookshop.*']
                ],

                'category' => [
                    'label'       => 'category',
                    'icon'        => 'icon-copy',
                    'url'         => Backend::url('acme/bookshop/categories'),
                    'permissions' => ['acme.bookshop.*']
                ],

                'series' => [
                    'label'       => 'series',
                    'icon'        => 'icon-copy',
                    'url'         => Backend::url('acme/bookshop/series'),
                    'permissions' => ['acme.bookshop.*']
                ],
                 'news' => [
                    'label'       => 'news',
                    'icon'        => 'icon-copy',
                    'url'         => Backend::url('acme/bookshop/news'),
                    'permissions' => ['acme.bookshop.*']
                ],
            ]



            ],

            


        ];
    }

}
