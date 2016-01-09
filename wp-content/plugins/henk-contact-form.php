<?php
/* 
Plugin Name: henk contact form
Description: henks contact form gebaseerd op http://www.sitepoint.com/build-your-own-wordpress-contact-form-plugin-in-5-minutes/
Version: 1.0
Author: mark van dijken
*/

function henk_contact_form_html() {
    echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
    echo '<label for="name">name</label>';
    echo '<input type="text" placeholder="name" name="henk-contact-name">';
    echo '<label for="email">name</label>';
    echo '<input type="email" placeholder="email" name="henk-contact-email">';
    echo '<label for="message">message</label>';
    echo '<textarea name="henk-contact-message" id="" cols="30" rows="6" placeholder="message"></textarea>'
    echo '<input type="submit name="henk-contact-submit" value="submit">';
    echo '</form>';
 }

function henk_deliver_mail() {
    if ( isset( $_POST['henk-contact-submit'] ) ) {
        // sanitize shit
        $name = sanitize_text_field( $_POST["henk-contact-name"] );
        $email = sanitize_email( $_POST["henk-contact-email"] );
        $message = sanitize_textarea( $_POST["henk-contact-message"] );
        $subject = 'Contact formulier website';

        // get site admin email
        //      $to = get_option( 'admin_email' );
        //      for testing
        //      $to = "markvdijken@gmail.com"; 

        $headers = "From: $name <$email>" . "\r\n";

        // If email has been process for sending, display a success message
        if ( wp_mail( $to, $subject, $message, $headers) ) {
            echo '<div>';
            echo '<p>Thanks for sending us an email, expect a response soon.</p>';
            echo '</div>';
        } else {
            echo 'Oops, something went wrong please try again later';
        }
    }
}

function henk_contact_form_shortcode() {
    ob_start();
    henk_deliver_mail();
    henk_contact_form_html();

    return ob_get_clean();
}

add_shortcode( 'henk_contact_form', 'henk_contact_form_shortcode' );

?>