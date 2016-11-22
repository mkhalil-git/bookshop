<?php namespace Acme\BookShop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateBooksTable extends Migration
{

    public function up()
    {
        Schema::create('acme_bookshop_books', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('title')->unique();
            $table->string('slug')->unique()->index();
            // $table->string('image');
            $table->decimal('price');
            $table->integer('numberOfPages');
            $table->string('language');
            $table->string('ISBN');
            $table->date('publishDate');
            $table->text('shortDescription');
            $table->text('description');
            
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('acme_bookshop_authors')->onDelete('cascade');

            $table->integer('publisher_id')->unsigned();
            $table->foreign('publisher_id')->references('id')->on('acme_bookshop_publishers')->onDelete('cascade');

            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('acme_bookshop_levels')->onDelete('cascade');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('acme_bookshop_categories')->onDelete('cascade');

            $table->integer('series_id')->unsigned()->nullable();
            $table->foreign('series_id')->references('id')->on('acme_bookshop_series')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('acme_bookshop_books');
    }

}
