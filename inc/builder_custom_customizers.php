<?php

/* Additional BUILDER Customizer Classes */


if (class_exists('WP_Customize_Control')) {
  
  
  /* BUILDER PRO Upgrade Message */
  class BUILDER_Customize_upgrade_Control extends WP_Customize_Control {
    public $type = 'button';
    public function render_content() {
    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
          <div>
            <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <a href="https://builder.understrap.com/downloads/pro/" class="button-secondary" style="margin-top:4px" target="_blank">Upgrade To PRO</a>
            <p><em>Already upgraded? Be sure to active plugin & enter licence key in the <a href="<?php echo esc_attr(admin_url('themes.php?page=understrap-builder-settings')); ?>" target="_blank">BUILDER options page</a>.</em></p>
          </div>
      </label>
      <?php
    }
  }
  
  
  /* BUILDER Spacings Control */
  class BUILDER_Customize_Spacings_Control extends WP_Customize_Control {
    public $type = 'button';
    /**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'builder-spacings-css', trailingslashit(get_stylesheet_directory_uri()) . 'css/builder_customizer.css' );
		}
    public function render_content() {
      $builder_spacings_values = $this->value();
      $builder_spacings_values_obj = json_decode($builder_spacings_values);
      ?>
      <div class="builder_customizer_spacings" id="<?php echo esc_attr( $this->id ); ?>_parent">
        <?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
        <input type="hidden" class="builder_customizer_spacings_hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
        <div class="builder_customizer_spacings_outer">
          <div class="builder_customizer_spacings_margin">
            <p>Margin</p>
            <select class="builder_customizer_spacings_top spacing_mt">
              <option<?php if($builder_spacings_values_obj->mt=='mt-5'){echo ' selected';} ?>>mt-5</option>
              <option<?php if($builder_spacings_values_obj->mt=='mt-4'){echo ' selected';} ?>>mt-4</option>
              <option<?php if($builder_spacings_values_obj->mt=='mt-3'){echo ' selected';} ?>>mt-3</option>
              <option<?php if($builder_spacings_values_obj->mt=='mt-2'){echo ' selected';} ?>>mt-2</option>
              <option<?php if($builder_spacings_values_obj->mt=='mt-1'){echo ' selected';} ?>>mt-1</option>
              <option<?php if($builder_spacings_values_obj->mt=='mt-0'){echo ' selected';} ?>>mt-0</option>
              <option<?php if($builder_spacings_values_obj->mt==''){echo ' selected';} ?> value="">[none]</option>
              <option<?php if($builder_spacings_values_obj->mt=='mt-n1'){echo ' selected';} ?>>mt-n1</option>
              <option<?php if($builder_spacings_values_obj->mt=='mt-n2'){echo ' selected';} ?>>mt-n2</option>
              <option<?php if($builder_spacings_values_obj->mt=='mt-n3'){echo ' selected';} ?>>mt-n3</option>
              <option<?php if($builder_spacings_values_obj->mt=='mt-n4'){echo ' selected';} ?>>mt-n4</option>
              <option<?php if($builder_spacings_values_obj->mt=='mt-n5'){echo ' selected';} ?>>mt-n5</option>
            </select>
            <select class="builder_customizer_spacings_right spacing_mr">
              <option<?php if($builder_spacings_values_obj->mr=='mr-5'){echo ' selected';} ?>>mr-5</option>
              <option<?php if($builder_spacings_values_obj->mr=='mr-4'){echo ' selected';} ?>>mr-4</option>
              <option<?php if($builder_spacings_values_obj->mr=='mr-3'){echo ' selected';} ?>>mr-3</option>
              <option<?php if($builder_spacings_values_obj->mr=='mr-2'){echo ' selected';} ?>>mr-2</option>
              <option<?php if($builder_spacings_values_obj->mr=='mr-1'){echo ' selected';} ?>>mr-1</option>
              <option<?php if($builder_spacings_values_obj->mr=='mr-0'){echo ' selected';} ?>>mr-0</option>
              <option<?php if($builder_spacings_values_obj->mr==''){echo ' selected';} ?> value="">[none]</option>
              <option<?php if($builder_spacings_values_obj->mr=='mr-n1'){echo ' selected';} ?>>mr-n1</option>
              <option<?php if($builder_spacings_values_obj->mr=='mr-n2'){echo ' selected';} ?>>mr-n2</option>
              <option<?php if($builder_spacings_values_obj->mr=='mr-n3'){echo ' selected';} ?>>mr-n3</option>
              <option<?php if($builder_spacings_values_obj->mr=='mr-n4'){echo ' selected';} ?>>mr-n4</option>
              <option<?php if($builder_spacings_values_obj->mr=='mr-n5'){echo ' selected';} ?>>mr-n5</option>
            </select>
            <select class="builder_customizer_spacings_bottom spacing_mb">
              <option<?php if($builder_spacings_values_obj->mb=='mb-5'){echo ' selected';} ?>>mb-5</option>
              <option<?php if($builder_spacings_values_obj->mb=='mb-4'){echo ' selected';} ?>>mb-4</option>
              <option<?php if($builder_spacings_values_obj->mb=='mb-3'){echo ' selected';} ?>>mb-3</option>
              <option<?php if($builder_spacings_values_obj->mb=='mb-2'){echo ' selected';} ?>>mb-2</option>
              <option<?php if($builder_spacings_values_obj->mb=='mb-1'){echo ' selected';} ?>>mb-1</option>
              <option<?php if($builder_spacings_values_obj->mb=='mb-0'){echo ' selected';} ?>>mb-0</option>
              <option<?php if($builder_spacings_values_obj->mb==''){echo ' selected';} ?> value="">[none]</option>
              <option<?php if($builder_spacings_values_obj->mb=='mb-n1'){echo ' selected';} ?>>mb-n1</option>
              <option<?php if($builder_spacings_values_obj->mb=='mb-n2'){echo ' selected';} ?>>mb-n2</option>
              <option<?php if($builder_spacings_values_obj->mb=='mb-n3'){echo ' selected';} ?>>mb-n3</option>
              <option<?php if($builder_spacings_values_obj->mb=='mb-n4'){echo ' selected';} ?>>mb-n4</option>
              <option<?php if($builder_spacings_values_obj->mb=='mb-n5'){echo ' selected';} ?>>mb-n5</option>
            </select>
            <select class="builder_customizer_spacings_left spacing_ml">
              <option<?php if($builder_spacings_values_obj->ml=='ml-5'){echo ' selected';} ?>>ml-5</option>
              <option<?php if($builder_spacings_values_obj->ml=='ml-4'){echo ' selected';} ?>>ml-4</option>
              <option<?php if($builder_spacings_values_obj->ml=='ml-3'){echo ' selected';} ?>>ml-3</option>
              <option<?php if($builder_spacings_values_obj->ml=='ml-2'){echo ' selected';} ?>>ml-2</option>
              <option<?php if($builder_spacings_values_obj->ml=='ml-1'){echo ' selected';} ?>>ml-1</option>
              <option<?php if($builder_spacings_values_obj->ml=='ml-0'){echo ' selected';} ?>>ml-0</option>
              <option<?php if($builder_spacings_values_obj->ml==''){echo ' selected';} ?> value="">[none]</option>
              <option<?php if($builder_spacings_values_obj->ml=='ml-n1'){echo ' selected';} ?>>ml-n1</option>
              <option<?php if($builder_spacings_values_obj->ml=='ml-n2'){echo ' selected';} ?>>ml-n2</option>
              <option<?php if($builder_spacings_values_obj->ml=='ml-n3'){echo ' selected';} ?>>ml-n3</option>
              <option<?php if($builder_spacings_values_obj->ml=='ml-n4'){echo ' selected';} ?>>ml-n4</option>
              <option<?php if($builder_spacings_values_obj->ml=='ml-n5'){echo ' selected';} ?>>ml-n5</option>
            </select>
            <div class="builder_customizer_spacings_padding">
              <div class="builder_customizer_spacings_inner">
                <p>Padding</p>
                <select class="builder_customizer_spacings_top spacing_pt">
                  <option<?php if($builder_spacings_values_obj->pt=='pt-5'){echo ' selected';} ?>>pt-5</option>
                  <option<?php if($builder_spacings_values_obj->pt=='pt-4'){echo ' selected';} ?>>pt-4</option>
                  <option<?php if($builder_spacings_values_obj->pt=='pt-3'){echo ' selected';} ?>>pt-3</option>
                  <option<?php if($builder_spacings_values_obj->pt=='pt-2'){echo ' selected';} ?>>pt-2</option>
                  <option<?php if($builder_spacings_values_obj->pt=='pt-1'){echo ' selected';} ?>>pt-1</option>
                  <option<?php if($builder_spacings_values_obj->pt=='pt-0'){echo ' selected';} ?>>pt-0</option>
                  <option<?php if($builder_spacings_values_obj->pt==''){echo ' selected';} ?> value="">[none]</option>
                </select>
                <select class="builder_customizer_spacings_right spacing_pr">
                  <option<?php if($builder_spacings_values_obj->pr=='pr-5'){echo ' selected';} ?>>pr-5</option>
                  <option<?php if($builder_spacings_values_obj->pr=='pr-4'){echo ' selected';} ?>>pr-4</option>
                  <option<?php if($builder_spacings_values_obj->pr=='pr-3'){echo ' selected';} ?>>pr-3</option>
                  <option<?php if($builder_spacings_values_obj->pr=='pr-2'){echo ' selected';} ?>>pr-2</option>
                  <option<?php if($builder_spacings_values_obj->pr=='pr-1'){echo ' selected';} ?>>pr-1</option>
                  <option<?php if($builder_spacings_values_obj->pr=='pr-0'){echo ' selected';} ?>>pr-0</option>
                  <option<?php if($builder_spacings_values_obj->pr==''){echo ' selected';} ?> value="">[none]</option>
                </select>
                <select class="builder_customizer_spacings_bottom spacing_pb">
                  <option<?php if($builder_spacings_values_obj->pb=='pb-5'){echo ' selected';} ?>>pb-5</option>
                  <option<?php if($builder_spacings_values_obj->pb=='pb-4'){echo ' selected';} ?>>pb-4</option>
                  <option<?php if($builder_spacings_values_obj->pb=='pb-3'){echo ' selected';} ?>>pb-3</option>
                  <option<?php if($builder_spacings_values_obj->pb=='pb-2'){echo ' selected';} ?>>pb-2</option>
                  <option<?php if($builder_spacings_values_obj->pb=='pb-1'){echo ' selected';} ?>>pb-1</option>
                  <option<?php if($builder_spacings_values_obj->pb=='pb-0'){echo ' selected';} ?>>pb-0</option>
                  <option<?php if($builder_spacings_values_obj->pb==''){echo ' selected';} ?> value="">[none]</option>
                </select>
                <select class="builder_customizer_spacings_left spacing_pl">
                  <option<?php if($builder_spacings_values_obj->pl=='pl-5'){echo ' selected';} ?>>pl-5</option>
                  <option<?php if($builder_spacings_values_obj->pl=='pl-4'){echo ' selected';} ?>>pl-4</option>
                  <option<?php if($builder_spacings_values_obj->pl=='pl-3'){echo ' selected';} ?>>pl-3</option>
                  <option<?php if($builder_spacings_values_obj->pl=='pl-2'){echo ' selected';} ?>>pl-2</option>
                  <option<?php if($builder_spacings_values_obj->pl=='pl-1'){echo ' selected';} ?>>pl-1</option>
                  <option<?php if($builder_spacings_values_obj->pl=='pl-0'){echo ' selected';} ?>>pl-0</option>
                  <option<?php if($builder_spacings_values_obj->pl==''){echo ' selected';} ?> value="">[none]</option>
                </select>
                <img src="<?php echo trailingslashit(get_stylesheet_directory_uri()).'img/builder-logo-mini-64-64.png'; ?>" width="32" height="32" alt="BUILDER Mini Logo" class="builder_customizer_spacings_logo" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
  }
   
}


/* BUILDER Sanitize HTML Input */
function understrap_builder_html_sanitize( $input ) {
  return stripslashes(wp_filter_post_kses(addslashes($input)));
}


/* BUILDER Sanitize Spacings Input */
function understrap_builder_sanitize_spacings( $input ) {
  return $input;
}