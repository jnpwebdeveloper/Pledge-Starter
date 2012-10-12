<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Rewards_schema extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'project_id' => array(
				'type'       => 'INT',
				'constraint' => 10,
				'unsigned'   => TRUE
			),
			'name' => array(
				'type'           => 'VARCHAR',
				'constraint'     => 255
			),
			'description' => array(
				'type' => 'TEXT'
			),
			'price' => array(
				'type' => 'DECIMAL',
				'constraint' => array(10,2),
				'default' => 0,
				'unsigned' => FALSE
			),
			'quantity' => array(
				'type'       => 'INT',
				'constraint' => 10,
				'unsigned'   => TRUE,
				'default'    => 0
			),
			'status' => array(
				'type'       => 'ENUM',
				'constraint' => array('active', 'soldout'),
				'default'    => 'active'
			),
			'created TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
		));

		// Primary key
		$this->dbforge->add_key('id', TRUE);

		$this->dbforge->create_table('rewards');
	}

	public function down()
	{
		$this->dbforge->drop_table('rewards');
	}
}