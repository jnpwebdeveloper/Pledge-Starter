<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Projects_schema extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'INT',
				'constraint'     => '10',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type'       => 'INT',
				'constraint' => '10',
				'unsigned'   => TRUE
			),
			'name' => array(
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			),
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => '255'
			),
			'funding_target' => array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'default' => '0.00'
			),
			'funding_current' => array(
				'type' => 'DECIMAL',
				'constraint' => '10,2',
				'default' => '0.00'
			),
			'country_id' => array(
				'type'       => 'INT',
				'constraint' => '10',
				'default'    => '0'
			),
			'city' => array(
				'type'       => 'VARCHAR',
				'constraint' => '255'
			),
			'short_description' => array(
				'type' => 'TEXT'
			),
			'long_description' => array(
				'type' => 'TEXT'
			),
			'status' => array(
				'type'       => 'ENUM',
				'constraint' => array('active', 'expired-notfunded', 'expired-funded', 'pending', 'draft'),
				'default'    => 'active'
			)
			'start_date' => array(
				'type'    => 'DATETIME',
				'default' => NULL
			),
			'end_date' => array(
				'type'    => 'DATETIME',
				'default' => NULL
			),
			'created TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
		));

		// Primary key
		$this->dbforge->add_key('id', TRUE);

		$this->dbforge->create_table('projects');
	}

	public function down()
	{
		$this->dbforge->drop_table('projects');
	}
}