<?php
namespace WprAddons\Modules\LottieAnimations\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit;

class Wpr_Lottie_Animations extends Widget_Base {
		
	public function get_name() {
		return 'wpr-lottie-animations';
	}

	public function get_title() {
		return esc_html__( 'Lottie Animations', 'wpr-addons' );
	}

	public function get_icon() {
		return 'wpr-icon eicon-lottie';
	}

	public function get_categories() {
		return [ 'wpr-widgets'];
	}

	public function get_keywords() {
		return [ 'lottie', 'animation', 'animations', 'svg' ];
	}
	
	public function get_script_depends() {
		return [ 'wpr-lottie-animations' ];
	}

    public function get_custom_help_url() {
    	if ( empty(get_option('wpr_wl_plugin_links')) )
        return 'https://royal-elementor-addons.com/contact/?ref=rea-plugin-panel-lottie-animations-help-btn';
    }
	
	protected function register_controls() {

		// Section: Settings ---------
		$this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Settings', 'wpr-addons' ),
			]
		);

		$this->add_control(
			'json_url',
			[
				'label' => esc_html__( 'Animation JSON URL', 'wpr-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->end_controls_section(); // End Controls Section
	
	}

	protected function render() {
		// Get Settings
		$settings = $this->get_settings();

		echo '<div class="wpr-lottie-animations" data-json-url="'. esc_url($settings['json_url']) .'"></div>';

	}
}