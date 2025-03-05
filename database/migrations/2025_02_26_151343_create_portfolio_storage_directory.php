<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         $path = storage_path('app\public\portfolio');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       $path = storage_path('app\public\portfolio');

        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
    }
};
