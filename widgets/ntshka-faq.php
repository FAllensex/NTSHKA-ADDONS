<?php

// Initialize Namespace
namespace Elementor;
class ntshka_addons_faq extends Widget_Base {

    public function get_name() {
        return  'ntshka-faq-widget';
    }

    public function get_title() {
        return esc_html__( 'Ntshka faq', 'ntshka-addons' );
    }

    public function get_script_depends() {
        return [
            'ntshka-script'
        ];
    }
    public function get_style_depends() {
        return [
            'ntshka-style'
        ];
    }
    public function get_icon() {
        return ' eicon-animated-faq';
    }

    public function get_categories() {
        return [ 'ntshka-addons-category' ];
    }

    public function _register_controls() {
        // Section Starts
        $this->start_controls_section(
			'ntshka_faq_general',
			[
				'label' => __( 'General', 'ntshka-addons' ),
			]
		);
  

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'ntshka_faq_list_title', [
				'label' => __( 'Title', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'ntshka-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'ntshka_faq_list_content', [
				'label' => __( 'Content', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Content' , 'ntshka-addons' ),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'ntshka_list_color',
			[
				'label' => __( 'Color', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
				],
			]
		);
   //  FAQ Typography
   $repeater->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name' => 'ntshka_faq_title_typography',
        'label' => __( 'Title Typography', 'ntshka-addons' ),
        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .ntashka-faq-details ',
    ]
);
		$this->add_control(
			'ntshka_faq_list',
			[
				'label' => __( 'Repeater List', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'ntshka_faq_list_title' => __( 'Title #1', 'ntshka-addons' ),
						'ntshka_faq_list_content' => __( 'Item content. Click the edit button to change this text.', 'ntshka-addons' ),
					],
					[
						'ntshka_faq_list_title' => __( 'Title #2', 'ntshka-addons' ),
						'ntshka_faq_list_content' => __( 'Item content. Click the edit button to change this text.', 'ntshka-addons' ),
					],
				],
				'title_field' => '{{{ ntshka_faq_list_title }}}',
			]
		);
     

       $this->end_controls_section();
       // STYLING BEGINS
       $this->start_controls_section(
        'ntshka_faq_tab',
        [
          'label' => __( 'NTSHKA FAQ Styling', 'ntshka-addons' ),
          'tab' => Controls_Manager::TAB_STYLE,
        ]
      );
         // Background COLOR
    $this->add_control(
      'ntshka_faq_bg_color',
      [
          'label' => __( 'Background Color', 'ntshka-addons' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'scheme' => [
              'type' => \Elementor\Scheme_Color::get_type(),
              'value' => \Elementor\Scheme_Color::COLOR_1,
          ],
          'selectors' => [
              '{{WRAPPER}} .ntashka-faq-details ' => 'background-color: {{VALUE}}',
          ],
      ]
  );
   //  FAQ Typography
   $this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name' => 'ntshka_card2_main_typography',
        'label' => __( ' Headline Typography', 'ntshka-addons' ),
        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .ntashka-faq-details p ',
    ]
);
      $this->end_controls_section();
    }
    // Render the widget
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
<?php
if ( $settings['ntshka_faq_list'] ) {
 
  foreach (  $settings['ntshka_faq_list'] as $item ) {
    echo '<details class="ntashka-faq-details">';
    echo '<summary class="elementor-repeater-item-' . $item['_id'] . '">' . $item['ntshka_faq_list_title'];
    echo '<svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#expand-more" /></svg>';
    echo '<svg class="control-icon control-icon-close" width="24" height="24" role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close" /></svg> ';
    echo '</summary>';
    echo '<p>' . $item['ntshka_faq_list_content'] . '</p>';
    echo '</details>';
  }
}

?>

       <?php
    }


}
Plugin::instance()->widgets_manager->register_widget_type( new ntshka_addons_faq() );