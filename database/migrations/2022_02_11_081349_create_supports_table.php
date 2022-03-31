<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('mobile',255)->nullable();
            $table->text('subject')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->comment('1=Active 0=Inactive')->default(1);
            $table->tinyInteger('mark_as_read')->comment('0=Not Read 1=Read ')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supports');
    }
}
