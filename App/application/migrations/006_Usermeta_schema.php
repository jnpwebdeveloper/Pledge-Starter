<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Usermeta_schema extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'umeta_id' => array(
				'type'           => 'BIGINT',
				'constraint'     => 20,
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type'           => 'BIGINT',
				'constraint'     => 20,
				'unsigned'       => TRUE
			),
			'umeta_key' => array(
				'type'           => 'VARCHAR',
				'constraint'     => 255
			),
			'umeta_value' => array(
				'type'           => 'LONGTEXT'
			),
		));

		// Primary key
		$this->dbforge->add_key('umeta_id', TRUE);

		$this->dbforge->create_table('user_meta');
	}

	public function down()
	{
		$this->dbforge->drop_table('user_meta');
	}
}