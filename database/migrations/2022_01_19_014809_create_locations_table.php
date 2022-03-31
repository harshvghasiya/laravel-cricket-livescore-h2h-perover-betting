<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->integer('contact_id')->nullable();
            $table->text('name')->nullable();
            $table->text('address_1')->nullable();
            $table->text('address_2')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('is_main_location')->default(0);
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('locations');
    }
}
