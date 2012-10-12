<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Roles_schema extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'role_id' => array(
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'role_name' => array(
				'type'           => 'VARCHAR',
				'constraint'     => 120
			),
			'role_display_name' => array(
				'type'           => 'VARCHAR',
				'constraint'     => 160
			),
		));

		// Primary key
		$this->dbforge->add_key('role_id', TRUE);
		$this->dbforge->add_key('role_name', TRUE);

		$this->dbforge->create_table('roles');
	}

	public function down()
	{
		$this->dbforge->drop_table('roles');
	}
}