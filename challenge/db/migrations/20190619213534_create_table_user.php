<?php

use \App\v1\Migration\Migration;

class CreateTableUser extends Migration
{
    public function up()
    {
        $table = $this->table('user', ['id' => true, 'primary_key' => ['id']]);

        $table->addColumn('name', 'string', ['null' => true, 'default' => null]);
        $table->addColumn('email', 'string', ['limit' => 320, 'null' => true, 'default' => null]);
        $table->addColumn('deleted_at', 'timestamp', ['null' => true]);
        $table->addTimestamps();

        $table->save();
    }

    public function down()
    {
        $this->getSchema()->drop('user');
    }
}
