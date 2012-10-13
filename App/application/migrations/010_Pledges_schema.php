<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Pledges_schema extends CI_Migration {

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
			'user_id' => array(
				'type'       => 'INT',
				'constraint' => 10,
				'unsigned'   => TRUE
			),
			'reward_id' => array(
				'type'       => 'INT',
				'constraint' => 10,
				'unsigned'   => TRUE
			),
			'pledge_amount' => array(
				'type' => 'DECIMAL',
				'constraint' => array(10,2),
				'default' => 0,
				'unsigned' => FALSE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 120
			),
			'address_line_1' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'address_line_2' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'state' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'city' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'postal_code' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'phone_number' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'country' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'created TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
		));

		// Primary key
		$this->dbforge->add_key('id', TRUE);

		$this->dbforge->create_table('pledges');
	}

	public function down()
	{
		$this->dbforge->drop_table('pledges');
	}
}