<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFangattrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fangattrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pid')->default()->comment('上级id');
            $table->string('field_name', 50)->comment('字段名');
            $table->string('name', 50)->default()->comment('属性名称');
            $table->string('icon', 200)->default()->comment('图标');
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
        Schema::dropIfExists('fangattrs');
    }
}
