<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerjalanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjalanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam');
            $table->text('lokasi');
            $table->float('suhu_tubuh');
            $table->timestamps();
        });

        $procedure = "DROP PROCEDURE IF EXISTS `get_by_id`;
                    CREATE PROCEDURE `get_by_id` (IN `id` INT)
                    BEGIN
                        SELECT * FROM perjalanans WHERE id = id;
                    END;";
        DB::unprepared($procedure);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perjalanans');
    }
}
