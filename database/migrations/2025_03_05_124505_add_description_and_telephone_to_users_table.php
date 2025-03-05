<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('description')->nullable(); // Adding a nullable description column
            $table->string('telephone'); // Adding a telephone column (not nullable)
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['description', 'telephone']); // Removing both columns on rollback
        });
    }
};

    