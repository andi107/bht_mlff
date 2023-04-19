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
        Schema::table('mlff_history', function($table) {
            $table->timestamp('fddeclaration_exit')->nullable();
            $table->uuid('uuid_x_geo_mlff_id_exit')->nullable();
            $table->index([
                'fddeclaration_exit','uuid_x_geo_mlff_id_exit'
            ]);
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
