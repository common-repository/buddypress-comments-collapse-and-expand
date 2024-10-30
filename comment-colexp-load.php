<?php
/*
Plugin Name: BuddyPress Comments collapse and expand
Description: Buddypress Comments Collapse and Expand. Have a "show comments" option after specified number of comments is reached.
Author: TimothyJunior
Author URI: http://buddypress.org/community/members/timothyjunior
Plugin URI: http://buddypress.org/community/groups/buddypress-comments-collapse-and-expand
Version: 0.3

License: CC-GNU-GPL http://creativecommons.org/licenses/GPL/2.0/
Donate: http://bit.ly/kp6b4s
*/

function bp_colexp_init() {
	require( dirname( __FILE__ ) . '/comment-colexp.php' );
}
add_action( 'bp_init', 'bp_colexp_init' );
?>