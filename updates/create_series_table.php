<?php namespace Acme\BookShop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSeriesTable extends Migration
{

    public function up()
    {
        Schema::create('acme_bookshop_series', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('slug')->unique()->index();
            // $table->string('image');
            $table->decimal('price');
            $table->text('shortDescription');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('acme_bookshop_series');
    }

}
