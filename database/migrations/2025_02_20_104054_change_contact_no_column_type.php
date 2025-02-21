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
        Schema::table('students', function (Blueprint $table) {
            $table->string('contact_no', 20)->change(); // Change to VARCHAR(20)
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->bigInteger('contact_no')->change(); // Revert if needed
        });
    }
};
