<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailMobileDescriptionCityToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            // Add mobile column
            if (!Schema::hasColumn('users', 'mobile')) {
                $table->string('mobile')->nullable()->after('email'); // Mobile number can be nullable
            }
            // Add description column
            if (!Schema::hasColumn('users', 'description')) {
                $table->text('description')->nullable()->after('mobile'); // Description can be nullable
            }
            // Add city column
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city')->nullable()->after('description'); // City can be nullable
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
