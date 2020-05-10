<?php
/**
 * BUILDER Theme Options Page
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'BUILDER_Options' ) ) {

	class BUILDER_Options {

		/**
		 * Start things up
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// We only need to register the admin panel on the back-end
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'BUILDER_Options', 'add_admin_menu' ) );
				add_action( 'admin_init', array( 'BUILDER_Options', 'register_settings' ) );
			}

		}

		/**
		 * Returns all theme options
		 *
		 * @since 1.0.0
		 */
		public static function get_understrap_builder_options() {
			return get_option( 'understrap_builder_options' );
		}

		/**
		 * Returns single theme option
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_option( $id ) {
			$options = self::get_understrap_builder_options();
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}

		/**
		 * Add sub menu page
		 *
		 * @since 1.0.0
		 */
		public static function add_admin_menu() {
			add_submenu_page(
        'themes.php',
				esc_html__( 'UnderStrap BUILDER', 'understrap-builder' ),
				esc_html__( 'UnderStrap BUILDER', 'understrap-builder' ),
				'manage_options',
				'understrap-builder-settings',
				array( 'BUILDER_Options', 'create_admin_page' ),
        5
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * We are only registering 1 setting so we can store all options in a single option as
		 * an array. You could, however, register a new setting for each option
		 *
		 * @since 1.0.0
		 */
		public static function register_settings() {
			register_setting( 'understrap_builder_options', 'understrap_builder_options', array( 'BUILDER_Options', 'sanitize' ) );
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.0.0
		 */
		public static function sanitize( $options ) {

			// If we have options lets sanitize them
			if ( $options ) {

				// Input
				if ( ! empty( $options['us_b_pro_key'] ) ) {
					$options['us_b_pro_key'] = sanitize_text_field( $options['us_b_pro_key'] );
				} else {
					unset( $options['us_b_pro_key'] ); // Remove from options if empty
				}

			}

			// Return sanitized options
			return $options;

		}

		/**
		 * Settings page output
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page() {
      
			global $BUILDERUpdateChecker;
      
			$us_b_update_state = $BUILDERUpdateChecker->getUpdateState();
			$us_b_get_update_object = $us_b_update_state->getUpdate();
			$us_b_latest_version = $us_b_get_update_object->version;
			$us_b_installed_version = understrap_builder_get_theme_version();
      $us_b_latest_int = (int)str_replace('.', '', $us_b_latest_version);
      $us_b_installed_int = (int)str_replace('.', '', $us_b_installed_version);
      
      
      // Delete all Customizer data button
      if(isset($_GET['us_b_delete_all']) && $_GET['page'] == 'understrap-builder-settings' && $_GET['us_b_delete_all'] == '1'){
        understrap_builder_reset_default();
      }
      
      // Force check for new theme version
      $checking_for_latest_version = false;
      if(isset($_GET['us_b_force_version_check']) && $_GET['page'] == 'understrap-builder-settings' && $_GET['us_b_force_version_check'] == '1'){
        understrap_builder_manually_check_version();
        $checking_for_latest_version = true;
      }
			?>

      <style>
        .us_b_pro_title {
          margin-top: 14px;
          margin-bottom: 28px;
          height: 33px;
          line-height: 33px;
          background-image: url(https://builder.hotwpthemes.com/wp-content/themes/understrap-builder/img/builder-pro-logo-mini-64-64.png)!important;
          background-repeat: no-repeat!important;
          background-position: 0!important;
          background-size: 40px 40px!important;
          padding-left: 58px!important;
        }
        #us_b_check_latest_version{margin-left:8px;cursor:pointer}
        .form-table th{width:300px;}
        .us_b_update_available,.us_b_update_check,.us_b_reset_notice{margin-left:8px;}
        h1{
          background-image: url(https://builder.hotwpthemes.com/wp-content/themes/understrap-builder/img/builder-logo-mini-64-64.png)!important;
          background-repeat: no-repeat!important;
          background-position: 0!important;
          background-size: 40px 40px!important;
          padding-left: 58px!important;
          line-height: 22px!important;
        }
        hr{margin-top: 20px;margin-bottom: 30px;}
        .row {
          margin-left: -20px;
          margin-right: -20px;
          float: none;
        }
        .col {
          padding: 0 20px;
          float: left;
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
        }
        .col-4 {
          width: 66.666%;
        }
        .col-2 {
          width: 33.333%;
        }
        .img-fluid {
          max-width: 100%;
        }
        #us_b_options_side {
          border-left: 1px solid #ccc;
        }
        #us_b_options_side .us_b_pro_title {
          margin-bottom: 0;
        }
        .checklist_img {
          box-shadow: 2px 2px 6px #ccc;
          width: 200px;
        }
      </style>

			<div class="wrap">

				<h1 style="margin-top:18px"><?php esc_html_e( 'UnderStrap BUILDER', 'understrap-builder' ); ?></h1>
        
        <hr>
        
        <div class="main-content row">

          <div id="us_b_options_main" class="col col-4">

            <form method="post" action="options.php">

              <?php settings_fields( 'understrap_builder_options' ); ?>

              <table class="form-table">

                <?php // Notify site admin of new versions of BUILDER ?>

                <tr valign="top">
                  <th scope="row">Customize Your Theme</th>
                  <td>
                    <a href="<?php echo admin_url('customize.php'); ?>" class="button">Open Customizer</a>
                  </td>
                </tr>

                <tr valign="top">
                  <th scope="row">Import Template</th>
                  <td>
                    <?php if(is_plugin_active( 'one-click-demo-import/one-click-demo-import.php' )){ ?>
                    <a href="<?php echo admin_url('themes.php?page=pt-one-click-demo-import'); ?>" class="button">Open Import Screen</a>
                    <?php } else { ?>
                    <strong>One Click Demo Import</strong> plugin not installed
                    <?php } ?>
                  </td>
                </tr>

                <tr valign="top">
                  <th scope="row"><?php esc_html_e( 'Your BUILDER Version', 'understrap-builder' ); ?></th>
                  <td>
                    <?php echo esc_attr($us_b_installed_version); ?> 
                    <?php if($checking_for_latest_version){ ?>
                    <strong class="us_b_update_check">Checking For Latest Version Now...</strong>
                    <?php } else { ?>
                    <a href="<?php echo admin_url('themes.php?page='.$_GET["page"].'&us_b_force_version_check=1'); ?>" class="us_b_update_check">Check For Latest version</a>
                    <?php } ?>
                  </td>
                </tr>

                <tr valign="top">
                  <th scope="row"><?php esc_html_e( 'Latest BUILDER Version Available', 'understrap-builder' ); ?></th>
                  <td>
                    <?php echo esc_attr($us_b_latest_version); ?>
                    <?php if($us_b_latest_int > $us_b_installed_int){ ?>
                      <a href="<?php echo admin_url('themes.php'); ?>" class="us_b_update_available">Update Available</a>
                    <?php } else { ?>
                      <span class="dashicons dashicons-yes" style="color:green"></span> <small style="margin-left:6px">(You're Up To Date!)</small>
                    <?php } ?>
                  </td>
                </tr>

                <tr valign="top">
                  <th scope="row">Reset Customizer Options To Defaults</th>
                  <td>
                    <a href="<?php echo admin_url('themes.php?page='.$_GET["page"].'&us_b_delete_all=1'); ?>" class="button-link-delete" id="us_b_reset_styling">Reset</a> <em class="us_b_reset_notice">(delete all styling)</em>
                  </td>
                </tr>

              </table>

              <?php if(function_exists('understrap_builder_PRO_options_form')){ understrap_builder_PRO_options_form(self::get_theme_option('us_b_pro_key')); } ?>

              <hr>

              <?php submit_button(); ?>

              

              

              

              

              

            </form>

          </div>

          <div id="us_b_options_side" class="col col-2">
            
            <h2>BUILDER Facebook Group</h2>
            <p>Join our Facebook support group to get help with anything BUILDER related.</p>
            <p>Has something not worked while you are using UnderStrap BUILDER? Let us know!</p>
            <p>We also want to hear about any ideas you have or suggestions for new features.</p>
            <a href="https://www.facebook.com/groups/understrap.builder/" class="button button-primary" target="_blank">Join Group</a>
            
            <hr>
            
            <h2>BUILDER Checklist</h2>
            <img alt="BUILDER Checklist Screenshot" class="img-fluid checklist_img" src="https://understrap.com/wp-content/uploads/2020/03/builder_checklist_screen-2-300x300.jpg">
            <p>Walk through and check-off each step of setting up your BUILDER website with our free checklist.</p>
            <a href="https://understrap.com/builder/checklist/" target="_blank" class="button button-primary">Open Checklist</a>
            
            <?php if(!function_exists('understrap_builder_PRO_options_form')){ ?>
            <hr>
            
            <h2 class="us_b_pro_title">Go PRO</h2>
            <p>Get access to many more importable templates for your BUILDER website and unlock awesome premium features.</p>
            <a href="https://builder.understrap.com/d/pro/?utm_medium=plugin" target="_blank" class="button button-primary">Go PRO Now</a>
            
            <?php } ?>
            
          </div>
          
        </div>

			</div>
        
      <script>
        jQuery(function($){
          $('#us_b_reset_styling').click(function(e) {
              e.preventDefault();
              if (window.confirm("Are you sure? This deletes all styling set in Customizer.")) {
                  location.href = this.href;
              }
          });
          <?php if($checking_for_latest_version){ ?>
          setTimeout(function() {
            window.location.href = "<?php echo esc_url(admin_url('themes.php?page='.$_GET["page"])); ?>";
          }, 1000);
          <?php } ?>
        });
      </script>       
      
      
		<?php }

	}
}
new BUILDER_Options();