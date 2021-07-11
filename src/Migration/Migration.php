<?php
/**
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks
 *******************************************
 * Company Name: Solum DeSignum
 * Company Website: http://solum-designum.com
 * Company GitHub: https://github.com/SolumDeSignum
 ********************************************************
 * Date: 2018.10.04.
 * Time: 13:56
 */

namespace src\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Builder;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{
    public Capsule $capsule;

    public Builder $schema;

    public function init()
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