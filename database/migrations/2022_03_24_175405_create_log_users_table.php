<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_users', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('email_lama');
            $table->string('email_baru');
            $table->timestamps();
        });

        DB::unprepared('
                CREATE TRIGGER update_email_users 
                    BEFORE UPDATE 
                    ON users
                    FOR EACH ROW 
                BEGIN
                    INSERT INTO log_users
                    set nik = OLD.nik,
                    email_lama = OLD.email,
                    email_baru = NEW.email,
                    created_at = NOW();
                END
        ;');

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_users');
    }
}
