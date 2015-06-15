<?php
/**
 * @package Just a Check
 * @version 0.1
 */
/*
Plugin Name: Just a Check
Plugin URI: #
Description: This is just a test plugin I'm coding to check some updates
Author: Fabio Quinzi and Michele Falconi
Version: 0.1
Author URI: #
*/

add_action('admin_menu', 'justacheck_admin_actions');

function justacheck_admin_actions() {
	add_options_page('Just a Check', 'Just a Check', 'manage_options', __FILE__, 'justacheckplugin_admin');
}

function justacheckplugin_admin(){
?>
<div class="wrap">
<h4>This plugin, hopefully, will show if someone stole content from your posts</h4>
<form action="" method="POST" style="margin-top:40px; margin-bottom:40px;">
	<input type="submit" name="search_draft_posts" value="Search" class="button-primary" />
	<select name="searchtype" >
		<?php
		if(isset($_POST['searchtype'])){
			$posttoget = $_POST['searchtype'];
			if ($posttoget == 'post'){
				?>
				<option value="post" selected="selected">Posts  </option>
	   			<option value="page">Pages  </option>
	   			<?php
			}else {
				?>
				<option value="post">Posts  </option>
	   			<option value="page" selected="selected">Pages  </option>
				<?php
			}}
		else {
		?>
	   <option value="post" selected="selected">Posts  </option>
	   <option value="page">Pages  </option>
	   <?php
		}
	   ?>
	</select>
</form>
<table class="widefat">
	<thead>
		<tr>
			<th>Post Title</th>
			<th>Post ID</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Post Title</th>
			<th>Post ID</th>
		</tr>
	</tfoot>
	<tbody>
	<?php
		global $wpdb;
		if(isset($_POST['searchtype'])){$posttoget = $_POST['searchtype'];}
		else $posttoget = 'post';
		$mypoststoscan = $wpdb->get_results(
				"
				SELECT ID, post_title
				FROM $wpdb->posts
				WHERE post_status = 'publish'
				AND post_type='".$posttoget."'
				"
			);
	?>
	<?php
		foreach ($mypoststoscan as $myposttoscan)
	{
	?>
	<tr>
	<?php
		echo "<td>".$myposttoscan->post_title."</td>";
		echo "<td>".$myposttoscan->ID."</td>";
	?>
	</tr>
	<?php
	}
	?>
	</tbody>
</table>
</div>
<?php
}
?>
