<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('packages', 'image')) {
            Schema::table('packages', function (Blueprint $table) {
                $table->string('image')->nullable()->after('requirements');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('packages', 'image')) {
            Schema::table('packages', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
};


