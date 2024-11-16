<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdGerejaToPenggunaTable extends Migration
{
    public function up()
    {
        Schema::table('pengguna', function (Blueprint $table) {
            $table->char('id_gereja', 36)->nullable()->after('id');

            // Menambahkan constraint foreign key jika perlu
            $table->foreign('id_gereja')->references('id')->on('gereja')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('pengguna', function (Blueprint $table) {
            // Hapus constraint foreign key terlebih dahulu
            $table->dropForeign(['id_gereja']);

            // Baru kemudian hapus kolomnya
            $table->dropColumn('id_gereja');
        });
    }
}
