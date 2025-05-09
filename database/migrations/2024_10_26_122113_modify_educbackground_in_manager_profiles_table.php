<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('manager_profiles', function (Blueprint $table) {
            $table->text('educbackground')->nullable()->change(); // Change to TEXT and allow nulls
        });
    }

    public function down()
    {
        Schema::table('manager_profiles', function (Blueprint $table) {
            $table->string('educbackground')->nullable(false)->change(); // Change back to not nullable if needed
        });
    }
};
