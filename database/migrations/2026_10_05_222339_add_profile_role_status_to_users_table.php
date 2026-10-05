<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'first_name');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->after('first_name');

            $table->foreignId('role_id')
                ->after('password')
                ->constrained('roles');

            $table->boolean('status')
                ->default(true)
                ->after('role_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['last_name', 'role_id', 'status']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('first_name', 'name');
        });
    }
};