<?php
/*
Plugin Name: LH Personalised Content
Version: 1.2
Plugin URI: http://lhero.org/plugins/lh-personalised-content/
Description: Creates a shortcodes for personalised content that can be used on your website of your WordPress emails
Author: Peter Shaw
Author URI: http://shawfactor.com
*/

class LH_personalised_content_plugin {

//action shortcodes in title is shortcode exists

public function the_title_filter( $title, $id = null ) {

if (has_shortcode( $title, 'lh_personalised_content' )){

$title = do_shortcode($title);

}

return $title;
}


function check_user(){

if ($GLOBALS['lh_personalised_user']){

$current_user = $GLOBALS['lh_personalised_user'];

} else {

$current_user = wp_get_current_user();


}

if ($current_user->ID){

return $current_user;

} else {


return false;


}




}

function strReplaceAssoc(array $replace, $subject) {
   return str_replace(array_keys($replace), array_values($replace), $subject);   
} 

function return_sender_user($to){


$emailArray = explode(',', str_replace(' ', '', $to));

$result = count($emailArray);

if ($result > 1){

// There is more than one recipient

return false;

} else {

if ($user = get_user_by('email', $emailArray[0])){


// The recipient is in the system

return $user;


} else {


// The recipient is not in the system

return false;


}

}


}


function wp_mail_filter( $args ) {

$subject = $args['subject'];


if ((has_shortcode( $args['message'], 'lh_personalised_content' )) or (has_shortcode( $args['subject'], 'lh_personalised_content' )) ) {


if ($user = $this->return_sender_user($args['to'])){

$GLOBALS['lh_personalised_user'] = $user;


} else {


$GLOBALS['lh_personalised_user'] = "none";


}


$args['subject'] = do_shortcode($args['subject']);


$args['message'] = do_shortcode($args['message']);




}


	$new_wp_mail = array(
		'to'          => $args['to'],
		'subject'     => $args['subject'],
		'message'     => $args['message'],
		'headers'     => $args['headers'],
		'attachments' => $args['attachments'],
	);
	
	return $new_wp_mail;
}

function lh_personalised_content_output($atts,$content = null) {

    // define attributes and their defaults
    extract( shortcode_atts( array (
        'role' => '', //Allow matching of roles, this functionality will be added later
        'loggedout' => ''
    ), $atts ) );


if ($current_user = $this->check_user()){


$add = $current_user->data;

//print_r($current_user);


foreach ($add as $key => $value) {

$newkey = "%".$key."%";

$newarray[$newkey] = $value;

}

$newarray['%first_name%'] = get_user_meta( $add->ID, 'first_name', true );

$newarray['%last_name%'] = get_user_meta( $add->ID, 'last_name', true );

$newarray['%description%'] = get_user_meta($add->ID, 'description', true);


$content = $this->strReplaceAssoc($newarray, $content);



} else {


$content = $loggedout;


}

return $content;

}



function register_shortcodes(){

add_shortcode('lh_personalised_content', array($this,"lh_personalised_content_output"));

}





function __construct() {

add_filter( 'wp_mail', array($this,"wp_mail_filter"));
add_action( 'init', array($this,"register_shortcodes"));
add_filter( 'the_title', array($this,"the_title_filter"));


}


}

$lh_personalised_content = new LH_personalised_content_plugin();


?>