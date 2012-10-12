<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * API
 *
 * The API interfacing library for the various social platforms
 *
 * @package   Bandlytics
 * @author    Dwayne Charrington
 * @copyright Copyright (c) 2012 Dwayne Charrington and Github contributors
 * @link      http://ilikekillnerds.com
 * @license   http://www.apache.org/licenses/LICENSE-2.0.html
 * @version   1.0
 */

class Api {

    protected $CI;
    
    public function __construct()
    {
        // Codeigniter instance and other required libraries/files
        $this->CI =& get_instance();
    }

    public function get_last_fm_artist($artist_name)
    {
        $api_url = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=".$artist_name."&api_key=701e02a8dc18a62976ec2d56995e3015&format=json";

        // JSON decode the REST request
        $api_response = json_decode(file_get_contents($api_url));

        // Return data
        $return_data = array();

        if ($api_response)
        {
            // Get our needed data for the artist
            $return_data = array(
                'playcount' => $api_response->artist->stats->playcount,
                'listeners' => $api_response->artist->stats->listeners
            );
        }

        // Return the data or empty array if none
        return $return_data;
    }

}
