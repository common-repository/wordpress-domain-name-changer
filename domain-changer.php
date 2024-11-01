<?php
/*
Plugin Name: Domain name changer
Plugin URI: http://www.vishnuvalentino.com/plugins/wordpress-domain-name-migration-plugin
Description: This plugin will easily move your old wordpress domain name into the new domain name. This plugin dedicated to Evlin Marcelline 
Version: 0.1
Author: Vishnu Valentino
Author URI: http://vishnuvalentino.com

Copyright 2009  Vishnu Valentino  (email : vishnu.valentino@lenmarc.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

	function domain_changer() {
		add_options_page("Domain Name Changer", "Domain Name Changer", "manage_options", __FILE__, "change_domain");
	}
	function change_domain() {
		
	function update_url($urllama,$urlbaru) {	
		global $wpdb;

		//query old domain name and update with the new domain
		$query_domain = "UPDATE $wpdb->posts SET guid = REPLACE ( guid,'".$urllama."','".$urlbaru."')";
		$query_options = "UPDATE $wpdb->options SET option_value = '".$urlbaru."' WHERE option_id = 1";
		$hasil = $wpdb->query( $query_domain );
		$hasil2 = $wpdb->query( $query_options );
	}
		if( isset( $_POST['kirim_data'] ) ) {
		 
			$var_link_lama = attribute_escape($_POST['url_link_lama']);
			$var_link_baru = attribute_escape($_POST['url_link_baru']);
			update_url($var_link_lama,$var_link_baru);
			echo '<div id="message" class="updated fade"><p><strong>URL in database have been updated.</p></strong></div>';
		}
?>
<div class="wrap">
<h2>Domain Migration Tools Settings</h2>
<form method="post" action="options-general.php?page=wordpress-domain-name-changer/domain-changer.php">
<input type="hidden" id="_wpnonce" name="_wpnonce" value="abcab64052" />
<p>These setting below let you updated your <em>wp_options</em> table and <em>wp_posts</em> table so your blog can move safely to your new domain name. It will replaces the old domain name with the new domain name.<br /><br /><h3>Example :</h3> <br />- <em>Old Domain Name : <a href="http://lenmarc.com">http://vishnuval.lenmarc.com</a></em><br /><em>- New Domain Name : <a href="http://vishnuvalentino.com">http://vishnuvalentino.com</a></em></p><br /><br />
Remember! Read the howto on my blog <a href="http://www.vishnuvalentino.com/plugins/wordpress-domain-name-migration-plugin">Domain Name Changer Tutorial</a> before you start using this plugin.<br />
<table class="form-table">
<tr>
<th scope="row" style="width:300px;">Old Domain Name</th>
<td>
	<p><input name="url_link_lama" type="text" id="url_link_lama" value="" style="width:300px;" /></p>
</td>
</tr>
<tr>
<th scope="row" style="width:300px;">New Domain Name</th>
<td>
	<p><input name="url_link_baru" type="text" id="url_link_baru" value="" style="width:300px;" /></p>
</td>
</tr>
</table>
<p class="submit">
<input name="kirim_data" value="Update Domain Name" type="submit" />
</p>
</form>
</div>
<?php
} 
add_action('admin_menu', 'domain_changer');
?>