<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Load Customizer variables
$understrap_builder_comments_header = get_theme_mod( 'understrap_builder_comments_header', '');
$understrap_builder_comments_label = get_theme_mod( 'understrap_builder_comments_label', 'comment');
$understrap_builder_comments_text_align = get_theme_mod( 'understrap_builder_comments_text_align', '');
$understrap_builder_comments_form_order = get_theme_mod( 'understrap_builder_comments_form_order', '');
$understrap_builder_comments_comment_style = get_theme_mod( 'understrap_builder_comments_comment_style', '');

global $builder_default_spacings;
$understrap_builder_spacings_comments_outer = get_theme_mod( 'understrap_builder_spacings_comments_outer', $builder_default_spacings );
$understrap_builder_spacings_comments_title = get_theme_mod( 'understrap_builder_spacings_comments_title', $builder_default_spacings );
$understrap_builder_spacings_comments_list = get_theme_mod( 'understrap_builder_spacings_comments_list', $builder_default_spacings );
$understrap_builder_spacings_comments_individual = get_theme_mod( 'understrap_builder_spacings_comments_individual', $builder_default_spacings );
$understrap_builder_spacings_comments_form = get_theme_mod( 'understrap_builder_spacings_comments_form', $builder_default_spacings );

// Handle text align
$us_b_comments_class = '';
if($understrap_builder_comments_text_align != ''){
  $us_b_comments_class = 'text-'.$understrap_builder_comments_text_align;
}


/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="comments-area <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_comments_outer)); ?> <?php echo esc_attr($us_b_comments_class); ?>" id="comments">
  
  <?php if($understrap_builder_comments_form_order == 'before'){ ?>
	  <?php comment_form(array('class_form' => 'comment-form '.esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_comments_form)))); // Render comments form. ?>
  <?php } ?>

	<?php if ( have_comments() ) : ?>

    <?php if($understrap_builder_comments_header != 'disabled'){ ?>
      <h2 class="comments-title <?php echo esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_comments_title)); ?>">
        <?php if($understrap_builder_comments_header == ''){ ?>
          <?php
          $comments_number = get_comments_number();
          if ( 1 === (int) $comments_number ) {
            printf(
              /* translators: %s: post title */
              esc_html( 'One '.esc_attr($understrap_builder_comments_label).' on &ldquo;%s&rdquo;', 'comments title', 'understrap-builder' ),
              '<span>'.esc_html(get_the_title()).'</span>'
            );
          } else {
            printf( // WPCS: XSS OK.
              esc_html( _nx(
                '%1$s '.esc_attr($understrap_builder_comments_label).' on &ldquo;%2$s&rdquo;',
                '%1$s '.esc_attr($understrap_builder_comments_label).'s on &ldquo;%2$s&rdquo;',
                $comments_number,
                'comments title',
                'understrap-builder'
              ) ),
              number_format_i18n( $comments_number ),
              '<span>' . get_the_title() . '</span>'
            );
          }
          ?>
        <?php } ?>
        
        <?php if($understrap_builder_comments_header == 'page-break'){ ?>
          <?php
            $comments_number = get_comments_number();
            if ( 1 === (int) $comments_number ) {
              echo '1 '.ucfirst(esc_attr($understrap_builder_comments_label));
            } else {
              echo esc_attr($comments_number).' '.ucfirst(esc_attr($understrap_builder_comments_label)).'s';
            }
          ?>
        <?php } ?>
      </h2><!-- .comments-title -->
      <?php if($understrap_builder_comments_header == 'page-break'){ echo '<hr>'; } ?>
    <?php } ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<nav class="comment-navigation" id="comment-nav-above">

				<h1 class="screen-reader-text"><?php esc_html_e( ucfirst(esc_attr($understrap_builder_comments_label)).' navigation', 'understrap-builder' ); ?></h1>

				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous">
						<?php previous_comments_link( __( '&larr; Older '.ucfirst(esc_attr($understrap_builder_comments_label)).'s', 'understrap-builder' ) ); ?>
					</div>
				<?php } ?>

				<?php	if ( get_next_comments_link() ) { ?>
					<div class="nav-next">
						<?php next_comments_link( __( 'Newer '.ucfirst(esc_attr($understrap_builder_comments_label)).'s &rarr;', 'understrap-builder' ) ); ?>
					</div>
				<?php } ?>

			</nav><!-- #comment-nav-above -->

		<?php endif; // check for comment navigation. ?>


    <?php /* BUILDER Custom comment template */
    if($understrap_builder_comments_comment_style == ''){
      echo '<ol class="comment-list '.esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_comments_list)).'">';
      wp_list_comments(
        array(
          'style'      => 'ol',
          'short_ping' => true
        )
      );
      echo '</ol>';
    } else if($understrap_builder_comments_comment_style == 'image-side'){
      echo '<ol class="'.esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_comments_list)).'">';
      wp_list_comments( array(
          'style'         => 'ol',
          'max_depth'     => 4,
          'short_ping'    => true,
          'avatar_size'   => '50',
          'walker'        => new BUILDER_Bootstrap_Comment_Walker(),
      ) );
      echo '</ol>';
    }
    ?>
		

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<nav class="comment-navigation" id="comment-nav-below">

				<h1 class="screen-reader-text"><?php esc_html_e( ucfirst(esc_attr($understrap_builder_comments_label)).' navigation', 'understrap-builder' ); ?></h1>

				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous">
						<?php previous_comments_link( __( '&larr; Older '.ucfirst(esc_attr($understrap_builder_comments_label)).'s', 'understrap-builder' ) ); ?>
					</div>
				<?php } ?>

				<?php	if ( get_next_comments_link() ) { ?>
					<div class="nav-next">
						<?php next_comments_link( __( 'Newer '.ucfirst(esc_attr($understrap_builder_comments_label)).'s &rarr;', 'understrap-builder' ) ); ?>
					</div>
				<?php } ?>

			</nav>

		<?php endif; // check for comment navigation. ?>

	<?php endif; // endif have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

		<p class="no-comments"><?php esc_html_e( ucfirst(esc_attr($understrap_builder_comments_label)).' are closed.', 'understrap-builder' ); ?></p>

	<?php endif; ?>

  <?php if($understrap_builder_comments_form_order == ''){ ?>
	  <?php comment_form(array('class_form' => 'comment-form '.esc_attr(understrap_builder_spacings_handler($understrap_builder_spacings_comments_form)))); // Render comments form. ?>
  <?php } ?>

</div><!-- #comments -->
