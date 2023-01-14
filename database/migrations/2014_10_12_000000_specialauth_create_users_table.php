<?php
namespace Seblhaire\Specialauth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpecialauthCreateUsersTable extends Migration
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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('roles', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name');
           $table->timestamps();
           $table->softDeletes();
       });
       Schema::create('role_user', function (Blueprint $table) {
           $table->integer('role_id');
           $table->integer('user_id');
           $table->index('role_id');
           $table->index('user_id');
       });
       Schema::create('user_hash', function (Blueprint $table) {
           $table->integer('user_id');
           $table->string('hash', 32);
           $table->index('hash');
           $table->index('user_id');
       });
       Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('profile_user', function (Blueprint $table) {
            $table->integer('user_id')->index();
            $table->integer('profile_id')->index();
            $table->json('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::dropIfExists('password_resets');
        Schema::drop('roles');
        Schema::drop('role_user');
        Schema::drop('user_hash');
        Schema::drop('profiles');
        Schema::drop('profile_user');
    }
}
