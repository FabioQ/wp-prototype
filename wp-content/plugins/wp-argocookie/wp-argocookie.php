<?php
/* ============================================================================================|

		   d8888 8888888b.   .d8888b.   .d88888b.   .d8888b.  8888888888 8888888b.  888     888     
		  d88888 888   Y88b d88P  Y88b d88P" "Y88b d88P  Y88b 888        888   Y88b 888     888     
		 d88P888 888    888 888    888 888     888 Y88b.      888        888    888 888     888     
		d88P 888 888   d88P 888        888     888  "Y888b.   8888888    888   d88P Y88b   d88P     
	   d88P  888 8888888P"  888  88888 888     888     "Y88b. 888        8888888P"   Y88b d88P      
	  d88P   888 888 T88b   888    888 888     888       "888 888        888 T88b     Y88o88P       
	 d8888888888 888  T88b  Y88b  d88P Y88b. .d88P Y88b  d88P 888        888  T88b     Y888P        
	d88P     888 888   T88b  "Y8888P88  "Y88888P"   "Y8888P"  8888888888 888   T88b     Y8P
					   _                     ___            _    _      
					  /_\  _ __ __ _  ___   / __\___   ___ | | _(_) ___ 
					 //_\\| '__/ _` |/ _ \ / /  / _ \ / _ \| |/ / |/ _ \
					/  _  \ | | (_| | (_) / /__| (_) | (_) |   <| |  __/
					\_/ \_/_|  \__, |\___/\____/\___/ \___/|_|\_\_|\___|
							   |___/                                    

// ============================================================================================|*/

/**
 * Plugin Name: WP ArgoCookie
 * Plugin URI: http://www.argoserv.it/plugins/
 * Description: Visualizza l'informativa sulla Privacy dovuta alla legge europea sui Cookie.
 * Version: 1.2
 * Tested With: 4+
 * Author: Michele Falconi, Marco Marini
 * Author URI: http://argoserv.it
 * License: GPL2+
 * Text Domain: WP-ArgoCookie
 * Domain Path: /languages
 */
 
// DOMINIO di Traduzione
define( 'LANG_DOMINIO', 'WP-ArgoCookie' );

/*	START THE MACHINE
======================================================================= */

// ATTIVATO IL PLUGIN SI CREANO LE OPTIONS RELATIVE
// ==========================================================|

add_action( 'activate_wp-argocookie/wp-argocookie.php', 'add_fields_options' );
if ( !function_exists( 'add_fields_options' ) ) {
	function add_fields_options(){
		
		// SETTINGS
		$wpac_attivo 	= '0';
		$wpac_scadenza 	= '365';
		$wpac_infobreve = 'Questo sito utilizza dei cookie, anche di terze parti, necessari al suo corretto funzionamento e secondo le finalit&agrave; illustrate nella Privacy Policy,
							dove trovi maggiori informazioni e anche indicazioni su come eventualmente negare il consenso a tutti o alcuni cookie.
							Chiudendo questo banner, scorrendo questa pagina o cliccando qualunque suo elemento acconsenti all\'uso dei cookie.';
		
		$wpac_linkinfo	= '';
		
		// COLOR SETTINGS
		$wpac_font_color = '#FFFFFF';
		$wpac_bg_div	 = '#F44336';
		$wpac_color_url	 = '#FFFFFF';
		$wpac_colorh_url = '#FFFFFF';
		$wpac_bg_button  = '#F77066';
		$wpac_bgh_button = '#FFFFFF';
		
		add_option( 'wpac_attivo'	, $wpac_attivo		);
		add_option( 'wpac_scadenza'	, $wpac_scadenza	);
		add_option( 'wpac_infobreve', $wpac_infobreve	);
		add_option( 'wpac_linkinfo'	, $wpac_linkinfo	);
		
		// GESTIONE COLORI
		add_option( 'wpac_font_color'	, $wpac_font_color	);
		add_option( 'wpac_bg_div'		, $wpac_bg_div		);
		add_option( 'wpac_color_url'	, $wpac_color_url	);
		add_option( 'wpac_colorh_url'	, $wpac_colorh_url	);
		add_option( 'wpac_bg_button'	, $wpac_bg_button	);
		add_option( 'wpac_bgh_button'	, $wpac_bgh_button	);

	}
}

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'add_settings_link_to_my_plugin_action' );
if ( !function_exists( 'add_settings_link_to_my_plugin_action' ) ) {
	function add_settings_link_to_my_plugin_action( $links ) {
		$links[] = '<a href="'. esc_url( get_admin_url( null, 'options-general.php?page=wp-argocookie') ) .'">Gestisci Cookie Privacy</a>';
		// $links[] = '<a href="http://www.argoserv.it" target="_blank">Altri Plugins su @Argoserv</a>';
	   return $links;
	}
} else {
	var_dump( 'ESISTE UN CONFLITTO DI FUNZIONI. DISATTIVARE IL PLUGIN DEI COOKIE,  SI PREGA DI REPORTARE IL PROBLEMA.' );
}

// AGGIUNGO IL MENU DEL PLUGIN
// ==========================================================|

add_action('admin_menu', 'wp_argocookie_menu');
if ( !function_exists( 'wp_argocookie_menu' ) ) {
	function wp_argocookie_menu() {
		add_submenu_page(	'options-general.php',
							'WP ArgoCookie - Gestione Avviso Cookie', 
							'Gestisci Cookie', 
							'activate_plugins', 
							'wp-argocookie',
							'wp_argocookie_options'
						);
	}
} else {
	var_dump( 'ESISTE UN CONFLITTO DI FUNZIONI. DISATTIVARE IL PLUGIN DEI COOKIE,  SI PREGA DI REPORTARE IL PROBLEMA.' );
}

// PAGINA DEL PLUGIN NEL BACK END PER LE IMPOSTAZIONI
// ==========================================================|

if ( !function_exists( 'wp_argocookie_options' ) ) {
	function wp_argocookie_options() {
		
		// Accede solo chi ha il permesso
		if ( !current_user_can( 'activate_plugins' ) )  {
			wp_die( __( 'Non hai il permesso per accedere a questa pagina.' ) );
		}
						
		if ( isset( $_POST['submit'] ) ){
			
			$wpacx_attivo = '';
			if ( isset( $_POST['wpac_attivo'] ) ){
				$wpacx_attivo = $_POST['wpac_attivo'];
			}
			
			$wpac_attivo 	= update_option( 'wpac_attivo',	$wpacx_attivo );
			
			$wpacx_scadenza = '';			
			if ( isset( $_POST['wpac_scadenza'] ) ){
				$wpacx_scadenza = $_POST['wpac_scadenza'];
			}
			
			$wpac_scadenza 	= update_option( 'wpac_scadenza',	$wpacx_scadenza );
			
			$wpacx_infobreve = '';
			if ( isset( $_POST['wpac_infobreve'] ) ){
				$wpacx_infobreve = $_POST['wpac_infobreve'];
				
			}
			
			$wpac_infobreve = update_option( 'wpac_infobreve', $wpacx_infobreve );
			
			$wpacx_linkinfo	= '';
			if ( isset( $_POST['wpac_linkinfo'] ) ){
				$wpacx_linkinfo	= $_POST['wpac_linkinfo'];
			}
			
			$wpac_linkinfo	= update_option( 'wpac_linkinfo', $wpacx_linkinfo );
			
			// GESTIONE COLORI
			// ============================================================================|
			
			/* FONT COLOR */
			$wpacx_font_color	= '';
			if ( isset( $_POST['wpac_font_color'] ) ){
				$wpacx_font_color = $_POST['wpac_font_color'];
			}
			
			$wpac_font_color = update_option( 'wpac_font_color', $wpacx_font_color );
			
			/* BACKGROUND BOX */
			$wpacx_bg_div	= '';
			if ( isset( $_POST['wpac_bg_div'] ) ){
				$wpacx_bg_div = $_POST['wpac_bg_div'];
			}
			
			$wpac_bg_div = update_option( 'wpac_bg_div', $wpacx_bg_div );
			
			/* COLOR DEL LINK */
			$wpacx_color_url = '';
			if ( isset( $_POST['wpac_color_url'] ) ){
				$wpacx_color_url = $_POST['wpac_color_url'];
			}
			
			$wpac_color_url	= update_option( 'wpac_color_url', $wpacx_color_url );
			
			/* COLOR:HOVER DEL LINK */
			$wpacx_colorh_url = '';
			if ( isset( $_POST['wpac_colorh_url'] ) ){
				$wpacx_colorh_url = $_POST['wpac_colorh_url'];
			}
			
			$wpac_colorh_url = update_option( 'wpac_colorh_url', $wpacx_colorh_url );
			
			/* BACKGROUND DEL BUTTON */
			$wpacx_bg_button	= '';
			if ( isset( $_POST['wpac_bg_button'] ) ){
				$wpacx_bg_button = $_POST['wpac_bg_button'];
			}
			
			$wpac_bg_button	= update_option( 'wpac_bg_button', $wpacx_bg_button );
			
			/* BACKGROUND :HOVER DEL BUTTON */
			$wpacx_bgh_button = '';
			if ( isset( $_POST['wpac_bgh_button'] ) ){
				$wpacx_bgh_button = $_POST['wpac_bgh_button'];
			}
			
			$wpac_bgh_button = update_option( 'wpac_bgh_button', $wpacx_bgh_button );
		}
		
		$wpac_attivo 	= get_option( 'wpac_attivo' );
		$wpac_scadenza 	= get_option( 'wpac_scadenza' );
		$wpac_infobreve = stripslashes( get_option( 'wpac_infobreve' ) );
		$wpac_linkinfo	= get_option( 'wpac_linkinfo' );
		
		// COLOR SETTINGS
		$wpac_font_color = get_option( 'wpac_font_color' );
		$wpac_bg_div	 = get_option( 'wpac_bg_div' );
		$wpac_color_url	 = get_option( 'wpac_color_url' );
		$wpac_colorh_url = get_option( 'wpac_colorh_url' );
		$wpac_bg_button  = get_option( 'wpac_bg_button' );
		$wpac_bgh_button = get_option( 'wpac_bgh_button' );

	?>
		
	<!--// HTML FRONT END -->
	<div class="wrap" id="wp-argocookie" >
		
		<!--// TITOLO E DESCRIZIONE PLUGIN -->
		<h2><?php _e( 'Gestisci l\'avviso dei Cookie',LANG_DOMINIO ); ?></h2>
		<?php $wp_argo_cookie_dir = plugin_dir_url( __FILE__ ); ?>
		<img alt="WP Argonauti" src="<?php echo $wp_argo_cookie_dir . 'img/logo.png'; ?>" style="float:left;" />
		<label><?php _e( 'La EU Cookie Law (legge europea sui cookie) è stata approvata anche in Italia entrando in vigore un anno dopo, 
						il 1 giugno 2012 con decreto legislativo 69/2012 e 70/2012. La c.d. “fase transitoria” – per adeguare i nostri siti 
						termina il 2 Giugno 2015 e per mettersi in regola, per quello che riguarda i cookie utilizzati dal web analytics, 
						basta un semplice aggiornamento sul proprio CMS. Per i cookie di tracciamento attivati sul proprio sito è necessaria 
						l\'informativa estesa. ', LANG_DOMINIO ); ?>
						<i><a href="http://www.normattiva.it/uri-res/N2Ls?urn:nir:stato:decreto.legislativo:2012-05-28;69" target="_blank" ><?php _e( 'Qui il riferimento alla legge', LANG_DOMINIO ); ?></a></i>
		</label>
		<div class="clear" ></div>
		<table class="form-table">
			<tbody>
				<form action="" method="POST" >
				
					<!--// ATTIVAZIONE / DISATTIVAZIONE ALERT COOKIE -->
					<?php
					
					$checked = '';
					if ( $wpac_attivo == 1 ){ $checked = 'checked'; }
					echo '<h3>'. __( 'Attivazione del Cookie Alert', LANG_DOMINIO ) .'</h3>';
					echo '<div class="col-1" >
								<div class="wpac_attivo">' .
								__( 'Attivare / Disattivare ', LANG_DOMINIO ) . 
								'<input type="checkbox" name="wpac_attivo" id="wpac_attivo" '. $checked .' value="1" >
								</div>
						   </div>';
					echo '<div class="clear" ></div>';
					
					echo '<h3>'. __( 'Opzioni del Cookie', LANG_DOMINIO ) .'</h3>';
					echo '<div class="col-1-4" >
							  <label>'. __( 'Scadenza del Cookie ( in giorni) ', LANG_DOMINIO ) .'</label>
							  <div class="wpac_scadenza">
								<input type="number" name="wpac_scadenza" id="wpac_scadenza" value="' . $wpac_scadenza . '" size="15">
								</div>
						   </div>';
						   
					echo '<div class="col-1-2" >
							<label>'. __( 'Collega all\'Informativa ( inserisci solo lo SLUG della pagina )', LANG_DOMINIO ) .'</label>
							<div class="wpac_linkinfo">' .
							  home_url() . '/<input type="text" name="wpac_linkinfo" id="wpac_linkinfo" value="' . $wpac_linkinfo . '" size="50">
							</div>
						   </div>';
					echo '<div class="clear" ></div>';
					?>
			
					<!--// SHORT DESCRIPTION OF LOW -->
					<div class="col-1" id="cookie-editor" >
						<label><?php _e( 'Informativa Breve', LANG_DOMINIO ); ?>
						<small><?php _e( ' - Inserisci l\'Informativa breve ( Sono consigliati meno di 300 caratteri ).', LANG_DOMINIO ); ?></small></label>
							<?php
							// TABELLA PREZZI WP-TEXTAREA
							$wp_argo_cookie_dir = plugin_dir_url( __FILE__ );
							$informativa_args = array (
								'textarea_name' => 'wpac_infobreve',
								'textarea_rows' => 5,
								'teeny'			=> true,
								'wpautop' 		=> false,
								'media_buttons'	=> false,
								'quicktags' 	=> false,
								'tinymce' => array( 
									'content_css' => $wp_argo_cookie_dir . 'css/wpac-plugin.css'
								) 
							);
							
							wp_editor( $wpac_infobreve, 'wpac_infobreve', $informativa_args );
							
							?>
					</div>
					<div class="clear" ></div>
					
					<?php 
					
					// COLOR PICKER 1 RIGA
					echo '<h3>'. __( 'Gestione dei Colori', LANG_DOMINIO ) .'</h3>';
					echo '<div class="col-1-4" >
							  <label>'. __( 'Colore Font', LANG_DOMINIO ) .'</label>
							  <div class="wpac_font_color">
								<input type="text" name="wpac_font_color" class="wpac-color-picker" value="' . $wpac_font_color . '" size="15">
								</div>
						   </div>';
						   
					echo '<div class="col-1-4" >
							  <label>'. __( 'Colore del Link', LANG_DOMINIO ) .'</label>
							  <div class="wpac_color_url">
								<input type="text" name="wpac_color_url" class="wpac-color-picker" value="' . $wpac_color_url . '" size="15">
								</div>
						   </div>';
						   
					echo '<div class="col-1-4" >
							  <label>'. __( 'Colore (:hover) del Link', LANG_DOMINIO ) .'</label>
							  <div class="wpac_colorh_url">
								<input type="text" name="wpac_colorh_url" class="wpac-color-picker" value="' . $wpac_colorh_url . '" size="15">
								</div>
						   </div>';
					echo '<div class="clear" ></div>';
					
					// COLOR PICKER 2 RIGA
					echo '<div class="col-1-4" >
							  <label>'. __( 'Colore Sfondo Box', LANG_DOMINIO ) .'</label>
							  <div class="wpac_bg_div">
								<input type="text" name="wpac_bg_div" class="wpac-color-picker" value="' . $wpac_bg_div . '" size="15">
								</div>
						   </div>';
						   
					echo '<div class="col-1-4" >
							  <label>'. __( 'Colore Sfondo Button', LANG_DOMINIO ) .'</label>
							  <div class="wpac_bg_button">
								<input type="text" name="wpac_bg_button" class="wpac-color-picker" value="' . $wpac_bg_button . '" size="15">
								</div>
						   </div>';
						   
					echo '<div class="col-1-4" >
							  <label>'. __( 'Colore (:hover) Sfondo Button', LANG_DOMINIO ) .'</label>
							  <div class="wpac_bgh_button">
								<input type="text" name="wpac_bgh_button" class="wpac-color-picker" value="' . $wpac_bgh_button . '" size="15">
								</div>
						   </div>';
					echo '<div class="clear" ></div>';
					
					?>
					
					<!--// SALVA BUTTON -->
					<div class="col-1" >
						<input type="submit" name="submit" value="Salva Informazioni" class="button-primary"/></td>
					</div>
					<div class="clear" ></div>
				</form>
			</tbody>
		</table>
	</div>

	<?php 
	}

} else {
	var_dump( 'ESISTE UN CONFLITTO DI FUNZIONI. DISATTIVARE IL PLUGIN DEI COOKIE,  SI PREGA DI REPORTARE IL PROBLEMA.' );
}

// AGGIUNGE AL FOOTER IL DIV CHE CONTIENE IL CODICE DEL COOKIE
// ==========================================================|

add_action( 'wp_footer', 'add_div_on_footer' );
if ( !function_exists( 'add_div_on_footer' ) ) {
	function add_div_on_footer() {
		
		$wpac_attivo 	= get_option( 'wpac_attivo' );
		$wpac_scadenza 	= get_option( 'wpac_scadenza' );
		$wpac_infobreve = stripslashes( get_option( 'wpac_infobreve' ) );
		$wpac_linkinfo	= get_option( 'wpac_linkinfo' );
		
		$wpac_font_color = get_option( 'wpac_font_color' );
		if ( empty( $wpac_font_color ) ) { $wpac_font_color = '#FFFFFF'; }
				
		$wpac_color_url	= get_option( 'wpac_color_url' );
		if ( empty( $wpac_color_url ) ) { $wpac_color_url = '#FFFFFF'; }
		
		$wpac_colorh_url = get_option( 'wpac_colorh_url' );
		if ( empty( $wpac_colorh_url ) ) { $wpac_colorh_url = '#F44336'; }
		
		$wpac_bg_div = get_option( 'wpac_bg_div' );
		if ( empty( $wpac_bg_div ) ) { $wpac_bg_div = '#F44336'; }
		
		$wpac_bg_button = get_option( 'wpac_bg_button' );
		if ( empty( $wpac_bg_button ) ) { $wpac_bg_button = '#F77066';  }
		
		$wpac_bgh_button= get_option( 'wpac_bgh_button' );
		if ( empty( $wpac_bgh_button ) ) { $wpac_bgh_button = '#FFFFFF'; }
		
		if ( $wpac_attivo == 1 ){
			
			?>
			
			<style>
				#cookies p{ color: <?php echo $wpac_font_color; ?> !important; }
				#cookies .cookie-text a,.url-cookie{ color: <?php echo $wpac_color_url; ?> !important; }
				#cookies .close-cookie:hover,.url-cookie:hover{ color: <?php echo $wpac_colorh_url; ?> !important; }
				.cookie-content{ background: <?php echo $wpac_bg_div; ?> !important; }
				.close-cookie{ background: <?php echo $wpac_bg_button; ?> !important; }
				.close-cookie:hover{ background: <?php echo $wpac_bgh_button; ?> !important; }
			</style>
			
			<div id="cookies" class="cookie-content" data-rel="<?php echo $wpac_scadenza; ?>" >
			
				<div class="cookie-text">
					<?php echo $wpac_infobreve; ?>
					<?php if ( $wpac_linkinfo != '' ) { ?>
					<p><a class="url-cookie" style=" <?php echo $wpac_color_url; ?> " href="<?php echo get_bloginfo( 'url' ) . '/' . $wpac_linkinfo; ?>" target="_blank" > - <?php _e( 'Approfondisci', LANG_DOMINIO ); ?></a></p>
					<?php } ?>
				</div>
				
				<div class="cookie-action">
					<a href="#" class="button small close-cookie"><?php _e( 'Chiudi', LANG_DOMINIO ); ?></a>
				</div>
				
				<div class="clear"></div>
			</div><!-- END COOKIES --> 
			
			<?php
		}
	} 
} else {
		var_dump( 'ESISTE UN CONFLITTO DI FUNZIONI. DISATTIVARE IL PLUGIN DEI COOKIE,  SI PREGA DI REPORTARE IL PROBLEMA.' );
}

//* CARICO  PLUGIN CSS ADMIN COOKIE
// ==========================================================|

add_action( 'admin_enqueue_scripts', 'carico_cookie_plugin_css' );
if ( !function_exists( 'carico_cookie_plugin_css' ) ) {
	function carico_cookie_plugin_css() {
		
			$wp_argo_cookie_dir = plugin_dir_url( __FILE__ );
			wp_register_style( 'cookie_library_css', 		$wp_argo_cookie_dir . 'css/wpac-plugin.css', false, '1.0.0' );
			wp_enqueue_style( 'cookie_library_css' );
	}
} else {
	var_dump( 'ESISTE UN CONFLITTO DI FUNZIONI. DISATTIVARE IL PLUGIN DEI COOKIE, SI PREGA DI REPORTARE IL PROBLEMA.' );
}

//* CARICO JQUERY REGISTER COOKIE
// ==========================================================|

add_action( 'wp_enqueue_scripts', 'carico_cookie_library', 100 );
if ( !function_exists( 'carico_cookie_library' ) ) {
	function carico_cookie_library() {
		
			$wp_argo_cookie_dir = plugin_dir_url( __FILE__ );
			wp_register_script( 'cookie_library', 			$wp_argo_cookie_dir . 'js/jquery.cookie.js', 'jQuery', '1.4.1', true );
			wp_register_script( 'wp-argocookie-scripts', 	$wp_argo_cookie_dir . 'js/wpac-scripts.js', 'jQuery', '1.1.0', true );
			wp_register_style( 'cookie_library_css', 		$wp_argo_cookie_dir . 'css/wpac-style.css', '1.0.0', false );
			
			wp_enqueue_script( 'cookie_library' );
			wp_enqueue_script( 'wp-argocookie-scripts' );
			wp_enqueue_style( 'cookie_library_css' );
	}
} else {
	var_dump( 'ESISTE UN CONFLITTO DI FUNZIONI. DISATTIVARE IL PLUGIN DEI COOKIE, SI PREGA DI REPORTARE IL PROBLEMA.' );
}

// ADD jQUERY COLOR LIBRARIES
// ==========================================================|

add_action( 'admin_enqueue_scripts', 'wp_add_color_picker' );
if ( !function_exists( 'wp_add_color_picker' ) ) {
	function wp_add_color_picker( $hook ) {
	 
		if( is_admin() ) { 
		 
			// Add the color picker css file       
			wp_enqueue_style( 'wp-color-picker' );
			
			// Include Iris WordPress Color Picker dependency
			wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
			 
			// Include our custom jQuery file with WordPress Color Picker dependency
			wp_enqueue_script( 'wpac-colorpicker-js', plugins_url( 'js/wpac-colorpicker.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
		}
	}
} else {
	var_dump( 'ESISTE UN CONFLITTO DI FUNZIONI. DISATTIVARE IL PLUGIN DEI COOKIE, SI PREGA DI REPORTARE IL PROBLEMA.' );
}

?>