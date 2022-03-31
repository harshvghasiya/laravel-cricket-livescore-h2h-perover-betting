<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRightModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('right_modules', function (Blueprint $table) {
            $table->id();
            $table->integer('right_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('module_id')->nullable();
            $table->tinyInteger('status')->comment('1=Active 0=Inactive')->default(1);
            
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
        Schema::dropIfExists('right_modules');
    }
}
