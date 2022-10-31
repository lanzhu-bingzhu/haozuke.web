<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->id();
            $table->string('username', 30)->comment('用户名');
            $table->string('password', 255)->comment('密码');
            $table->string('email', 50)->nullable()->comment('邮箱');
            $table->string('truename', 50)->comment('真实姓名');
            $table->char('phone', 15)->comment('手机号');
            $table->enum('sex', ['男', '女'])->default('男')->comment('性别');
            $table->char('last_ip', 20)->nullable()->comment('最后登陆的ip');
            $table->timestamps();
            $table->softDeletes();
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
