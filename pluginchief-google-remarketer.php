<?php
/*
Plugin Name: PluginChief Google Remarketer
Plugin URI: http://pluginchief.com
Description: PluginChief Google Remarketer : Add the google remarketer script to your page
Version: 1.0
Author: PluginChief, Jason Bahl, Brandon Camenisch
Author URI: http://pluginchief.com/
License: GPLv2 or later

 ___ _           _      ___ _    _      __
| _ \ |_  _ __ _(_)_ _ / __| |_ (_)___ / _|
|  _/ | || / _` | | ' \ (__| ' \| / -_)  _|
|_| |_|\_,_\__, |_|_||_\___|_||_|_\___|_|
           |___/*/



// -------------------------------------------------------------------- //
//	Set Up Plugin Constants
// -------------------------------------------------------------------- //

	// NOTE: PLUGINCHIEFCE = PluginChief Currently Editing
	define('PLUGINCHIEF_GOOGLE_REMARKETER_URL', plugin_dir_url(__FILE__));
	define('PLUGINCHIEF_GOOGLE_REMARKETER_PATH', plugin_dir_path(__FILE__));

// -------------------------------------------------------------------- //
//	Require Files
// -------------------------------------------------------------------- //
	//Classes
	require_once PLUGINCHIEF_GOOGLE_REMARKETER_PATH . 'plugin-update-checker.php';

	//Functions
	require_once PLUGINCHIEF_GOOGLE_REMARKETER_PATH . 'functions.php';

// -------------------------------------------------------------------- //
//	Init the updater
// -------------------------------------------------------------------- //
	function plchf_google_remarketer_plugin_updater() {
		if (class_exists('PluginUpdateChecker')) {

			$PluginChiefCurrentlyEditing = new PluginUpdateChecker( 'https://pluginchief.com/wp-content/plugins/pluginchief-updatechief/json/pluginchief-google-remarketer.json', __FILE__,'pluginchief-google-remarketer');
		}
	}
	add_action('plugins_loaded','plchf_google_remarketer_plugin_updater');