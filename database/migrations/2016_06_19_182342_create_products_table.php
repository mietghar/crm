<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('products', function(Blueprint $table)
            {
                    $table->increments('id');
                    $table->string('name')->unique();
                    $table->string('category');
                    $table->float('price', 20);
                    $table->string('currency', 10);
                    $table->timestamps();
                    $table->softDeletes();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
