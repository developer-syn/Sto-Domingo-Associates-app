<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserSenderAndAdminSenderToChatMessagesTable extends Migration
{
    public function up()
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->string('user_sender')->nullable(); // Add user_sender column
            $table->string('admin_sender')->nullable(); // Add admin_sender column
        });
    }

    public function down()
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropColumn('user_sender'); // Drop user_sender column
            $table->dropColumn('admin_sender'); // Drop admin_sender column
        });
    }
}
