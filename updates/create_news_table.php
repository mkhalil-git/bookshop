<?php namespace Acme\Bookshop\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateNewsTable extends Migration
{

    public function up()
    {
        Schema::create('acme_bookshop_news', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('acme_bookshop_news');
    }

}
