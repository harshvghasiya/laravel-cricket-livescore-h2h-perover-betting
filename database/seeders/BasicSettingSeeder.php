<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BasicSetting;

class BasicSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$resu=BasicSetting::first();
    	if ($resu !=null) {
    	 return false;
    	}

        $res=new BasicSetting;
        $res->language_id=169;
        $res->favicon='164394831540369813-96DB-458F-BBE6-2F40A5BB4F79.jpg';
        $res->logo='1643948403ram (1).jpg';
        $res->website_title='ActionsPet';
        $res->is_recaptcha=0;
        $res->google_recaptcha_site_key='6Lev_V4eAAAAAKIfB7n6zbFMMTxjB0c6bNFq2Ry6';
        $res->google_recaptcha_secret_key='6Lev_V4eAAAAALnIliBNggPQHYG0P7PGMnQcTKO1';
        $res->to_mail='harshvghasiya15@gmail.com';
        $res->from_mail='harshvghasiya14@gmail.com';
        $res->smtp_host='smtp.gmail.com';
        $res->smtp_port='587';
        $res->encryption='TLS';
        $res->smtp_username='harshvghasiya14@gmail.com';
        $res->smtp_password='harshvgha@20';
        $res->smtp_status=1;
        $res->save();
    }
}
