<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('房东姓名');
            $table->enum('sex', ['男', '女'])->default('男')->comment('性别');
            $table->unsignedInteger('age')->default(20)->comment('年龄');
            $table->char('phone', 15)->comment('手机号');
            $table->string('card', 20)->comment('身份证号码');
            $table->string('address', 100)->comment('家庭地址');
            $table->string('pic', 200)->comment('身份证照片');
            $table->string('email', 50)->comment('邮箱');
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
        Schema::dropIfExists('owners');
    }
}
