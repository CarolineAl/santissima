<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

global $porto_settings;

$review_index = 0;

$rand = porto_generate_rand();

if ( ! empty( $tabs ) || !empty($custom_tabs_title) || $global_tab_title ) : ?>

    <div class="woocommerce-tabs woocommerce-tabs-<?php echo $rand ?>" id="product-tab">
        <ul class="resp-tabs-list">
            <?php
            $i = 0;
            foreach ( $tabs as $key => $tab ) :
                ?><li aria-controls="tab-<?php echo esc_attr( $key ) ?>">
                    <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
                </li><?php
                if ($key == 'reviews') $review_index = $i;
                $i++;
            endforeach;
            ?>

        </ul>
        <div class="resp-tabs-container">
            <?php foreach ( $tabs as $key => $tab ) : ?>

                <div class="tab-content" id="tab-<?php echo esc_attr( $key ) ?>">
                    <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                </div>

            <?php endforeach; ?>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(function($) {
            $('.woocommerce-tabs-<?php echo $rand ?>').easyResponsiveTabs({
                type: '<?php echo esc_js($porto_settings['product-tabs']) ?>', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true,   // 100% fit in a container
                activate: function(event) { // Callback function if tab is switched

                }
            });

            <?php if (!porto_is_ajax()) : ?>
            // go to reviews, write a review
            $('.woocommerce-review-link, .woocommerce-write-review-link').click(function(e) {
                var recalc_pos = false;
                if ($('#content #tab-reviews').css('display') != 'block') {
                    recalc_pos = true;
                }
                if ($("h2[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").length && $("h2[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").next().css('display') == 'none')
                    $("h2[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").click();
                else if ($("li[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").length && $("li[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").next().css('display') == 'none')
                    $("li[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").click();

                var target = $(this.hash);
                if (target.length) {
                    e.preventDefault();

                    var delay = 1;
                    if ($(window).scrollTop() < theme.StickyHeader.sticky_pos) {
                        delay += 250;
                        $('html, body').animate({
                            scrollTop: theme.StickyHeader.sticky_pos + 1
                        }, 200);
                    }
                    setTimeout(function() {
                        $('html, body').stop().animate({
                            scrollTop: target.offset().top - theme.StickyHeader.sticky_height - theme.adminBarHeight() - 14
                        }, 600, 'easeOutQuad');
                    }, delay);

                    return false;
                }
            });
            // Open review form lightbox if accessed via anchor
            if ( window.location.hash == '#review_form' || window.location.hash == '#reviews' || window.location.hash.indexOf('#comment-') != -1 ) {
                setTimeout(function() {
                    if ($("h2[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").next().css('display') == 'none') {
                        $("h2[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").click();
                        var target = $(window.location.hash);
                        if (target.length) {
                            var delay = 1;
                            if ($(window).scrollTop() < theme.StickyHeader.sticky_pos) {
                                delay += 250;
                                $('html, body').animate({
                                    scrollTop: theme.StickyHeader.sticky_pos + 1
                                }, 200);
                            }
                            setTimeout(function() {
                                $('html, body').stop().animate({
                                    scrollTop: target.offset().top - theme.StickyHeader.sticky_height - theme.adminBarHeight() - 14
                                }, 600, 'easeOutQuad');
                            }, delay);
                        }
                    }
                }, 200);
            }
            <?php endif; ?>
        });
    </script>

<?php endif; ?>