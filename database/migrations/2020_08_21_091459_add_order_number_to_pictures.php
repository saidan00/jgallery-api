<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderNumberToPictures extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('pictures', function (Blueprint $table) {
            $table->integer('orderNumber');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropColumn('orderNumber');
        });
    }
}
