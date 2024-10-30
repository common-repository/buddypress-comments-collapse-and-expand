<?php

add_action('admin_menu', 'my_plugin_menu');
add_action( is_multisite() ? 'network_admin_menu' : 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	add_submenu_page( 'bp-general-settings', 'Comment Collapse/Expand', 'Bp Comments', 'manage_options', 'bp-colexp', 'my_plugin_options');
	
	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
	//register our settings
	register_setting( 'my_plugin_options', 'Ccount' );
	register_setting( 'my_plugin_options', 'Xcount' );
}

function my_plugin_options() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
				
	}
	
?>

			<?php if ( !empty( $_GET['updated'] ) ) : ?>
				<div id="message" class="updated">
					<p><strong><?php _e('settings saved.', 'bpce' ); ?></strong></p>
				</div>
			<?php endif; ?>

<script type="text/javascript">
      <!--
      function isNumberKey(evt)
      {
         var inCode = (evt.which) ? evt.which : event.keyCode
         if (inCode > 31 && (inCode < 48 || inCode > 57))
            return false;

         return true;
      }
      //-->


</script>
<div class="wrap">
<h2><?php _e('BuddyPress Comments Collapse/Expand Settings', 'bpce') ?></h2>

<p><?php _e('Please specify the number of comments (0-9) you would like to show before applying the collapse and expand effect.', 'bpce') ?></p>

<form method="post" action="<?php echo admin_url('options.php');?>">
<?php wp_nonce_field('update-options'); ?>

<table class="form-table">
<tr valign="top">
<th scope="row">Comment Count</th>
<td><input type="text" name="Ccount" maxlength="1" style="width:20px"  onkeypress="return isNumberKey(event)"  value="<?php if (get_option('Ccount')!='') { echo get_option('Ccount'); } ?>"/></td>
</tr>
<tr valign="top">
<th scope="row">Check this if you want the Comment number "Show Comments(#)".</th>
<td><input type="checkbox" name="Xcount" value="1" <?php if (get_option('Xcount')==1) echo 'checked="checked"'; ?>/></td>
</tr>
</table>



<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="Ccount,Xcount" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
<div style="float:left;line-height:225%">If you think it's worth it. </div> <div style="float:left"> <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form></div>

</div>

<?php
}
?>