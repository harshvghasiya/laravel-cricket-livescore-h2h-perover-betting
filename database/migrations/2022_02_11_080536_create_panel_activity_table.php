<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanelActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel_activity', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable()->comment('module name as a slug');
            $table->string('slug',255)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->tinyInteger('status')->comment('1=Active 0=Inactive')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('u_id')->nullable();
            $table->integer('admin_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panel_activity');
    }
}
