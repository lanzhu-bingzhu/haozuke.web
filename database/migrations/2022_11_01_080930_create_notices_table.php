<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('fangowner_id')->comment('房东id');
            $table->unsignedInteger('renting_id')->default(1)->comment('租客id');
            $table->dateTime('dtime')->nullable()->comment('时间');
            $table->string('cnt', 500)->default('')->comment('内容');
            $table->enum('status', ['0', '1'])->default('0')->comment('状态0未看，1已看或过期');
            $table->softDeletes();
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
        Schema::dropIfExists('notices');
    }
}
