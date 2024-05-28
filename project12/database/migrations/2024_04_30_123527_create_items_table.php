<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->string('brand');
            $table->string('picture')->nullable();
            $table->foreignId('item_group_id')->constrained(); 
            $table->boolean('status')->default(false);
            $table->string('serialnumber')->nullable();
            $table->timestamps();
        });
        
    }
    

    public function down()
    {
        Schema::dropIfExists('items');
    }
}
