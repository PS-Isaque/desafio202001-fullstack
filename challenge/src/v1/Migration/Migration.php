<?php

namespace App\v1\Migration;

use App\v1\Config\DB;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Builder;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{

    /** @var Manager $capsule */
    private $capsule;

    /** @var Builder $capsule */
    private $schema;

    /**
     * Load env variables
     */
    public function init()
    {
        $this->setCapsule(new Capsule());
        $this->getCapsule()->addConnection(DB::getEloquentMysqlConfig());
        //print_r(DB::getEloquentMysqlConfig()); exit;.

        $this->getCapsule()->bootEloquent();
        $this->getCapsule()->setAsGlobal();
        $this->setSchema($this->getCapsule()->schema());
    }

    /**
     * @return Manager
     */
    public function getCapsule(): Manager
    {
        return $this->capsule;
    }

    /**
     * @param Manager $capsule
     */
    public function setCapsule(Manager $capsule): void
    {
        $this->capsule = $capsule;
    }

    /**
     * @return Builder
     */
    public function getSchema(): Builder
    {
        return $this->schema;
    }

    /**
     * @param Builder $schema
     */
    public function setSchema(Builder $schema): void
    {
        $this->schema = $schema;
    }
}
