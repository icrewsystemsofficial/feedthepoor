<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Donations;
use App\Models\Campaigns;

class DonationChanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donations', function($table){
            $table->unsignedBigInteger('campaign_id')->references('id')->on('campaigns')->nullable();
            $table->unsignedBigInteger('cause_id')->references('id')->on('causes')->nullable()->change();
            $table->string('cause_name')->nullable()->change();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donations', function($table) {
            $table->dropColumn('campaign');
        });   
    }
}
