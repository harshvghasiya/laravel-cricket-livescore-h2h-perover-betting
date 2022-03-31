<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name',40)->nullable();
            $table->string('pin_code',40)->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->tinyInteger('status')->comment('1=Active 0=Inactive')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
