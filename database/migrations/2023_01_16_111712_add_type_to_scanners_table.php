<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToScannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scanners', function (Blueprint $table) {
            $table->type('type')->default(1)->comments('1:scanner 2:gps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scanners', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
