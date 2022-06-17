<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichMuonPhongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichmuonphong', function (Blueprint $table) {
            $table->id();
            $table->string('NgayMuon', 20);
            $table->string('TietHoc', 50);
            $table->string('MaPhong', 20);
            $table->string('MaGiangVien', 20);
            $table->integer('Sync')->default(0);
            $table->string('GhiChu', 100);
            $table->foreign('MaPhong')->references('MaPhong')->on('phong');
            $table->foreign('MaGiangVien')->references('MaGiangVien')->on('giangvien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lichmuonphong');
    }
}
