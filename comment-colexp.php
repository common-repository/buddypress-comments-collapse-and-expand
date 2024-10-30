<?php
/*
 * Make sure BuddyPress is loaded before we do anything.
 */
if ( !function_exists( 'bp_core_install' ) ) {
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'buddypress/bp-loader.php' ) ) {
		require_once ( WP_PLUGIN_DIR . '/buddypress/bp-loader.php' );
	} else {
		add_action( 'admin_notices', 'bp_colexp_install_buddypress_notice' );
		return;
	}
}

function bp_colexp_install_buddypress_notice() {
	echo '<div id="message" class="error fade "><p style="line-height: 150%">';
	_e('<strong>BuddyPress Comments collapse and expand</strong></a> requires the BuddyPress plugin to work. Please <a href="http://buddypress.org/download">install BuddyPress</a> first, or <a href="plugins.php">deactivate BuddyPress Comment collapse and expand</a>.');
	echo '</p></div>';
}


/*
 * admin settings
 */
require ( dirname( __FILE__ ) . '/admin.php' );

/**
 * bp_colexp_activity_filter()
 *
 * Allow comments to collapse/expand in activity stream.
 *
 */
function bp_colexp_activity_filter() {

if ( !bp_is_activity_permalink() && intval(bp_activity_get_comment_count()) !='0' && intval(bp_activity_get_comment_count()) >= get_option('Ccount') && bp_is_activity_front_page()) { ?>

<script type="text/javascript">
$(document).ready(function(){

		$("li#activity-<?php bp_activity_id() ?> div.activity-comments ul").hide();

		$("li#activity-<?php bp_activity_id() ?> a.acomment-reply").click(function(){
                     if ( $("p.collapse-<?php bp_activity_id() ?>").css("display") == 'none' ){

			$("p.expand-<?php bp_activity_id() ?>, p.collapse-<?php bp_activity_id() ?>, li#activity-<?php bp_activity_id() ?> div.activity-comments ul").toggle(100);

                        }
                       return true;
                    });

		$("p.expand-<?php bp_activity_id() ?> a").click(function(){

			$("p.expand-<?php bp_activity_id() ?>, p.collapse-<?php bp_activity_id() ?>, li#activity-<?php bp_activity_id() ?> div.activity-comments ul").toggle(100);
                   return false;

                });

		$("p.collapse-<?php bp_activity_id() ?> a").click(function(){

			$("p.expand-<?php bp_activity_id() ?>, p.collapse-<?php bp_activity_id() ?>, li#activity-<?php bp_activity_id() ?> div.activity-comments ul").toggle(100);
                   return false;

                });

               $("li#activity-<?php bp_activity_id() ?> input[name=ac_form_submit]").click(function(){

                     if ( $("p.collapse-<?php bp_activity_id() ?>").css("display") == 'none' ){

			$("p.expand-<?php bp_activity_id() ?>, p.collapse-<?php bp_activity_id() ?>, li#activity-<?php bp_activity_id() ?> div.activity-comments ul").toggle(100);

                        }
                     return true;
                });

        });
</script>

                   <div class="expandable">

	             <p class="expand-<?php bp_activity_id() ?>"><a href="#">Show Comments<?php if (get_option('Xcount')==1){ echo '('; echo bp_activity_comment_count(); echo ')'; } ?></a></p>

	                 <p style="display:none" class="collapse-<?php bp_activity_id() ?>"><a href="#">Hide Comments</a></p>

                         </div>

<?php	} else {
	}
}
add_action('bp_before_activity_entry_comments', 'bp_colexp_activity_filter', 999);


/**
 * bp_colplex_scripts()
 *
 * Includes the Javascript and css.
 *
 */
function bp_colexp_scripts() {
if (bp_is_activity_front_page()) {
  wp_enqueue_script( "buddypress-comments-collapse-expand", path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) )."/bp-colexp.js"), array( 'jquery' ) );
}
}
add_action('wp_print_scripts', 'bp_colexp_scripts');


function bp_colexp_insert_head() {
 if (bp_is_activity_front_page()) { ?>
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js "> </script> 
<link href="<?php bloginfo('wpurl'); ?>/wp-content/plugins/buddypress-comments-collapse-and-expand/css1.css" media="screen" rel="stylesheet" type="text/css"/>
<?php 
  }
}
add_action('wp_head', 'bp_colexp_insert_head');

?>