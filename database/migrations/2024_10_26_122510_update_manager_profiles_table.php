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
            $table->text('educbackground')->nullable()->change();
            $table->text('keyskills')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('manager_profiles', function (Blueprint $table) {
            $table->string('educbackground')->nullable()->change(); // change back if needed
            $table->string('keyskills')->nullable()->change(); // change back if needed
        });
    }

};
