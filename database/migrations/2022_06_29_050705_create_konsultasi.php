<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsultasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pengajuan_id')->unsigned();
            $table->date('tanggal');
            $table->text('file_konsultasi');
            $table->text('file_revisi');
            $table->text('keterangan');
            $table->string('status');
            $table->timestamps();
            $table->foreign('pengajuan_id')->references('id')->on('pengajuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konsultasi');
    }
}
