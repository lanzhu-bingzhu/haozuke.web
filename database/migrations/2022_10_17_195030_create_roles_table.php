<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->id();
            $table->string('role_name', 20)->comment('角色名称');
            $table->string('role_desc', 255)->nullable()->comment('角色描述');
            $table->enum('is_static', ['0', '1'])->default('1')->comment('启用状态');
            $table->timestamps();
            $table->softDeletes();
            $table->index('role_name');
        });
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
