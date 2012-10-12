<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function send_notice($email, $subject, $message)
{
    $CI =& get_instance();
    
    $CI->load->library('email');
    $config['charset'] = 'utf-8';
    $config['mailtype'] = 'html';
    $CI->email->initialize($config);

        
    $CI->email->from( config('site_email') , $CI->config->item('site_name') );
    $CI->email->to( $email );
        
    $CI->email->subject( $subject );
    $CI->email->message( $message );
        
    $CI->email->send();
    $CI->email->clear();    
}