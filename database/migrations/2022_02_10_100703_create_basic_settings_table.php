<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id')->nullable();
            $table->string('logo',100)->nullable();
            $table->string('favicon',100)->nullable();
            $table->string('website_title',100)->nullable();
            $table->string('base_color',100)->nullable();
            $table->string('support_phone',100)->nullable();
            $table->string('support_email',100)->nullable();
            $table->string('footer_logo',100)->nullable();
            $table->string('newsletter_text',100)->nullable();
            $table->string('footer_text',255)->nullable();
            $table->string('contact_address',255)->nullable();
            $table->string('contact_number',255)->nullable();
            $table->string('latitude',255)->nullable();
            $table->string('longitude',255)->nullable();
            $table->string('google_recaptcha_site_key',255)->nullable();
            $table->string('google_recaptcha_secret_key',255)->nullable();
            $table->text('google_analytics_script')->nullable();
             $table->string('to_mail',100)->nullable();
            $table->string('from_mail',100)->nullable();
            $table->string('is_smtp',100)->nullable();
            $table->string('smtp_host',100)->nullable();
            $table->string('smtp_port',100)->nullable();
            $table->string('encryption',100)->nullable();
            $table->string('smtp_username',100)->nullable();
            $table->string('smtp_password',100)->nullable();
            $table->tinyInteger('smtp_status')->comment('1=Active 0=Inactive')->default(1);
            $table->tinyInteger('status')->comment('1=Active 0=Inactive')->default(1);
            $table->tinyInteger('is_analytics')->comment('1=Active 0=Inactive')->default(1);
            $table->tinyInteger('is_recaptcha')->comment('1=Active 0=Inactive')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->integer('created_by')->nullable();

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
        Schema::dropIfExists('basic_settings');
    }
}
