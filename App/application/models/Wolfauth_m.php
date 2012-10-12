<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wolfauth_m extends CI_Model {

	/**
	 * Get User
	 *
	 * Get a user via their username
	 * 
	 * @access public
	 * @param string $email - Email address
	 * @return Object on success, False on failure
	 *
	 */
	public function get_user($username)
	{
		$this->db->select(''.$this->db->dbprefix.'users.*, '.$this->db->dbprefix.'roles.role_name, '.$this->db->dbprefix.'roles.role_display_name');
		$this->db->where(''.$this->db->dbprefix.'users.username', $username);
		$this->db->join('roles', ''.$this->db->dbprefix.'roles.role_id = '.$this->db->dbprefix.'users.role_id');

		$user = $this->db->get('users', 1, 0);

		return ($user->num_rows() == 1) ? $user : FALSE;
	}

	/**
	 * Get User By ID
	 *
	 * Get a user via their user ID
	 * 
	 * @access public
	 * @param int $user_id - User ID
	 * @return Object on success, False on failure
	 *
	 */
	public function get_user_by_id($user_id)
	{
		$this->db->select(''.$this->db->dbprefix.'users.*, '.$this->db->dbprefix.'roles.role_name, '.$this->db->dbprefix.'roles.role_display_name');
		$this->db->where(''.$this->db->dbprefix.'users.id', $user_id);
		$this->db->join('roles', ''.$this->db->dbprefix.'roles.role_id = '.$this->db->dbprefix.'users.role_id');
		
		$user = $this->db->get('users', 1, 0);

		return ($user->num_rows() == 1) ? $user : FALSE;
	}

	/**
	 * Get User By Email
	 *
	 * Get a user via their email
	 * 
	 * @access public
	 * @param string $email - Email address
	 * @return Object on success, False on failure
	 *
	 */
	public function get_user_by_email($email)
	{
		$this->db->select(''.$this->db->dbprefix.'users.*, '.$this->db->dbprefix.'roles.role_name, '.$this->db->dbprefix.'roles.role_display_name');
		$this->db->where(''.$this->db->dbprefix.'users.email', $email);
		$this->db->join('roles', ''.$this->db->dbprefix.'roles.role_id = '.$this->db->dbprefix.'users.role_id');
		
		$user = $this->db->get('users', 1, 0);

		return ($user->num_rows() == 1) ? $user : FALSE;
	}

	/**
	 * Add User
	 *
	 * Add a new user into the database
	 * 
	 * @access public
	 * @param string $email - Email address
	 * @param string $password - Hashed password
	 * @param enum $status - The status of the inserted user
	 * @param array $addition_data - User meta to insert (if any)
	 * @return Insert ID on success or False on failure
	 *
	 */
	public function add_user($username, $nicename, $email, $password, $role_id = 1, $status = "active", $additional_data = array())
	{
		$data = array(
			'role_id'       => $role_id,
			'username'      => $username,
			'nice_username' => $nicename,
			'email'         => $email,
			'password'      => $password,
			'register_date' => time(),
			'user_status'   => $status,
		);

		// Insert into the users table
		$this->db->insert('users', $data);

		// If we have user meta to insert
		if (!empty($additional_data) AND $this->db->insert_id())
		{
			$this->add_user_meta($this->db->insert_id(), $additional_data);
		}

		// Return a result
		return ($this->db->insert_id()) ? $this->db->insert_id() : FALSE;
	}
	
	/**
	 * Update User
	 *
	 * Updates a user in the database with optional argument
	 * for updating user meta as well.
	 *
	 * @access public
	 * @param array $user_data - Users table data to update
	 * @param array $additional_data - Additional meta to update
	 * @return bool - True on success or false on failure
	 *
	 */
	public function update_user($user_data = array(), $additional_data = array())
	{
		// We need an ID to perform updates
		if (isset($user_data['id']))
		{
			// If we have a password, then hash it
			if (isset($user_data['password']))
			{
				$user_data['password'] = $this->wolfauth->hash($user_data['password']);
			}

			// Update the user data
			$this->db->where('id', $user_data['id']);
			$this->db->update('users', $user_data);

			// Updating any user meta?
			if (!empty($additional_data))
			{
				// Add the user data if new, update old if existing data
				$this->add_user_meta($user_data['id'], $additional_data);
			}

			// If any rows were changed we successfully updated
			if ($this->db->affected_rows() >= 1)
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * Add User Meta
	 *
	 * Adds or updates user meta for a particular user
	 * in the user meta table.
	 *
	 * @param int $user_id - User ID
	 * @param array $meta - An array of data to update
	 * @return bool - True on success or False on failure
	 *
	 */
	public function add_user_meta($user_id, $meta)
	{
		// Empty array for user meta data
		$data = array();

		// Iterate over the meta and construct a more DB appropriate array
		foreach ($meta AS $field_name => $field_value)
		{
			$data[] = array(
				'user_id'     => $user_id,
				'umeta_key'   => $field_name,
				'umeta_value' => $field_value
			);
		}

		// Batch insert the meta
		$this->db->insert_batch('user_meta', $data);

		return ($this->db->affected_rows() >= 1) ? TRUE : FALSE;
	}

	/**
	 * Retrieve user meta for a particular user
	 * in the user meta table.
	 *
	 * @param  integer $user_id User ID
	 * @return array
	 */
	public function get_user_meta($user_id)
	{
		$data = array();

		$this->db->where('user_id', $user_id);
		$this->db->from('user_meta');

		$meta = $this->db->get();

		if ($meta->num_rows() >= 1)
		{
			foreach ($meta->result() AS $row)
			{
				$data[$row->umeta_key] = $row->umeta_value;
			}
		}

		return (object) $data;
	}

    /**
     * Get the number of login attempts by a particular user
     * from the database based on username and password
     * 
     * @access  public
     * @param   string $username The username
     * @return  integer          Number of login attempts
     */
    public function get_login_attempts($username, $ip_address)
    {
        $this->db->where('ip_address', $ip_address);
        $this->db->or_where('username', $username);

        $query = $this->db->get('login_attempts');

        return $query->num_rows();
    }

    /**
     * Increase the number of login attempts a user has tried
     * 
     * @access protected
     * @param  string $username [description]
     * @return void
     */
    public function increase_login_attempts($username, $ip_address)
    {
        $this->db->insert('login_attempts', array('ip_address' => $ip_address, 'username' => $username));
    }

    /**
     * Clear any attempts by a user to login, as well as any login attempts
     * that have expired.
     * 
     * @access protected 
     * @param  string  $username The username to clear login attempts for
     * @param  integer $expires  Expiry time in seconds for old attempts
     * @return void
     */
    public function clear_login_attempts($username, $expires, $ip_address) 
    {
        $this->db->where(array('ip_address' => $ip_address, 'username' => $username));
        $this->db->or_where('UNIX_TIMESTAMP(time) <', time() - $expires);
        $this->db->delete('login_attempts');
    }

    /**
     * Flushes old login attempts out of the login attempts table
     * 
     * @param  integer $expiry Expiry date in seconds
     * @return void
     */
    public function flush_login_attempts($expiry = 900)
    {
    	$this->db->where('UNIX_TIMESTAMP(time) <', time() - $expires);
    	$this->db->delete('login_attempts');
    }

    /**
     * Generate an auth code for user activation
     * and password resets.
     * 
     * @param  string $email The email address of the user
     * @return string        The generated auth code
     */
    public function create_auth_code($email)
    {
        $activation_key = md5( microtime().'-'.rand(10,10000).'-'.$email );
        
        $this->db->where('email', $email);
        $this->db->update('users', array('activation_key' => $activation_key));
        
        return $activation_key;
    }

    /**
     * Check a supplied auth code exists
     * 
     * @param  string $email The email address of the user
     * @param  string $code  The auth code
     * @return boolean       Return true if the code exists, otherwise false
     */
    public function check_auth_code($email, $code)
    {
        $query = $this->db->get_where('users', array('email' => $email, 'activation_key' => $code)); 
        return ($query->num_rows() == 1) ? TRUE : FALSE;
    }

    function generate_password($email)
    {
        $new_password = substr( strtoupper( md5( microtime().'-'.rand(100,10000) ) ),0,6 );
        
        if( $this->db->update('users',array('password' => md5($new_password),'lostpw' => ''),array('email' => $email)) )
        {
            return $new_password;
        }
    }

}