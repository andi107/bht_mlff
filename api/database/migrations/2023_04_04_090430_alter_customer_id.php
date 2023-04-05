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
        Schema::table('x_geo_declare', function($table) {
            $table->uuid('uuid_customer_id')->nullable();
        });
        Schema::table('debuging_routes', function($table) {
            $table->uuid('uuid_customer_id')->nullable();
        });
        Schema::table('geo_history', function($table) {
            $table->uuid('uuid_customer_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
