<?php

/**
 * Post_Comments Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\PostComments\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use CodexShaper\Framework\Foundation\Traits\Control\Fields;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Plugin;

// Exit if access directly.
if (! defined('ABSPATH')) {
	exit();
}

/**
 * Post_Comments widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Post_Comments extends Widget
{
	use Fields;

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'cxf--post-comments';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('CXF Post Comments', 'codexshaper-framework');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-comments';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return array('Post Comments', 'Comments', 'Post', 'CodexShaper', 'CodexShaper Framework', 'CXF');
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return array('cxf--widget');
	}

	/**
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the widget requires.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget style dependencies.
	 */
	public function get_style_depends(): array
	{
		return array('cxf--post-comments');
	}

	/**
	 * Register Elementor widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_controls()
	{

		// Register style controls.
		$this->register_style_comments_controls();
		// Register style controls.
		$this->register_style_comments_form_controls();
		// Register style controls.
		$this->register_style_comments_reply_btn_controls();
		// Register style controls.
		$this->register_style_comments_form_input_controls();
		// Register style controls.
		$this->register_style_comments_form_textarea_controls();
		// Register style controls.
		$this->register_style_comments_form_checkbox_controls();
		// Register style controls.
		$this->register_style_comments_form_btn_controls();
	}

	/**
	 * Register Elementor widget style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_style_comments_controls()
	{
		$this->start_controls_section(
			'comments_section_style',
			array(
				'label' => __('Comments', 'codexshaper-framework'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'total_comments_heading',
			array(
				'label'     => esc_html__('Total Comments', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_layout_controls(
			'total_comments_space',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-title',
			)
		);

		$this->common_text_controls(
			'total_comments_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-title',
			)
		);

		$this->add_control(
			'author_name_heading',
			array(
				'label'     => esc_html__('Author Name', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_space_controls(
			'comments_author_name_space',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .content .title',
			)
		);

		$this->common_text_controls(
			'comments_author_name_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .content .title',
			)
		);

		$this->add_control(
			'comments_date_heading',
			array(
				'label'     => esc_html__('Date', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_space_controls(
			'comments_date_space',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .date',
			)
		);

		$this->common_text_controls(
			'comments_date_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .date',
			)
		);

		$this->add_control(
			'comment_text_heading',
			array(
				'label'     => esc_html__('Comment Text', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_space_controls(
			'comment_text_space',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .content p',
			)
		);

		$this->common_text_controls(
			'comment_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .content p',
			)
		);

		$this->add_control(
			'comment_author_thumb_heading',
			array(
				'label'     => esc_html__('Comment Author Image', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->common_space_controls(
			'comment_author_image_space',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .thumb img',
			)
		);

		$this->common_image_controls(
			'comment_author_image',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .thumb img',
			)
		);

		$this->add_control(
			'comment_author_thumb_wrapper_heading',
			array(
				'label'     => esc_html__('Comment Author Image Wrapper', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_space_controls(
			'comment_author_image_wrapper',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .thumb',
			)
		);

		// Write style controls here.

		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_style_comments_reply_btn_controls()
	{
		$this->start_controls_section(
			'comment_reply_btn_section_style',
			array(
				'label' => __('Reply Button', 'codexshaper-framework'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->common_layout_controls(
			'reply_btn_layout',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .content .comment-reply-link',
			)
		);

		// tabs.
		$this->start_controls_tabs(
			'reply_btn_style_tabs'
		);

		$this->start_controls_tab(
			'reply_btn_style_normal_tab',
			array(
				'label' => esc_html__('Normal', 'codexshaper-framework'),
			)
		);

		$this->common_text_controls(
			'reply_btn_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .content .comment-reply-link',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'reply_btn_style_hover_tab',
			array(
				'label' => esc_html__('Hover', 'codexshaper-framework'),
			)
		);

		$this->common_text_controls(
			'reply_btn_text_hover',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .content .comment-reply-link:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'reply_btn_hover_background',
				'types'     => array('classic', 'gradient'),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-list li .single-comment-wrap .content .comment-reply-link:hover',
			)
		);

		$this->add_responsive_control(
			'reply_border_color_hover',
			array(
				'label'     => esc_html__('Border Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--comment-wrap .submit-btn:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget comment form style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_style_comments_form_controls()
	{
		$this->start_controls_section(
			'comment_form_section_style',
			array(
				'label' => __('Comment Form', 'codexshaper-framework'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'comment_form_title_heading',
			array(
				'label'     => esc_html__('Heading Title', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->common_space_controls(
			'comment_form_title_space',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-reply-title',
			)
		);

		$this->common_text_controls(
			'comment_form_title_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comments-area .comment-reply-title',
			)
		);

		$this->add_control(
			'comment_form_info_heading',
			array(
				'label'     => esc_html__('Info Text', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->common_layout_controls(
			'comment_form_info_text_space',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form .logged-in-as',
			)
		);

		$this->common_text_controls(
			'comment_form_info_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form .logged-in-as',
			)
		);

		$this->add_control(
			'comment_form_info_link_heading',
			array(
				'label'     => esc_html__('Info Link', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// tabs.
		$this->start_controls_tabs(
			'comment_form_info_link_style_tabs'
		);

		$this->start_controls_tab(
			'comment_form_info_link_style_normal_tab',
			array(
				'label' => esc_html__('Normal', 'codexshaper-framework'),
			)
		);

		$this->common_text_controls(
			'comment_form_info_link_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form .logged-in-as a',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'comment_form_info_link_style_hover_tab',
			array(
				'label' => esc_html__('Hover', 'codexshaper-framework'),
			)
		);

		$this->common_text_controls(
			'comment_form_info_link_text_hover',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form .logged-in-as a:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget comment input style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_style_comments_form_input_controls()
	{
		$this->start_controls_section(
			'comment_form_input_section_style',
			array(
				'label' => __('Form Input', 'codexshaper-framework'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'input_wrapper_heading',
			array(
				'label'     => esc_html__('Input Wrapper', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_space_controls(
			'input_wrapper_text_space',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group',
			)
		);

		$this->add_control(
			'input_box_heading',
			array(
				'label'     => esc_html__('Input Box', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_layout_controls(
			'input_box_layout',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group input.form-control',
			)
		);

		// tabs.
		$this->start_controls_tabs(
			'input_box_style_tabs'
		);

		$this->start_controls_tab(
			'input_box_style_normal_tab',
			array(
				'label' => esc_html__('Normal', 'codexshaper-framework'),
			)
		);

		$this->common_text_controls(
			'input_box_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group input.form-control',
			)
		);

		$this->add_control(
			'input_placeholder_color',
			array(
				'label'     => __('Placeholder Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group input.form-control::placeholder' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'input_box_style_focus_tab',
			array(
				'label' => esc_html__('Focus', 'codexshaper-framework'),
			)
		);

		$this->common_text_controls(
			'input_box_text_focus',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group input.form-control:focus',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'input_box_text_focus_background',
				'types'     => array('classic', 'gradient'),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group input.form-control:focus',
			)
		);

		$this->add_control(
			'input_border_color_focus',
			array(
				'label'     => __('Border Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group input.form-control:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget comment textarea style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_style_comments_form_textarea_controls()
	{
		$this->start_controls_section(
			'comment_form_textarea_section_style',
			array(
				'label' => __('Textarea', 'codexshaper-framework'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->common_layout_controls(
			'comment_form_textarea',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group.textarea .form-control',
			)
		);

		// tabs.
		$this->start_controls_tabs(
			'comment_form_textarea_style_tabs'
		);

		$this->start_controls_tab(
			'comment_form_textarea_style_normal_tab',
			array(
				'label' => esc_html__('Normal', 'codexshaper-framework'),
			)
		);

		$this->common_text_controls(
			'textarea_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group.textarea .form-control',
			)
		);

		$this->add_control(
			'textarea_placeholder_color',
			array(
				'label'     => __('Placeholder Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group.textarea .form-control::placeholder' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'comment_form_textarea_style_focus_tab',
			array(
				'label' => esc_html__('Focus', 'codexshaper-framework'),
			)
		);

		$this->common_text_controls(
			'textarea_text_focus',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group.textarea .form-control:focus',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'input_box_textarea_focus_background',
				'types'     => array('classic', 'gradient'),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group.textarea .form-control:focus',
			)
		);

		$this->add_control(
			'textarea_border_color_focus',
			array(
				'label'     => __('Border Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--comment-wrap .comment-form .form-group.textarea .form-control:focus' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget comment form checkbox style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_style_comments_form_checkbox_controls()
	{
		$this->start_controls_section(
			'comment_form_checkbox_section_style',
			array(
				'label' => __('Checkbox', 'codexshaper-framework'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->common_layout_controls(
			'form_checkbox_layout',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .comment-form-cookies-consent',
			)
		);

		$this->common_text_controls(
			'form_checkbox_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap label[for=wp-comment-cookies-consent]',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget comment form button style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_style_comments_form_btn_controls()
	{
		$this->start_controls_section(
			'comment_form_btn_section_style',
			array(
				'label' => __('Submit Button', 'codexshaper-framework'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'btn_wrapper_heading',
			array(
				'label'     => esc_html__('Button Wrapper', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_space_controls(
			'btn_wrapper_space',
			options: array(
				'selector' => '{{WRAPPER}} .comments-area .form-submit',
			)
		);

		$this->add_control(
			'form_btn_heading',
			array(
				'label'     => esc_html__('Button', 'codexshaper-framework'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_layout_controls(
			'form_btn_layout',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .submit-btn',
			)
		);

		// tabs.
		$this->start_controls_tabs(
			'form_btn_style_tabs'
		);

		$this->start_controls_tab(
			'form_btn_style_normal_tab',
			array(
				'label' => esc_html__('Normal', 'codexshaper-framework'),
			)
		);

		$this->common_text_controls(
			'form_btn_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .submit-btn',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'form_btn_style_hover_tab',
			array(
				'label' => esc_html__('Hover', 'codexshaper-framework'),
			)
		);

		$this->common_text_controls(
			'form_btn_text_hover',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--comment-wrap .submit-btn:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'form_btn_focus_background',
				'types'     => array('classic', 'gradient'),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--comment-wrap .submit-btn:hover',
			)
		);

		$this->add_responsive_control(
			'form_border_color_hover',
			array(
				'label'     => esc_html__('Border Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--comment-wrap .submit-btn:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render Elementor widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return void
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		if (! comments_open() && (Plugin::instance()->preview->is_preview_mode() || Plugin::instance()->editor->is_edit_mode())) {
			cxf_view('post-comments.alert');
		} else {
			cxf_view('post-comments.content');
		}
	}
}
