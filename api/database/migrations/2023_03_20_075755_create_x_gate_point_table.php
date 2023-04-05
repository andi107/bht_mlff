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
            $table->string('ftsection');
            $table->string('ftdescription')->nullable();
            $table->float('fflat');
            $table->float('fflon');
            $table->integer('fnpayment_type');
            $table->timestamp('created_at');
            $table->index([
                'id',
                'ftname',
                'ftsection',
                'fflat',
                'fflon',
                'fnpayment_type',
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
