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
        Schema::create('x_geo_toll_route', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ftsection_name'); //NAMA
            $table->string('ftaddress'); //PROPINSI,KABUPATEN
            $table->string('fttype'); // Type
            $table->string('ftisland'); //Island
            $table->string('ftlength')->nullable(); //PANJANG
            $table->string('ftmanager')->nullable(); // Pengelola

            $table->string('ftstatus'); // STATUS
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->index([
                'id',
                'ftsection_name',
                'fttype',
                'created_at',
                'updated_at'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('x_geo_toll_route');
    }
};
