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
        Schema::create('mlff_history', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ftdevice_id');
            $table->timestamp('fddeclaration');
            $table->boolean('fbdeclaration');
            $table->uuid('uuid_x_geo_mlff_id');
            $table->timestamp('fddeclaration_exit')->nullable();
            $table->uuid('uuid_x_geo_mlff_id_exit')->nullable();
            $table->index([
                'id','fddeclaration','fbdeclaration','uuid_x_geo_mlff_id',
                'fddeclaration_exit','uuid_x_geo_mlff_id_exit'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mlff_history');
    }
};
