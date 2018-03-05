<?php

use App\Enums\Roles;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('full_name')->nullable();
            $table->string('full_name_case')->nullable();
            $table->string('address')->nullable();
            $table->integer('blocked_by')->unsigned()->nullable();
            $table->boolean('is_blocked')->default(false);
            $table->text('blocked_description')->nullable();
            $table->integer('position_id')->unsigned();
            $table->enum('role', Roles::getAll());
            $table->rememberToken();
            $table->timestamps();
        });
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
