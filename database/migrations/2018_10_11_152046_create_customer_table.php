<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('uid');
            $table->string('username', 50)->unique();   // 用户名
            $table->string('nickanem', 50)->unique();   // 用户昵称
            $table->string('password', 50);             // 用户密码MD5加密
            $table->integer('birthday');                // 用户出生日期
            $table->string('sign', 255);                // 用户签名
            $table->integer('regTime');                 // 用户注册时间
            $table->integer('regIP');                   // 用户注册ip
            $table->tinyInteger('source');              // 用户来源 0普通用户
            $table->tinyInteger('sex');                 // 性别：0未知、1男、2女
            $table->tinyInteger('status');              // 状态：0正常1已禁用
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
        Schema::dropIfExists('customer');
    }
}
