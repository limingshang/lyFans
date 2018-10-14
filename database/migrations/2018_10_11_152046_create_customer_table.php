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
            $table->string('username', 50)->unique()->comment('用户名');                    // 用户名
            $table->string('nickname', 50)->default('')->comment('用户昵称');               // 用户昵称
            $table->string('password', 50)->default('')->comment('用户密码MD5加密');        // 用户密码MD5加密
            $table->integer('birthday')->default(0)->comment('用户出生日期');               // 用户出生日期
            $table->string('sign', 255)->default('')->comment('用户签名');                  // 用户签名
            $table->integer('regTime')->default(0)->comment('用户注册时间');                // 用户注册时间
            $table->string('regIP', 50)->default('')->comment('用户注册ip');                // 用户注册ip
            $table->tinyInteger('source')->default(0)->comment('用户来源 0普通用户');       // 用户来源 0普通用户
            $table->tinyInteger('sex')->default(0)->comment('性别：0未知、1男、2女');       // 性别：0未知、1男、2女
            $table->tinyInteger('status')->default(0)->comment('状态：0正常1已禁用');       // 状态：0正常1已禁用
            $table->integer('created_at')->default(0)->comment('增加时间');
            $table->integer('updated_at')->default(0)->comment('修改时间');
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
