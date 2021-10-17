<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeaturesToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->json('email_verified_at')
                  ->after('email')
                  ->nullable;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

}
