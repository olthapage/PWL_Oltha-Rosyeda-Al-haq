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
        Schema::table('t_penjualan_detail', function (Blueprint $table) {
            $table->decimal('total', 15, 2)->nullable(); 
        });
    }

    public function down()
    {
        Schema::table('t_penjualan_detail', function (Blueprint $table) {
            $table->dropColumn('total'); 
        });
    }
};
