<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wolfauth {

	public $CI;

	// An array of valid user permissions
	protected $_permissions = array();

	protected $_messages = array();
	protected $_errors   = array();
	protected $_config   = array();

    protected $ip_address;

	public function __construct()
	{
        // Codeigniter instance
		$this->CI =& get_instance();

        // Load models, libraries, helpers and hands
        $this->init();

        // Get the users IP address
        $this->ip_address = $this->CI->input->ip_address();

        // Empty out any messages/errors
        $this->_messages = array();
        $this->_errors   = array();

		// Load the config file
		$this->CI->config->load('wolfauth');

		// Store the config options locally
		$this->_config = $this->CI->config->item('wolfauth');

		// Get permissions for the current user ID (if any)
		$this->_populate_permissions();

		// Do we remember this user and want to log them in?
		$this->_check_remember_me();
	}

    protected function init()
    {
        // Load needed Codeigniter Goodness
        $this->CI->load->database();

        // Load our language file
        $this->CI->lang->load('wolfauth');

        if (!class_exists('CI_Session'))
        {
            $this->CI->load->library('session');   
        }
        
        $this->CI->load->helper('session');
        $this->CI->load->helper('cookie');
        $this->CI->load->helper('url');
        $this->CI->load->helper('wolfauth');

        if (!class_exists('CI_Email'))
        {
            $this->CI->load->library('email');    
        }

        if (!class_exists('wolfauth_m'))
        {
            $this->CI->load->model('wolfauth_m');
        }

        if (!class_exists('wolfauth_roles_m'))
        {
            $this->CI->load->model('wolfauth_roles_m', 'roles_m');
        }

        if (!class_exists('wolfauth_permissions_m'))
        {
            $this->CI->load->model('wolfauth_permissions_m', 'permissions_m');
        }
    }

	/**
	 * User ID
	 *
	 * Returns user ID of currently logged in user
	 *
	 * @access public
	 * @return mixed (user ID on success or false on failure)
	 *
	 */
	public function user_id()
	{
		return $this->CI->session->userdata('user_id');
	}

	/**
	 * Return the current user role name
	 *
	 * @access public
	 * @return mixed (role name on success or false on failure)
	 *
	 */
	public function user_role()
	{
		return $this->CI->session->userdata('role_name');
	}

	/**
	 * Is the currently logged in user an admin?
	 *
	 * @access public
	 * @return bool - True if user is an admin, false if not
	 *
	 */
	public function is_admin()
	{
		$role = $this->user_role();

		return (in_array($role, $this->_config['roles.admin'])) ? TRUE : FALSE;
	}

	/**
	 * Is there a currently logged in user?
	 * Hellooooo?
	 *
	 * @access public
	 * @return bool - True on success or False on failure
	 *
	 */
	public function logged_in()
	{
		return (!$this->user_id()) ? FALSE : TRUE;
	}

	/**
	 * Log a user in via their username
	 *
	 * @param string $username - Username
	 * @param string $password - Password unencrypted
	 * @param string $redirect_to - The location to redirect to
	 *
	 */
	public function login($username, $password, $redirect_to = '')
	{
		// Find the user
		$user = get_user(strtolower($username));

		// If we have a user
		if ($user)
		{
            if ($this->get_login_attempts($user->row('username'), $this->ip_address) !== $this->_config['login.max_attempts'])
            {
    			// Passwords match
    			if ($this->hash($password) === $user->row('password'))
    			{
                    $this->clear_login_attempts($user->row('username'));

    				$this->CI->session->set_userdata(array(
    					'user_id'       => $user->row('id'),
    					'username'      => $user->row('username'),
                        'nice_username' => $user->row('nice_username'),
    					'role_id'       => $user->row('role_id'),
    					'role_name'     => $user->row('role_name')
    				));

    				// Remember me?
    				if ($this->CI->input->post('remember_me') == 'yes')
    				{
    					$this->_set_remember_me($user->row('id'));
    				}

    				// If we want to redirect somewhere
    				if ($redirect_to !== '')
    				{
    					redirect($redirect_to, 'refresh');
    				}

    				return TRUE;
    			}
    			else
    			{
                    $this->increase_login_attempts($user->row('username'));
                    $this->set_error(lang('wolfauth.details_not_found'));
    				return FALSE;
    			}
            }
            else
            {
                $this->set_error(lang('wolfauth.login_attempts_exceeded'));   
                return FALSE;
            }
		}
        else
        {
            $this->set_error(lang('wolfauth.details_not_found'));
        }

		return FALSE;
	}

	/**
	 * Forcefully login as any user without needing
	 * a password or any other details.
	 *
	 * @access public
	 * @param string $username - Username
	 * @return bool - True on success or False on failure
	 *
	 */
	public function force_login($username)
	{
		$user = get_user($username);

		if ($user)
		{
			$this->CI->session->set_userdata(array(
				'user_id'       => $user->row('id'),
				'username'      => $user->row('username'),
                'nice_username' => $user->row('nice_username'),
				'role_id'       => $user->row('role_id'),
				'role_name'     => $user->row('role_name')
			));

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Logout
	 *
	 * That's right, it logs you out.
	 *
	 * @access public
	 * @param string $redirect_to - Redirect after logging out
	 * @return bool - True on success or False on failure
	 *
	 */
	public function logout($redirect_to = '')
	{
		$user_id = $this->user_id();

		delete_cookie('rememberme');

		$user_data = array(
			'id'          => $user_id,
			'remember_me' => ''
		);

        $this->CI->session->set_userdata(array(
            'user_id'       => FALSE,
            'username'      => FALSE,
            'nice_username' => FALSE,
            'role_id'       => FALSE,
            'role_name'     => FALSE
        ));

		// Update the user
		if ($this->CI->wolfauth_m->update_user($user_data))
		{
			// If we want to redirect somewhere
			if ($redirect_to !== '')
			{
				redirect($redirect_to, 'refresh');
			}

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Add User
	 *
	 * Insert a new user into the users table.
	 *
	 * @access public
	 * @param $username
	 * @param $email
	 * @param $password
	 * @param $role_id
	 * @param $additional_data
	 * @return mixed
	 *
	 */
	public function add_user($username, $email, $password, $role_id = 1, $status = "active", $additional_data = array())
	{
		// Hash the password ASAP
		$password = $this->hash($password);

        // The user submitted username is the nice name to preserve casing
        $nicename = $username;

        // Lowercase the username
        $username = strtolower($username);

		// Call the add user function and return the result
		return $this->CI->wolfauth_m->add_user($username, $nicename, $email, $password, $role_id, $status, $additional_data);
	}

    /**
     * Does the user have a permission to do something?
     *
     * @access public
     * @param $permission
     * @return bool
     */
    public function user_can($permission)
    {
    	// Refresh permissions if we somehow logged in but didn't update
    	$this->_populate_permissions();

        // Is the permission in our array of allowed role permissions?
        return (in_array($permission, $this->_permissions)) ? TRUE : FALSE;
    }

	/**
	 * Does a particular user have a role?
	 *
     * @access public
	 * @param  integer $user_id The user ID to check
     * @return bool
	 */
	public function has_role($user_id, $role_id)
	{
		$user = get_user_by_id($user_id);

		if ($user)
		{
			if ($role_id == $user->row('role_id'))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

    /**
     * Add a new role into the roles table
     *
     * @access public
     * @param  string $role_name The name of the role (lowercased slug)
     * @param  string $role_display_name
     * @return mixed
     */
	public function add_role($role_name, $role_display_name = '')
	{
		return $this->CI->roles_m->add_role($role_name, $role_display_name);
	}

    /**
     * Get users permissions as an array
     *
     * @access public
     * @param  integer $user_id The user ID to query
     * @return mixed
     */
	public function get_user_permissions($user_id)
	{
		return $this->CI->permissions_m->get_user_permissions($user_id);
	}

    /**
     * Get all permissions assigned to a role
     *
     * @access public
     * @param  integer $role_id The role ID to query
     * @return mixed
     */
	public function get_role_permissions($role_id)
	{
		return $this->CI->permissions_m->get_role_permissions($role_id);
	}

    /**
     * Add a new permission to the permissions table
     *
     * @access public
     * @param string $permission The permission string to add
     * @return mixed
     */
	public function add_permission($permission)
	{
		return $this->CI->permissions_m->add_permission($permission);
	}

    /**
     * Update an existing permission in the database
     *
     * @access public
     * @param  array $data An array of data to update
     * @return mixed
     */
	public function update_permission($data)
	{
		return $this->CI->permissions_m->update_permission($data);
	}

    /**
     * Delete a permission via its permission string
     * from the permissions table.
     *
     * @access public
     * @param  string $permission The permission string to delete
     * @return mixed
     */
	public function delete_permission($permission)
	{
		return $this->CI->permissions_m->delete_permission($permission);
	}

    /**
     * Delete a permission by it's ID
     * from the permissions table.
     *
     * @param  integer $permission_id The permission ID to delete
     * @return mixed
     */
	public function delete_permission_by_id($permission_id)
	{
		return $this->CI->permissions_m->delete_permission_by_id($permission_id);
	}

    /**
     * Get user meta for a particular user from the user_meta
     * table.
     *
     * @param  integer $user_id The user ID to get meta for
     * @return array
     */
    public function get_user_meta($user_id)
    {
        return $this->CI->wolfauth_m->get_user_meta($user_id);
    }

	/**
	 * Hashes a password using hmac
	 *
	 * @access public
	 * @param  string $value The value to has (usually a password)
	 */
	public function hash($value)
	{
		return hash_hmac($this->_config['hash.method'], $value, $this->_config['hash.key']);
	}

	/**
     * Populate the permissions array for the
     * currently logged in user.
     *
     * @access private
     * @return void
     */
	private function _populate_permissions()
	{
		$this->_permissions = $this->CI->permissions_m->get_user_permissions($this->user_id());
	}

	/**
	 * Updates the remember me cookie and database information
	 *
	 * @access  private
	 * @param	integer $user_id The user ID to remember
	 * @return	void
	 */
	private function _set_remember_me($user_id)
	{
		$this->CI->load->library('encrypt');

		$token = md5(uniqid(rand(), TRUE));
		$timeout = 60 * 60 * 24 * 7; // One week

		$remember_me = $this->CI->encrypt->encode($user_id.':'.$token.':'.(time() + $timeout));

		// Set the cookie and database
		$cookie = array(
			'name'		=> 'rememberme',
			'value'		=> $remember_me,
			'expire'	=> $timeout
		);

		set_cookie($cookie);
		$this->CI->wolfauth_m->update_user(array('id' => $user_id, 'remember_me' => $remember_me));
	}

	/**
	 * Checks if a user is logged in and remembered
	 *
	 * @access	private
	 * @return	bool
	 */
	private function _check_remember_me()
	{
		$this->CI->load->library('encrypt');

		// Is there a cookie to eat?
		if($cookie_data = get_cookie('rememberme'))
		{
			$user_id = '';
			$token   = '';
			$timeout = '';

			$cookie_data = $this->CI->encrypt->decode($cookie_data);
			
			if (strpos($cookie_data, ':') !== FALSE)
			{
				$cookie_data = explode(':', $cookie_data);
				
				if (count($cookie_data) == 3)
				{
					list($user_id, $token, $timeout) = $cookie_data;
				}
			}

			// Cookie expired
			if ((int) $timeout < time())
			{
				return FALSE;
			}

			if ($data = get_user_by_id($user_id))
			{
				// Set session values
				$this->CI->session->set_userdata(array(
					'user_id'   => $user_id,
					'username'  => $data->row('email'),
					'role_id'   => $data->row('role_id'),
					'role_name' => $data->row('role_name')
				));

				$this->_set_remember_me($user_id);

				return TRUE;
			}

			delete_cookie('rememberme');
		}

		return FALSE;
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
        return $this->CI->wolfauth_m->get_login_attempts($username, $ip_address);
    }

    /**
     * Increase the number of login attempts a user has tried
     * 
     * @access protected
     * @param  string $username [description]
     * @return void
     */
    protected function increase_login_attempts($username)
    {
        if (empty($this->ip_address))
        {
            return;
        }

        $this->CI->wolfauth_m->increase_login_attempts($username, $this->ip_address);
    }

    /**
     * Clear any attempts by a user to login, as well as any login attempts
     * that have expired.
     * 
     * @access protected 
     * @param  string  $username The username to clear login attempts for
     * @param  integer $expires  Expiry time in seconds for old attempts 900 seconds (15 minutes)
     * @return void
     */
    protected function clear_login_attempts($username, $expires = 900) 
    {
        if (empty($this->ip_address))
        {
            return;
        }
    
        $this->CI->wolfauth_m->clear_login_attempts($username, $expires, $this->ip_address);
    }

    /**
     * Sets an error message
     *
     * @param  string $msg The error message(s)
     * @return void
     */
    public function set_error($msg)
    {
        // Do we have multiple errors?
        if (is_array($msg))
        {
            foreach ($msg AS $error)
            {
                $this->_errors[] = $error;
            }

            return;
        }

        // Just a single error, sir
        $this->_errors[] = $msg;
    }

    /**
     * Display error messages
     *
     * @param string $before
     * @param string $after
     * @return bool|string
     */
    public function auth_errors($before = '<p class="error">', $after = '</p>')
    {
        $html = FALSE;

        if ( ! empty($this->_errors))
        {
            foreach ($this->_errors AS $error)
            {
                $html .= $before.$error.$after;
            }
        }

        return $html;
    }

}