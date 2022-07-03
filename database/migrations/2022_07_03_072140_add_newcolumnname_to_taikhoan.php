<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewcolumnnameToTaikhoan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('taikhoan', 'Token')) {
            Schema::table('taikhoan', function (Blueprint $table) {
                $table->string("Token", 2000)->nullable(); // set default null
            });
        }
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taikhoan', function (Blueprint $table) {
           
        });
    }
}
