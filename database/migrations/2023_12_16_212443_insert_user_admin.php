<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->insert(
            array(
                'firstname' => 'c',
                'lastname' => 'c',
                'email' => 'c@c.com',
                'password' => Hash::make('c'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status_id' => 1,
            )
        );
        DB::table('user_misc_info')->insert(
            array(
                'user_id' => '1'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
