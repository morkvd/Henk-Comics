=== Weight Based Shipping for WooCommerce ===
Contributors: dangoodman
Tags: ecommerce, woocommerce, shipping, woocommerce shipping, weight-based shipping, conditional free shipping,
conditional flat rate, table rate shipping, weight, subtotal, country, shipping classes
Requires at least: 3.8
Tested up to: 4.3
WC requires at least: 2.1
WC tested up to: 2.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple yet flexbile weight-based shipping for WooCommerce

== Description ==

Plugin adds a weight-based shipping method to WooCommerce. With the plugin you can create multiple
shipping options active depending on order weight, subtotal or shipping destination.

[Plugin overview](http://robertryan.ie/the-best-weight-based-shipping-plugin-for-woocommerce/)
by [Robert Ryan](http://robertryan.ie/)
[youtube https://www.youtube.com/watch?v=JBDVKqfs_Ag]

Also check out our advanced [table rate shipping plugin for WooCommerce](http://tablerateshipping.com).

== Changelog ==

= 2.6.9 =
* Fixed: inconsistent decimal input handling in Shipping Classes section (https://wordpress.org/support/topic/please-enter-in-monetary-decimal-issue)

= 2.6.8 =
* Fixed: plugin settings are not changed on save with WooCommerce 2.3.10 (WooCommerce 2.3.10 compatibility issue)

= 2.6.6 =
* Introduced 'wbs_profile_settings_form' filter for better 3d-party extensions support
* Removed partial localization

= 2.6.5 =
* Min/Max Shipping Price options

= 2.6.3 =
* Improved upgrade warning system
* Fixed warning about Shipping Classes Overrides changes

= 2.6.2 =
* Fixed Shipping Classes Overrides: always apply base Handling Fee

= 2.6.1 =
* Introduced "Subtotal With Tax" option

= 2.6.0 =
* Min/Max Subtotal condition support

= 2.5.1 =
* Introduce "wbs_remap_shipping_class" filter to provide 3dparty plugins an ability to alter shipping cost calculation
* Wordpress 4.1 compatibility testing

= 2.5.0 =

* Shipping classes support
* Ability to choose all countries except specified
* Select All/None buttons for countries
* Purge shipping price calculations cache on configuration changes to reflect actual config immediatelly
* Profiles table look tweaks
* Other small tweaks

= 2.4.2 =

* Fixed: deleting non-currently selected configuration deletes first configuration from the list

= 2.4.1 =

* Updated pot-file required for translations
* Added three nice buttons to plugin settings page
* Prevent buttons in Actions column from wrapping on multiple lines

= 2.4.0 =

* By default, apply Shipping Rate to the extra weight part exceeding Min Weight. Also a checkbox added to switch off this feature.

= 2.3.0 =

* Duplicate profile feature
* New 'Weight Step' option for rough gradual shipping price calculation
* Added more detailed description to the Handling Fee and Shipping Rate fields to make their purpose clear
* Plugin prepared for localization
* Refactoring

= 2.2.3 =

* Fixed: first time saving settings with fresh install does not save anything while reporting successful saving.
* Replace short php tags with their full equivalents to make code more portable.

= 2.2.2 =

Fix "parse error: syntax error, unexpected T_FUNCTION in woocommerce-weight-based-shipping.php on line 610" http://wordpress.org/support/topic/fatal-error-1164.

= 2.2.1 =

Allow zero weight shipping. Thus only Handling Fee is added to the final price.

Previously, weight based shipping option has not been shown to user if total weight of their cart is zero. Since version 2.2.1 this is changed so shipping option is available to user with price set to Handling Fee. If it does not suite your needs well you can return previous behavior by setting Min Weight to something a bit greater zero, e.g. 0.001, so that zero-weight orders will not match constraints and the shipping option will not be shown.

== Upgrade Notice ==

= 2.2.1 =

Allow zero weight shipping. Thus only Handling Fee is added to the final price.

Previously, weight based shipping option has not been shown to user if total weight of their cart is zero. Since version 2.2.1 this is changed so shipping option is available to user with price set to Handling Fee. If it does not suite your needs well you can return previous behavior by setting Min Weight to something a bit greater zero, e.g. 0.001, so that zero-weight orders will not match constraints and the shipping option will not be shown.

== Installation ==

1. Upload `woocommerce-weight-based-shipping` folder  to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. A configuration example
2. Another rule settings
3. How that could look to customer