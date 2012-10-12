<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Permissions_roles_schema extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'permission_id' => array(
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned'       => TRUE
			),
			'role_id' => array(
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned'       => TRUE
			),
		));

		// Primary key
		$this->dbforge->add_key('permission_id', TRUE);
		$this->dbforge->add_key('role_id', TRUE);

		$this->dbforge->create_table('permissions_roles');
	}

	public function down()
	{
		$this->dbforge->drop_table('permissions_roles');
	}
}