<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p><?php 
	//printf( __( "Thanks for creating an account on %s. Your username is <strong>%s</strong>.", 'woocommerce' ), esc_html( $blogname ), esc_html( $user_login ) ); 
	// print_r($email->user_email);
	print "Obrigado por criar sua conta na Santíssima Vestimenta.<br />Seu login é <strong>" . $email->user_email . '</strong>';
	
?></p>

<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>

	<p><?php printf( __( "Your password has been automatically generated: <strong>%s</strong>", 'woocommerce' ), esc_html( $user_pass ) ); ?></p>

<?php endif; ?>

<p><?php 
	$x = wc_get_page_permalink( 'myaccount' );
	// $x = "<strong style='#383E3A;'><a href='$x' >$x</a></strong>";
	// $x = "<strong style='#383E3A;'><a href='$x'><spanstyle='#000;'>$x</span></a></strong>";
	$x = "<strong><a class='link' href='$x' >$x</a></strong>";
	
	
	printf( __( 'You can access your account area to view your orders and change your password here: %s.', 'woocommerce' ), $x ); 
	//print 'Você pode acessar o painel da sua conta para ver seus pedidos e mudar sua senha aqui: http://santissimavestimenta.web1505.kinghost.net/minha-conta/.'
?></p>

 

<?php do_action( 'woocommerce_email_footer', $email ); ?>
