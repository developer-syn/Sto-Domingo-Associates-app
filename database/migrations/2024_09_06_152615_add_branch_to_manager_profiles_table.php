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
            $table->string('branch')->nullable(); // Add branch column
        });
    }
    
    public function down()
    {
        Schema::table('manager_profiles', function (Blueprint $table) {
            $table->dropColumn('branch'); // Remove column if rollback
        });
    }
    
};
