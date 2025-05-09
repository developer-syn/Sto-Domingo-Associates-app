<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveManagerIdFromContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_us', function (Blueprint $table) {
            if (Schema::hasColumn('contact_us', 'manager_id')) {
                $table->dropForeign(['manager_id']); // Drop foreign key if exists
                $table->dropColumn('manager_id'); // Drop the column
            }
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
            // If you want to add the column back in the future, uncomment the following lines
            // $table->unsignedBigInteger('manager_id')->nullable()->after('job_type');
            // $table->foreign('manager_id')->references('id')->on('manager_profiles')->onDelete('set null');
        });
    }
}
