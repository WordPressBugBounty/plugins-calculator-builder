<?php
/**
 * Plugin main page
 *
 * @package     CalcHub
 * @subpackage  Admin/Main_page
 * @author      Dmytro Lobov <hey@wow-company.com>
 * @copyright   Copyright (c) 2022, CalcHub.xyz
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @version     0.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


$tabs_arr = array(
	'list'       => esc_attr__( 'Calculators', 'calculator-builder' ),
	'settings'   => esc_attr__( 'Create Calculator', 'calculator-builder' ),
	'tools'      => esc_attr__( 'Import & Export Calculators', 'calculator-builder' ),
	'support'    => esc_attr__( 'Send Support Ticket', 'calculator-builder' ),
	'extensions' => esc_attr__( 'Add-on', 'calculator-builder' ),
);

$current_tab = 'list';

$tabs = apply_filters( 'calchub_tab_menu', $tabs_arr );

if ( isset( $_REQUEST["tab"] ) ) {
	$tab = sanitize_text_field( wp_unslash( $_REQUEST["tab"] ) );
	if ( array_key_exists( $tab, $tabs ) ) {
		$current_tab = $tab;
	}
}

$idea_url    = admin_url( 'admin.php?page=' . CALCHUB_PLUGIN_URL . '&tab=support&type=idea' );
$support_url = admin_url( 'admin.php?page=' . CALCHUB_PLUGIN_URL . '&tab=support' );
?>
    <div id="calchub-notices">
		<?php do_action( 'calchub_admin_info_notices' ); ?>
    </div>
    <div class="calchub-header">
        <div class="calchub-header-wrapper">
            <h1 class="calchub-heading-inline">
                <img src="<?php echo esc_url( CALCHUB_PLUGIN_URL ); ?>assets/img/logo.png" alt="">
                <span class="calchub-heading-separator"></span>
                <span><?php
					if ( isset( $_REQUEST['act'] ) && $_REQUEST['act'] === 'update' ) {
						esc_attr_e( 'Update Calculator', 'calculator-builder' );
					} else {
						echo esc_attr( $tabs[ $current_tab ] );
					}
					?></span>
            </h1>
			<?php if ( $current_tab === 'list' || $current_tab === 'settings' ) : ?>
                <a href="?page=<?php echo esc_attr( CALCHUB_PLUGIN_SLUG ); ?>&tab=settings"
                   class="button is-info is-outlined">
					<?php esc_html_e( 'Add New', 'calculator-builder' ); ?>
                </a>
			<?php endif; ?>
        </div>
        <div class="calchub-links">
            <a href="https://calchub.xyz/downloads/calculator-builder-add-on/" target="_blank" class="calchub-link">
                <span class="dashicons dashicons-admin-plugins"></span><span>Add-on</span></a>
            <a href="https://calchub.xyz/downloads/category/calculators/" target="_blank" class="calchub-link"><span
                        class="dashicons dashicons-calculator"></span><span>Bundles</span></a>
            <a href="https://calchub.xyz/documentation/" target="_blank" class="calchub-link"><span
                        class="dashicons dashicons-book-alt"></span><span>Docs</span></a>
            <a href="https://calchub.xyz/calculator-builder-changelog/" target="_blank" class="calchub-link"><span
                        class="dashicons dashicons-list-view"></span><span>Changelog</span></a>
            <a href="https://calchub.xyz" class="calchub-link" target="_blank">
                <span class="dashicons dashicons-admin-links"></span><span>Examples</span></a>
            <a href="https://wordpress.org/support/plugin/calculator-builder/reviews/" class="calchub-link"
               target="_blank">
                <span class="dashicons dashicons-star-filled"></span><span>Reviews</span></a>
        </div>

    </div>

    <hr class="wp-header-end">

    <div class="wrap">
		<?php
		$current_tab = array_key_exists( $current_tab, $tabs ) ? 'page-' . esc_attr( $current_tab ) : 'list';
		$file        = apply_filters( CALCHUB_PLUGIN_SLUG . '_menu_file', esc_attr( $current_tab ) );
		include_once( $file . '.php' );
		?>
    </div>
    <input type="hidden" id="calchub-navigation" value="<?php echo esc_attr( CALCHUB_PLUGIN_SLUG ); ?>">
<?php
