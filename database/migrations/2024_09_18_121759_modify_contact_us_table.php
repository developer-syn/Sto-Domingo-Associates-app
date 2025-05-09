<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_us', function (Blueprint $table) {
            // Check if column exists before adding
            if (!Schema::hasColumn('contact_us', 'manager_id')) {
                $table->unsignedBigInteger('manager_id')->nullable()->after('job_type');
            }

            if (!Schema::hasColumn('contact_us', 'manager_name')) {
                $table->string('manager_name')->nullable()->after('manager_id');
            }

            // Add branch column if it doesn't exist
            if (!Schema::hasColumn('contact_us', 'branch')) {
                $table->string('branch')->nullable()->after('manager_name');
            }

            // Add foreign key if not already present
            if (!Schema::hasColumn('contact_us', 'manager_id')) {
                $table->foreign('manager_id')->references('id')->on('manager_profiles')->onDelete('set null');
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
            // Drop foreign key and columns if they exist
            if (Schema::hasColumn('contact_us', 'manager_id')) {
                $table->dropForeign(['manager_id']);
                $table->dropColumn(['manager_id', 'manager_name', 'branch']);
            }
        });
    }
}
