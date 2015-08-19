<?php
/**
 * Briar Theme Customizer Controls
 *
 * @package Briar
 * @since 1.0
 */

/**
 * Customize Layout Control Class
 *
 * @package Briar
 * @since 1.0
 */
class briar_Layout_Control extends WP_Customize_Control {
	/**
	 * @access public
	 * @var string
	 */
	public $type = 'layout';

	/**
	 * @access public
	 * @var array
	 */
	public $layouts;

	/**
	 * Constructor.
	 *
	 * @since 1.0
	 * @uses WP_Customize_Control::__construct()
	 *
	 * @param WP_Customize_Manager $manager
	 * @param string $id
	 * @param array $args
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$this->layouts = $args[ 'layouts' ];
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @since 1.0
	 */
	public function enqueue() {
		wp_enqueue_style( 'customize-control-layout' );
		wp_enqueue_script( 'customize-control-layout' );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @since 1.0
	 * @uses WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();
		$this->json['layouts'] = $this->layouts;
	}

	/**
	 * Render the control's content.
	 *
	 * @since 1.0
	 */
	public function render_content() {
		if ( empty( $this->layouts ) )
			return;

		$name = '_customize-layout-' . $this->id;

		?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="customize-control-content">
			<div class="radios">
			<?php
			foreach ( $this->layouts as $value => $layout ) :
				?>
				<label>
					<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
					<?php echo esc_html( $layout[ 'label' ] ); ?><br/>
				</label>
				<?php
			endforeach;
			?>
			</div>
			<div class="selection"><!--
			<?php
			foreach ( $this->layouts as $value => $layout ) :
				?>
				--><div class="layout" data-value="<?php echo $value; ?>">
					<div class="icon"><?php echo esc_html( $layout[ 'label' ] ); ?></div>
				</div><!--
				<?php
			endforeach;
			?>
			--></div>
		</div>
		<?php
	}
}

/**
 * Customize Color Scheme Control Class
 *
 * @package Briar
 * @since 1.0
 */
class briar_Color_Scheme_Control extends WP_Customize_Control {
	/**
	 * @access public
	 * @var string
	 */
	public $type = 'color-scheme';

	/**
	 * @access public
	 * @var array
	 */
	public $schemes;

	/**
	 * Constructor.
	 *
	 * @since 1.0
	 * @uses WP_Customize_Control::__construct()
	 *
	 * @param WP_Customize_Manager $manager
	 * @param string $id
	 * @param array $args
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$this->schemes = $args[ 'schemes' ];
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @since 1.0
	 */
	public function enqueue() {
		wp_enqueue_style( 'customize-control-color-scheme' );
		wp_enqueue_script( 'customize-control-color-scheme' );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @since 1.0
	 * @uses WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();
		$this->json['schemes'] = $this->schemes;
	}

	/**
	 * Render the control's content.
	 *
	 * @since 1.0
	 */
	public function render_content() {
		if ( empty( $this->schemes ) )
			return;

		$name = '_customize-schemes-' . $this->id;

		?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="customize-control-content">
			<div class="radios">
			<?php
			foreach ( $this->schemes as $value => $scheme ) :
				?>
				<label>
					<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
					<?php echo esc_html( $scheme[ 'label' ] ); ?><br/>
				</label>
				<?php
			endforeach;
			?>
			</div>
			<div class="selection">
			<div class="scheme" data-value="custom">
				<div class="color">
					<div class="c1"></div><!--
					--><div class="c2"></div><!--
					--><div class="c3"></div><!--
					--><div class="c4"></div><!--
					--><div class="c5"></div><!--
					--><div class="c6"></div><!--
					--><div class="c7"></div><!--
					--><div class="c8"></div><!--
					--><div class="c9"></div>
				</div>
			</div><!--
			<?php
			foreach ( $this->schemes as $value => $scheme ) :
				?>
				--><div class="scheme" data-value="<?php echo $value; ?>">
					<div class="color" style="background-color: <?php echo $scheme[ 'color' ]; ?>;"></div>
				</div><!--
				<?php
			endforeach;
			?>
			--></div>
			<div class="actions">
				<a href="javascript:void(null)" class="button apply-scheme"><?php _e( 'Apply scheme', 'briar' ); ?></a>
			</div>
		</div>
		<?php
	}
}

/**
 * Customize Social Buttons Control Class
 *
 * @package Briar
 * @since 1.0
 */
class briar_Social_Buttons_Control extends WP_Customize_Control {
	/**
	 * @access public
	 * @var string
	 */
	public $type = 'social-buttons';

	/**
	 * @access public
	 * @var array
	 */
	public $socials;

	/**
	 * Constructor.
	 *
	 * @since 1.0
	 * @uses WP_Customize_Control::__construct()
	 *
	 * @param WP_Customize_Manager $manager
	 * @param string $id
	 * @param array $args
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$this->socials = $args[ 'socials' ];
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @since 1.0
	 */
	public function enqueue() {
		wp_enqueue_style( 'customize-control-social-buttons' );
		wp_enqueue_script( 'customize-control-social-buttons' );
	}

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @since 1.0
	 * @uses WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();
		$this->json['socials'] = $this->socials;
	}

	/**
	 * Render the control's content.
	 *
	 * @since 1.0
	 */
	public function render_content() {
		if ( empty( $this->socials ) )
			return;

		$name = '_customize-social-buttons-' . $this->id;

		?>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="customize-control-content">
			<script type="text/html" id="tmpl-social-button">
				<div class="social-button">
				<#
						var social_value = data.social == 'custom' ? data.social_value : data.social;
					#>
					<div class="preview">
						<div class="social-button-preview"><div class="social-icon<# if ( data.css_class ) { #> social-icons--{{ data.css_class }}<# } #>"></div><div class="social-value">{{ social_value }}</div></div>
						<div class="reorder-button move-down"><?php _e( 'Move down', 'briar' ); ?></div>
						<div class="reorder-button move-up"><?php _e( 'Move up', 'briar' ); ?></div>
						<div class="remove-button"><?php _e( 'Remove', 'briar' ); ?></div>
					</div>
					<div class="fields"<# if ( !data.editing ) { #> style="display: none"<# } #>>
						<input type="hidden" class="css-class"<# if ( data.css_class ) { #> value="{{ data.css_class }}"<# } #>>
						<select class="social">
						<?php
							foreach ( $this->socials as $value => $social ) :
							?>
							<option value="<?php echo $value; ?>"<# if ( data.social == '<?php echo $value; ?>' ) { #> selected="selected"<# } #>><?php echo $social['label']; ?></option>
							<?php
						endforeach;
						?>
							<option value="custom"<# if ( data.social == 'custom' ) { #> selected="selected"<# } #>><?php _e( 'Custom', 'briar' ); ?></option>
						</select>
						<br /><br />
						<div class="custom-social"<# if ( data.social != 'custom' ) { #>  style="display: none"<# } #>>
							<input type="text" placeholder="<?php echo esc_attr( __( 'Social Network Name', 'briar' ) ); ?>"<# if ( data.social_value ) { #> value="{{ data.social_value }}"<# } #> />
							<br /><br />
						</div>
						<input type="text" placeholder="<?php echo esc_attr( __( 'URL', 'briar' ) ); ?>" class="url"<# if ( data.url ) { #> value="{{ data.url }}"<# } #> />
					</div>
				</div>
			</script>
			<div class="actions">
				<a href="javascript:void(null)" class="button add-social-button"><?php _e( 'New Social Button', 'briar' ); ?></a>
			</div>
			<br />
			<div class="social-buttons"></div>
			<br />
			<div class="actions">
				<a href="javascript:void(null)" class="button add-social-button"><?php _e( 'New Social Button', 'briar' ); ?></a>
			</div>
		</div>
		<?php
	}
}
