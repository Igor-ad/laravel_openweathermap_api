<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropDatabaseIfExists('testing');
        Schema::createDatabase('testing');
        DB::statement("CREATE TABLE `testing`.`users` LIKE `laravel`.`users`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropDatabaseIfExists('testing');
    }
};

