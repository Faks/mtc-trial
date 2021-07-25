<?php

use Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

class UsersMigration extends Migration
{
    public function up(): void
    {
        $this->schema
            ->create(
                'users',
                function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('username')->nullable();
                    $table->string('password')->nullable();
                    $table->timestamp('created_at')->nullable();
                    $table->timestamp('updated_at')->nullable();
                }
            );
    }

    public function down(): void
    {
        $this->schema->dropIfExists('users');
    }
}