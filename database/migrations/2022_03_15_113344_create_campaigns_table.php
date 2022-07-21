<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('campaign_name', 50);
            $table->string('campaign_description', 150);
            $table->string('campaign_poster')->nullable();
            $table->boolean('is_campaign_goal_based')->default(true);
            $table->integer('campaign_goal_amount')->nullable();
            $table->date('campaign_start_date');
            $table->date('campaign_end_date')->nullable();
            $table->string('campaign_location')->default(json_encode("[]"));
            $table->boolean('campaign_has_cause')->default(false);
            $table->string('campaign_causes')->default(json_encode("[]"));
            $table->integer('campaign_status')->default(0);
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
        Schema::dropIfExists('campaigns');
    }
}
