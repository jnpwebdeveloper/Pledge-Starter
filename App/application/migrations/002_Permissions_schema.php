<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Permissions_schema extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'permission_id' => array(
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'permission_string' => array(
				'type'       => 'VARCHAR',
				'constraint' => 255
			),
		));

		// Primary key
		$this->dbforge->add_key('permission_id', TRUE);
		$this->dbforge->add_key('permission_string', TRUE);

		$this->dbforge->create_table('permissions');
	}

	public function down()
	{
		$this->dbforge->drop_table('permissions');
	}
}