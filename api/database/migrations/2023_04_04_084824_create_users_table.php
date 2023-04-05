<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
                
            $table->uuid('uid')->primary();
            $table->string('email',100)->unique();
            $table->string('password',255);
            $table->string('ftfirst_name',20)->nullable();
            $table->string('ftlast_name',20)->nullable();
            
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->integer('fnstatus');
            $table->index([
                'uid',
                'email',
                'created_at',
                'updated_at',
            ]);
        });
        $_id = '72252c8a-8947-4300-b933-90609c37a55d'; // Str::uuid();
        DB::table('users')
        ->insert([
            'uid' => $_id,
            'email' => 'dev.track@bht.co.id',
            'password' => Hash::make('@AdminXroot1'),
            'ftfirst_name' => 'Administrator',
            'ftlast_name' => 'root',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'fnstatus' => 1
        ]);
        DB::table('x_devices')
        ->update([
            'uuid_customer_id' => $_id
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
