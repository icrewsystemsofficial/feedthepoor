<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('setting')->delete();

        \DB::table('setting')->insert(array (
            0 =>
            array (
                'id' => 1,
                'group_id' => 1,
                'key' => 'app_name',
                'name' => 'App name',
                'description' => 'The application name',
                'value' => 'FeedThePoor v2',
                'core' => 1,
                'type' => 1,
                'created_at' => '2022-02-26 17:12:04',
                'updated_at' => '2022-02-26 17:12:04',
            ),
            1 =>
            array (
                'id' => 2,
                'group_id' => 1,
                'key' => 'app_description',
                'name' => 'App Description',
                'description' => 'The application description',
                'value' => 'FeedThePoor is an initiative started by icrewsystems.',
                'core' => 1,
                'type' => 2,
                'created_at' => '2022-02-26 17:12:59',
                'updated_at' => '2022-02-26 17:12:59',
            ),
            2 =>
            array (
                'id' => 3,
                'group_id' => 2,
                'key' => 'max_donation_amount',
                'name' => 'Max donation amount',
                'description' => 'The max amount to collect during donations',
                'value' => '10000',
                'core' => 1,
                'type' => 1,
                'created_at' => '2022-02-26 17:15:23',
                'updated_at' => '2022-02-26 17:16:01',
            ),
            3 =>
            array (
                'id' => 4,
                'group_id' => 2,
                'key' => 'min_donation_amount',
                'name' => 'Min donation amount',
                'description' => 'Minimum donation amount to collect on the frontend',
                'value' => '50',
                'core' => 1,
                'type' => 1,
                'created_at' => '2022-02-26 17:16:51',
                'updated_at' => '2022-02-26 17:16:51',
            ),
            4 =>
            array (
                'id' => 5,
                'group_id' => 1,
                'key' => 'razorpay_public_key',
                'name' => 'Razorpay API ID',
                'description' => 'Razorpay API\'s public ID',
                'value' => 'rzp_test_to39qfGxKHV2Ue',
                'core' => 1,
                'type' => 1,
                'created_at' => '2022-02-26 17:18:21',
                'updated_at' => '2022-02-26 17:18:21',
            ),
            5 =>
            array (
                'id' => 6,
                'group_id' => 1,
                'key' => 'razorpay_private_key',
                'name' => 'Razorpay API Secret',
                'description' => 'Razorpay API secret key',
                'value' => 'xJjApdknStHWgolBbfeZpFqP',
                'core' => 1,
                'type' => 1,
                'created_at' => '2022-02-26 17:19:35',
                'updated_at' => '2022-02-26 17:19:35',
            ),
        ));


    }
}
