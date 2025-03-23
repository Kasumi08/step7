<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->integer('company_id');
                $table->string('product_name');
                $table->integer('price');
                $table->integer('stock');
                $table->text('comment')->nullable();
                $table->string('img_path')->nullable();
                $table->timestamps();
            });
        }        

        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->string('company_name');
                $table->string('street_address')->nullable();
                $table->string('representative_name')->nullable();
                $table->timestamps();
            });
        }
        
        if (!Schema::hasTable('sales')) {
            Schema::create('sales', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('product_id');		
                $table->timestamps();	
            });
        }    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
