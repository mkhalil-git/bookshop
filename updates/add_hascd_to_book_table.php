<?php namespace Acme\BookShop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddHascdToBookTable extends Migration
{

    public function up()
    {
        Schema::table('acme_bookshop_books', function($table)
        {
            $table->boolean('hasCd')->nullable();
        });

    }

    public function down()
    {
        Schema::table('acme_bookshop_books', function($table)
        {
            $table->dropColumn('hasCd');
        });

    }

}
