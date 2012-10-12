<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Login_attempts_schema extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'BIGINT',
				'constraint'     => 20,
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'ip_address' => array(
				'type'           => 'VARCHAR',
				'constraint'     => 40
			),
			'username' => array(
				'type'           => 'VARCHAR',
				'constraint'     => 80
			),
			'time TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
		));

		// Primary key
		$this->dbforge->add_key('id', TRUE);

		$this->dbforge->create_table('login_attempts');
	}

	public function down()
	{
		$this->dbforge->drop_table('login_attempts');
	}
}