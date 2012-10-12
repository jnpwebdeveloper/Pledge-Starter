<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Initial_schema extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'session_id' => array(
				'type' => 'VARCHAR',
				'constraint' => 40
			),
			'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => 45
			),
			'user_agent' => array(
				'type' => 'VARCHAR',
				'constraint' => 120
			),
			'last_activity' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'constraint' => 10
			),
			'user_data' => array(
				'type' => 'TEXT'
			),
		));

		// Primary key
		$this->dbforge->add_key('session_id', TRUE);

		$this->dbforge->create_table('sessions');

		$this->db->query('ALTER TABLE `sessions` ADD KEY `last_activity_idx` (`last_activity`)'); 
	}

	public function down()
	{
		$this->dbforge->drop_table('sessions');
	}
}