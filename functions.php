<?php
// -------------------------------------------------------------------- //
// Add and save the ID settings
// -------------------------------------------------------------------- //
	add_action('admin_init', 'pluginchief_google_settings_register');

	/**
	 * pluginchief_google_settings_register function.
	 *
	 * @access public
	 * @return void
	 */
	function pluginchief_google_settings_register()
	{
	    $name = 'pluginchief_google_conversion_id_setting_field';
	    $page = 'general';
	    $section = 'default';
	    register_setting($page, $name, 'pluginchief_google_validator_id');
	    add_settings_field(
	        'pluginchief-id-value',
	        __('Google Remarketer ID', 'pluginchief'),
	        'pluginchief_google_field_id',
	        $page,
	        $section
	    );
	}

	/**
	 * pluginchief_google_validator_id function.
	 *
	 * @access public
	 * @param mixed $value
	 * @return void
	 */
	function pluginchief_google_validator_id($value) {
	    if(is_numeric($value)){
	        return $value;
	    }

	    add_settings_error(
	        'pluginchief_google_conversion_id_setting_field',
	        'pluginchiefre-id',
	        __('The google remarketer should be a numeric value', 'pluginchief'),
	        'error'
	    );

	    return '';
	}

	/**
	 * pluginchief_google_field_id function.
	 *
	 * @access public
	 * @return void
	 */
	function pluginchief_google_field_id() {

	    $setting = 'pluginchief_google_conversion_id_setting_field';

	    $val = get_option($setting, '');

	    printf(
	        '<input type="text" class="regular-text" name="%1$s" id="%1$s" value="%2$s" />',
	        esc_attr($setting),
	        esc_attr($val)
	    );
	}
// -------------------------------------------------------------------- //
// Add and save the Label settings
// -------------------------------------------------------------------- //
	add_action('admin_init', 'pluginchief_google_settings_register_label');

	/**
	 * pluginchief_google_settings_register_label function.
	 *
	 * @access public
	 * @return void
	 */
	function pluginchief_google_settings_register_label()
	{
	    $name = 'pluginchief_google_conversion_label_setting_field';
	    $page = 'general';
	    $section = 'default';
	    register_setting($page, $name, 'pluginchief_google_validator_label');
	    add_settings_field(
	        'pluginchief-label-value',
	        __('Google Remarketer Label', 'pluginchief'),
	        'pluginchief_google_field_label',
	        $page,
	        $section
	    );
	}

	/**
	 * pluginchief_google_validator_label function.
	 *
	 * @access public
	 * @param mixed $value
	 * @return void
	 */
	function pluginchief_google_validator_label($value) {
	    if(is_string($value)){
	        return $value;
	    }

	    add_settings_error(
	        'pluginchief_google_conversion_label_setting_field',
	        'pluginchiefre-label',
	        __('The google remarketer should be a numeric value', 'pluginchief'),
	        'error'
	    );

	    return '';
	}

	/**
	 * pluginchief_google_field_label function.
	 *
	 * @access public
	 * @return void
	 */
	function pluginchief_google_field_label() {

	    $setting = 'pluginchief_google_conversion_label_setting_field';

	    $val = get_option($setting, '');

	    printf(
	        '<input type="text" class="regular-text" name="%1$s" id="%1$s" value="%2$s" />',
	        esc_attr($setting),
	        esc_attr($val)
	    );
	}
// -------------------------------------------------------------------- //
// Call the scripts and the variables
// -------------------------------------------------------------------- //

	/**
	 * pluginchief_remarketer_call_the_script function.
	 *
	 * @access public
	 * @return void
	 */
	function pluginchief_remarketer_call_the_script(){

			$conversionid =  get_option('pluginchief_google_conversion_id_setting_field');
			$conversionlabel =  get_option('pluginchief_google_conversion_label_setting_field');

			//Define the pluginchief script
			wp_enqueue_script('pluginchiefremarketerscript', plugins_url('/script.js', __FILE__)
												,array('jquery')
												,false
												,true);
			//Define the array for the localization
			$pluginchiefRemarketerScript = array( 'pluginchief_google_conversion_id' => $conversionid, 'pluginchief_google_conversion_label' => $conversionlabel );
			//Localize the script
			wp_localize_script( 'pluginchiefremarketerscript', 'pluginchief_google_remarketer_variables', $pluginchiefRemarketerScript );
			//Queue the supplemental google scripts
			wp_enqueue_script('googleremarketerscript'
												,'www.googleadservices.com/pagead/conversion.js'
												,array('jquery')
												,false
												,true);

			echo '<noscript><div style="display:inline;"><img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/'.$conversionid.'/?value=0&label='.$conversionlabel.'&guid=ON&script=0"/></div></noscript>';
	}
	//Add the action to enqueue with scripts on front-end
	add_action('wp_enqueue_scripts', 'pluginchief_remarketer_call_the_script');