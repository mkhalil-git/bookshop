<?php namespace Acme\BookShop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddOrdinalColumn extends Migration
{

    public function up()
    {
        Schema::table('acme_bookshop_authors', function($table)
        {
            $table->integer('ordinal')->nullable();
        });

        Schema::table('acme_bookshop_books', function($table)
        {
            $table->integer('ordinal')->nullable();
        });

        Schema::table('acme_bookshop_categories', function($table)
        {
            $table->integer('ordinal')->nullable();
        });

        Schema::table('acme_bookshop_levels', function($table)
        {
            $table->integer('ordinal')->nullable();
        });

        Schema::table('acme_bookshop_publishers', function($table)
        {
            $table->integer('ordinal')->nullable();
        });

        Schema::table('acme_bookshop_series', function($table)
        {
            $table->integer('ordinal')->nullable();
        });
    }

    public function down()
    {
        Schema::table('acme_bookshop_authors', function($table)
        {
            $table->dropColumn('ordinal')->nullable();
        });

        Schema::table('acme_bookshop_books', function($table)
        {
            $table->dropColumn('ordinal')->nullable();
        });

        Schema::table('acme_bookshop_categories', function($table)
        {
            $table->dropColumn('ordinal')->nullable();
        });

        Schema::table('acme_bookshop_levels', function($table)
        {
            $table->dropColumn('ordinal')->nullable();
        });

        Schema::table('acme_bookshop_publishers', function($table)
        {
            $table->dropColumn('ordinal')->nullable();
        });

        Schema::table('acme_bookshop_series', function($table)
        {
            $table->dropColumn('ordinal')->nullable();
        });
    }

}
