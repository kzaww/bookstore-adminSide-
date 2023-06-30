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

        Schema::create('authurs', function (Blueprint $table) {
            $table->id('author_id');
            $table->string('author_name');
            $table->string('author_image')->nulllable();
            $table->longText('bio');
            $table->timestamps();
        });

        schema::rename('authurs','authors');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authurs');
    }
};
