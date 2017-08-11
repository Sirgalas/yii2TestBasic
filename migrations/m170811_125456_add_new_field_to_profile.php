<?php

use yii\db\Migration;
use yii\db\Schema;
class m170811_125456_add_new_field_to_profile extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%profile}}', 'email_massage', Schema::TYPE_SMALLINT);
        $this->addColumn('{{%profile}}', 'broweser_massage', Schema::TYPE_SMALLINT);
    }

    public function safeDown()
    {
        echo "m170811_125456_add_new_field_to_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170811_125456_add_new_field_to_user cannot be reverted.\n";

        return false;
    }
    */
}
