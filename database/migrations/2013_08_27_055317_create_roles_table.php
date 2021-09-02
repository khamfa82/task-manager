<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->integer('id',true);
            $table->string('role_name',35);
            $table->timestamps();
        });

        DB::table("roles")-> insert(
            [
               ["id"=>"1", "role_name"=>"Admin"],
               ["id"=>"2", "role_name"=>"User"]
            ]
            );
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
