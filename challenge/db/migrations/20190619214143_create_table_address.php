<?php

use \App\v1\Migration\Migration;

class CreateTableAddress extends Migration
{
    public function up()
    {
        $table = $this->table('address', ['id' => true, 'primary_key' => ['id']]);

        $table->addColumn('street', 'string', ['limit' => 200, 'null' => false]);
        $table->addColumn('number', 'integer', ['null' => false]);
        $table->addColumn('complement', 'string', ['limit' => 45, 'null' => true]);
        $table->addColumn('neighborhood', 'string', ['limit' => 100, 'null' => false]);
        $table->addColumn('city', 'string', ['limit' => 150, 'null' => false]);
        $table->addColumn('state', 'string', ['limit' => 2, 'null' => false]);
        $table->addColumn('zipcode', 'string', ['limit' => 8, 'null' => false]);
        $table->addColumn('deleted_at', 'timestamp', ['null' => true]);
        $table->addTimestamps();

        $table->save();
    }

    public function down()
    {
        $this->getSchema()->drop('address');
    }
}
