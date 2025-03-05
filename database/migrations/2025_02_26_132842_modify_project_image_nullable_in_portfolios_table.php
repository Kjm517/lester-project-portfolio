<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('project_image')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('project_image')->nullable(false)->change();
        });
    }
};
