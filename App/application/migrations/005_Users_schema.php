<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Users_schema extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type'           => 'INT',
				'constraint'     => 20,
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			),
			'role_id' => array(
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => TRUE
			),
			'username' => array(
				'type'           => 'VARCHAR',
				'constraint'     => 80
			),
			'nice_username' => array(
				'type'           => 'VARCHAR',
				'constraint'     => 80
			),
			'email' => array(
				'type'           => 'VARCHAR',
				'constraint'     => 80
			),
			'password' => array(
				'type'           => 'VARCHAR',
				'constraint'     => 140
			),
			'register_date' => array(
				'type'           => 'INT',
				'constraint'     => 11
			),
			'activation_key' => array(
				'type'           => 'TEXT'
			),
			'user_status' => array(
				'type'           => 'ENUM',
				'constraint'     => array('active', 'pending', 'banned'),
				'default'        => 'active'
			),
			'remember_me' => array(
				'type'           => 'TEXT'
			),
		));

		// Primary key
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('username', TRUE);

		$this->dbforge->create_table('users');
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}
}