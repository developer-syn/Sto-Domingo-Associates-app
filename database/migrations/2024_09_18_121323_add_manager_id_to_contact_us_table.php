<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManagerIdToContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_us', function (Blueprint $table) {
            // Add the manager_id column
            $table->unsignedBigInteger('manager_id')->nullable()->after('job_type');

            // Optionally, add a foreign key constraint if you want to enforce the relationship
            $table->foreign('manager_id')->references('id')->on('manager_profiles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_us', function (Blueprint $table) {
            // Remove the manager_id column and foreign key constraint
            $table->dropForeign(['manager_id']);
            $table->dropColumn('manager_id');
        });
    }
}
