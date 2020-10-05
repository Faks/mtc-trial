<?php

use Illuminate\Database\Schema\Blueprint;
use src\Migration\Migration;

class UsersMigration extends Migration
{
    public function up()
    {
        $this->schema->create(
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

    public function down()
    {
        $this->schema->dropIfExists('users');
    }
}