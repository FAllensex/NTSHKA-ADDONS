<?php
// Initialize Namespace
namespace Elementor;
class ntshka_addons_timeline extends Widget_Base {

    public function get_name() {
        return  'ntshka-timeline-widget';
    }

    public function get_title() {
        return esc_html__( 'Ntshka timeline', 'ntshka-addons' );
    }

    public function get_script_depends() {
        return [
            'ntshka-script'
        ];
    }
    public function get_style_depends() {
        return [
            'ntshka-style',
        ];
    }
    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'ntshka-addons-category' ];
    }

    public function _register_controls() {

		$this->start_controls_section(
			'ntshka_timeline_general',
			[
				'label' => __( 'Timeline', 'ntshka-addons' ),
			]
		);

	
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'ntshka_timeline_list_title', [
				'label' => __( 'Title', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'ntshka-addons' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'ntshka_timeline_list_content', [
				'label' => __( 'Content', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Content' , 'ntshka-addons' ),
				'show_label' => false,
			]
		);
        $repeater->add_control(
			'ntshka_direction',
			[
				'label' => __( 'Alignment', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'l' => [
						'title' => __( 'Left', 'ntshka-addons' ),
						'icon' => 'fa fa-align-left',
					],
					'r' => [
						'title' => __( 'Right', 'ntshka-addons' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'right',
				'toggle' => true,
			]
		);
        $repeater->add_control(
			'ntshka_timeline_date', [
				'label' => __( 'Date', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '2020 december' , 'ntshka-addons' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'ntshka_timeline_list',
			[
				'label' => __( 'Timeline List', 'ntshka-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'ntshka_timeline_list_title' => __( 'Title #1', 'ntshka-addons' ),
						'ntshka_timeline_list_content' => __( 'Item content. Click the edit button to change this text.', 'ntshka-addons' ),
					],
					[
						'ntshka_timeline_list_title' => __( 'Title #2', 'ntshka-addons' ),
						'ntshka_timeline_list_content' => __( 'Item content. Click the edit button to change this text.', 'ntshka-addons' ),
					],
				],
				'title_field' => '{{{ ntshka_timeline_list_title }}}',
			]
		);

    $this->end_controls_section();
    // STYLING STARTS
    $this->start_controls_section(
		'ntshka_card2_tab',
		[
			'label' => __( 'NTSHKA Timeline Styling', 'ntshka-addons' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
     // COLOR
     $this->add_control(
        'ntshka_timeline_date_color',
        [
            'label' => __( 'Time  Color', 'ntshka-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .time ' => 'color: {{VALUE}}',
            ],
        ]
    );
      //  Background COLOR
      $this->add_control(
        'ntshka_timeline_date_bgcolor',
        [
            'label' => __( 'Time Background Color', 'ntshka-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'scheme' => [
                'type' => \Elementor\Scheme_Color::get_type(),
                'value' => \Elementor\Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '{{WRAPPER}} .time ' => 'background: {{VALUE}}',
            ],
        ]
    );
    $this->end_controls_section();
    }
    // Render the widget
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

    <ul class="ntshka-timeline">
    <?php
    	if ( $settings['ntshka_timeline_list'] ) {
            foreach (  $settings['ntshka_timeline_list'] as $item ) {
            echo '<li>';
                echo '<div class="direction-'.$item['ntshka_direction'].'">';
                echo '<div class="flag-wrapper">';
				echo '<span class="flag' . $item['_id'] . '">' . $item['ntshka_timeline_list_title'] . '</span>';
                echo '<span class="time-wrapper"><span class="time">'. $item['ntshka_timeline_date'].'</span></span>';
                echo '</div>';
				echo '<div class="desc">' . $item['ntshka_timeline_list_content'] . '</div>';
                echo '</div>';
            echo '</li>';
			}
		}
	
?>
</ul>
        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new ntshka_addons_timeline() );

