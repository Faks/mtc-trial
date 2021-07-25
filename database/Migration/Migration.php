<?php

declare(strict_types=1);

namespace Database\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Builder;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{
    public Capsule $capsule;

    public Builder $schema;

    public function init(): void
    {
        $this->capsule = new Capsule;
        $this->capsule->addConnection(
            [
                'driver' => 'mysql',
                'host' => DB_HOST,
                'port' => DB_PORT,
                'database' => DB_NAME,
                'username' => DB_USER,
                'password' => DB_PASSWORD,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ]
        );

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema('default');
    }
}