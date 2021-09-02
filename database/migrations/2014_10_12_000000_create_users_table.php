<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer("role_id");
            $table->foreign("role_id")->references("id")->on("roles")->onUpdate("cascade")->onDelete("cascade");
            $table->string('name'); 
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile');
            $table->string('address');
            $table->longText("profile")->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                "id"=>"1",
                "role_id"=>"1",
                "name"=>"Khamis Abdalla",
                "email"=>"admin@shipco.com",
                "password"=>bcrypt("shipco@12345"),
                "mobile"=>"0773545566",
                "address"=>"Michenzani",
            ]

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
