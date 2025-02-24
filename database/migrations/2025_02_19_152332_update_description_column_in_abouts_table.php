<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->text('description')->nullable()->change(); // Change to TEXT to allow more characters
        });
    }

    public function down()
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->string('description', 255)->nullable()->change(); // Revert if needed
        });
    }
};
