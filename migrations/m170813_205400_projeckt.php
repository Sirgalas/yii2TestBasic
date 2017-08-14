<?php

use yii\db\Migration;

class m170813_205400_projeckt extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170813_205400_projeckt cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.*/
    public function up()
    {
        $this->createTable('{{%image}}',[
            'id'=>$this->primaryKey(),
            'id_post'=>$this->integer()->notNull(),
            'path'=>$this->string(610)->notNull(),
            'name'=>$this->string(610)->notNull(),
        ]) ;

        $this->createTable('message_user',[
            'id'=>$this->primaryKey(),
            'id_user'=>$this->integer()->notNull(),
            'viewd'=>'ENUM("не прочитано", "прочитано")',
            'fromMessage'=>$this->integer()->notNull(),
            'subject'=>$this->string(255)->notNull(),
            'text'=>$this->text()->notNull(),
            'preview'=>$this->string(610),
            'id_post'=>$this->integer()->notNull(),

        ]) ;
        $sqlMessage = "ALTER TABLE `message_user` CHANGE `viewd` `viewd` ENUM('не прочитано','прочитано') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'не прочитано';";
        $this->execute($sqlMessage);

        $this->createTable('post',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(255)->notNull(),
            'alias'=>$this->string(610)->notNull(),
            'content'=>$this->text()->notNull(),
            'preview'=>$this->string(610),
            'create_at'=>$this->integer()->notNull(),
            'update_at'=>$this->integer()->notNull(),
            'autor_id'=>$this->integer()->notNull(),
            'status'=>'ENUM("active", "blocked")',
        ]) ;
        $sqlPost = "ALTER TABLE `post` CHANGE `status` `status` ENUM('active','blocked') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'active'";
        $this->execute($sqlPost);
    }

    public function down()
    {
        $this->dropTable('{{%image}}');
        $this->dropTable('message_user');
        $this->dropTable('post');
    }

}
