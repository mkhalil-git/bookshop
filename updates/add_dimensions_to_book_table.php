<?php namespace Acme\BookShop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddDimensionsToBookTable extends Migration
{

    public function up()
    {
        Schema::table('acme_bookshop_books', function($table)
        {
            $table->double('height')->nullable();
        });

        Schema::table('acme_bookshop_books', function($table)
        {
            $table->double('width')->nullable();
        });
    }

    public function down()
    {
        Schema::table('acme_bookshop_books', function($table)
        {
            $table->dropColumn('height');
        });

        Schema::table('acme_bookshop_books', function($table)
        {
            $table->dropColumn('width');
        });
    }

}
