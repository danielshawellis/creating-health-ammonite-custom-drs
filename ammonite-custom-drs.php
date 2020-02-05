<?php
/**
 * Plugin Name:       Ammonite Custom DRS
 * Description:       Adds a shortcode to handle custom Doctor's Reference Sheets
 * Version:           1.0.0
 * Author:            Daniel Ellis
 * Author URI:        https://danielellisdevelopment.com/
 */

/**
 * DEVELOPER NOTES:
 * This plugin creates a custom shortcode ([ammonite_templatera_product_drs]) that is used in the single product templates (WooCommerce Page Builder -> Product Templates)
 * The shortcode pulls in a unique Templatera template (WPBakery Page Builder -> Templatera -> Templates) for each product
 * Templatera templates are associated with products using the WooCommerce product custom filed "custom-product-drs-templatera-id"
 * This custom field can be found and set here: (Products -> Specific Product -> Custom Fields)
 */

/*
  Basic Security
*/
if ( ! defined( 'ABSPATH' ) ) {
  die;
}

/*
  Plugin Container Class
*/

if ( !class_exists( 'Ammonite_Custom_DRS' ) ) {
  class Ammonite_Custom_DRS
  {

    // Add shortcode to pull in the subscriptions_ui template
    public static function add_shortcode_to_include_DRS() {
      add_shortcode( 'ammonite_templatera_product_drs', array( 'Ammonite_Custom_DRS', 'include_DRS' ) );
    }

    public static function include_DRS() {
      if (get_post_meta( get_the_id(), 'custom-product-drs-templatera-id', true )) {
        echo do_shortcode('[templatera id="' . get_post_meta( get_the_id(), 'custom-product-drs-templatera-id', true ) . '"]');
      } else {
        echo "<h4>Additional Information For This Product Isn't Available Yet</h4>";
      }
    }

  }

  // The below functions run when the plugin is loaded
  Ammonite_Custom_DRS::add_shortcode_to_include_DRS();
}
