<?php

class m230222_124005_popup extends CDbMigration
{
	public function up()
	{
        $this->createTable('popup', array(
            'id' => 'pk',
            'title' => 'string NULL',
            'popup_text' => 'text NULL',
            'enabled' => 'integer DEFAULT 0 NOT NULL',
            'count_show' => 'integer DEFAULT 0 NOT NULL',
        ));
	}

	public function down()
	{
		echo "m230222_124005_popup does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}