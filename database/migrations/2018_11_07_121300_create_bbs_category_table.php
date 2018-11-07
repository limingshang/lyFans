<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateBbsCategoryTable 帖子分类表
 */
class CreateBbsCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bbs_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name',20);
            $table->integer('admin_uid');
            $table->tinyInteger('status')->default(1);              //状态  1正常   0禁用  -1删除
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
        Schema::dropIfExists('bbs_category');
    }
}
