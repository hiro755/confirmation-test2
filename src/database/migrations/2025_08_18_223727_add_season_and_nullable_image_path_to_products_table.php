<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeasonAndNullableImagePathToProductsTable extends Migration
{
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        if (!Schema::hasColumn('products', 'season')) {
            $table->json('season')->nullable()->after('image_path');
        }

        $table->string('image_path')->nullable()->change(); // ← これは常に実行OK
    });
}
    public function down()
{
    Schema::table('products', function (Blueprint $table) {
        if (Schema::hasColumn('products', 'season')) {
            $table->dropColumn('season');
        }

        $table->string('image_path')->nullable(false)->change();
    });
}

}
