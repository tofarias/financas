<?php

use Phinx\Migration\AbstractMigration;

class CreateCategoryCosts extends AbstractMigration
{
   public function up()
   {
       $categoryCosts = $this->table('category_costs');
       $categoryCosts->addColumn('name', 'string')
                     ->addColumn('created_at', 'datetime')
                     ->addColumn('updated_at', 'datetime')
                     ->save();
   }

   public function down()
   {
       $this->dropTable('category_costs');
   }
}
