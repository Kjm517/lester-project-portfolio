<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('experiences', function (Blueprint $table) {
            $table->integer('start_month')->after('start_year');
            $table->integer('end_month')->after('end_year');
        });
    }

    public function down() {
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn(['start_month', 'end_month']);
        });
    }
};

?>

