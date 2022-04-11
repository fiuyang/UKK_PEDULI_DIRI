<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAktifitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_aktifitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('aksi');
            $table->datetime('waktu');
            $table->integer('tipe');
            $table->timestamps();
        });

        DB::unprepared('
            CREATE OR REPLACE FUNCTION thapus_perjalanan()
            RETURNS trigger AS $$
            BEGIN
                INSERT INTO log_aktifitas (users_id,aksi, waktu,tipe) VALUES (old.users_id, CONCAT("menghapus Catatan Di lokasi: ", old.lokasi),now(),3 );
                RETURN old;
            END
            $$ LANGUAGE plpgsql;
            
            CREATE TRIGGER thapus_perjalanan
            BEFORE DELETE ON perjalanans
            FOR EACH ROW
            EXECUTE PROCEDURE thapus_perjalanan()
        ');

        // DB::unprepared('
        //     CREATE TRIGGER `thapus_perjalanan`
        //     BEFORE DELETE ON `perjalanans` 
        //     FOR EACH ROW 
        //     INSERT log_aktifitas(users_id,aksi, waktu,tipe) VALUES (old.users_id, CONCAT("menghapus Catatan Di lokasi: ", old.lokasi),now(),3 )
        // ;');

        // DB::unprepared('
        //     CREATE TRIGGER `tupdate_perjalanan` 
        //     BEFORE UPDATE ON `perjalanans` 
        //     FOR EACH ROW 
        //     INSERT log_aktifitas(users_id,aksi, waktu, tipe) VALUES (old.users_id ,CONCAT("mengubah Catatan Perjalanan Di lokasi: ", old.lokasi ,"Menjadi :", new.lokasi  ),now(), 2)
        // ;');

        // DB::unprepared('
        //     CREATE TRIGGER `tcreate_perjalanan` 
        //     BEFORE INSERT ON `perjalanans`
        //     FOR EACH ROW 
        //     INSERT log_aktifitas(users_id,aksi, waktu,tipe) VALUES (NEW.users_id,  CONCAT("Menambahkan Catatan Perjalanan Di lokasi : ", NEW.lokasi),now(), 1)
        // ;');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_aktifitas');
    }
}
