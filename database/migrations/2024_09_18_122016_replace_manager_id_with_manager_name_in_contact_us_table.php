<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReplaceManagerIdWithManagerNameInContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_us', function (Blueprint $table) {
            // Drop the manager_id column if it exists
            if (Schema::hasColumn('contact_us', 'manager_id')) {
                $table->dropForeign(['manager_id']);
                $table->dropColumn('manager_id');
            }

            // Add the manager_name column if it does not exist
            if (!Schema::hasColumn('contact_us', 'manager_name')) {
                $table->string('manager_name')->nullable()->after('job_type');
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
            // Add the manager_id column back if it does not exist
            if (!Schema::hasColumn('contact_us', 'manager_id')) {
                $table->unsignedBigInteger('manager_id')->nullable()->after('job_type');
                $table->foreign('manager_id')->references('id')->on('manager_profiles')->onDelete('set null');
            }

            // Remove the manager_name column if it exists
            if (Schema::hasColumn('contact_us', 'manager_name')) {
                $table->dropColumn('manager_name');
            }
        });
    }
}
