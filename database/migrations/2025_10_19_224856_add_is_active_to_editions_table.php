<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('editions', function (Blueprint $table) {
            $table->boolean('is_active')->default(false)->after('title');
        });
    }

    public function down()
    {
        Schema::table('editions', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
