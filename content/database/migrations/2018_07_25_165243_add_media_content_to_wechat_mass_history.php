<?php

use Royalcms\Component\Database\Schema\Blueprint;
use Royalcms\Component\Database\Migrations\Migration;

class AddMediaContentToWechatMassHistory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		RC_Schema::table('wechat_mass_history', function(Blueprint $table)
		{
            $table->integer('tag_id')->unsigned()->default('0')->comment('用户标签ID')->after('media_id');
            $table->text('content')->nullable()->comment('群发素材内容')->after('type');
            $table->integer('msg_data_id')->nullable()->comment('消息的数据ID，，该字段只有在群发图文消息时，才会出现。')->after('msg_id');
            $table->integer('msg_status')->nullable()->comment('消息发送后的状态，SEND_SUCCESS表示发送成功，SENDING表示发送中，SEND_FAIL表示发送失败，DELETE表示已删除')->after('msg_data_id');
            $table->text('copyright_check_result')->nullable()->comment('各个单图文校验结果')->after('errorcount');
            $table->tinyInteger('check_state')->default('0')->comment('整体校验结果，1-未被判为转载，可以群发，2-被判为转载，可以群发，3-被判为转载，不能群发')->after('copyright_check_result');
            $table->string('clientmsgid', 60)->nullable()->comment('使用 clientmsgid 参数，避免重复推送')->after('check_state');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		RC_Schema::table('wechat_mass_history', function(Blueprint $table)
		{
            $table->dropColumn('tag_id');
            $table->dropColumn('content');
            $table->dropColumn('msg_data_id');
            $table->dropColumn('msg_status');
            $table->dropColumn('copyright_check_result');
            $table->dropColumn('check_state');
            $table->dropColumn('clientmsgid');
		});
	}

}
