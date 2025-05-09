<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_fb_embeds_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFbEmbedsTable extends Migration
{
    public function up()
    {
        Schema::create('fb_embeds', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->text('embed_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fb_embeds');
    }
}
