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
        Schema::create('x_gate_point', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ftname');
            $table->string('fttype');
            $table->string('ftdescription')->nullable();
            $table->float('fflat');
            $table->float('fflon');
            $table->timestamp('created_at');
            $table->index([
                'id',
                'ftname',
                'fttype',
                'fflat',
                'fflon',
                'created_at'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('x_gate_point');
    }
};
