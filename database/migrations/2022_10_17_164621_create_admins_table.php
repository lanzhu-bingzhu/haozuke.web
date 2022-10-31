<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username', 30)->comment('登录名');
            $table->string('password', 255)->comment('密码');
            $table->char('phone', 15)->comment('手机号');
            $table->string('email', 50)->comment('邮箱');
            $table->enum('sex', ['男', '女'])->default('男')->comment('性别');
            $table->enum('is_invoke', ['0', '1'])->default('1')->comment('是否启用');
            $table->timestamps();
            $table->softDeletes();
            // 索引
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
