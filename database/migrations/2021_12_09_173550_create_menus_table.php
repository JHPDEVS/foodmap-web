<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('product_title');
            $table->string('date');
            $table->integer('product_id');
            $table->integer('kcal');
            $table->integer('kcal_per');
            $table->integer('pro');
            $table->integer('pro_per');   
            $table->integer('fat');
            $table->integer('fat_per');   
            $table->integer('fiber');
            $table->integer('fiber_per');   
            $table->integer('suger');
            $table->integer('suger_per');  
            $table->integer('col');
            $table->integer('col_per'); 
            $table->integer('po');
            $table->integer('po_per');
            $table->integer('trans');
            $table->integer('trans_per');  
            $table->integer('salt');
            $table->integer('salt_per'); 
            $table->integer('serve');       
            $table->foreignId('user_id')
                    ->constrained()
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
