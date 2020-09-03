<?php
/**
 * Comment layout.
 *
 * @package understrap-builder
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/* OVERRIDE UnderStrap Comment Form Fields Filter */

if ( ! function_exists( 'understrap_bootstrap_comment_form_fields' ) ) {

	function understrap_bootstrap_comment_form_fields( $fields ) {
    
    // Load Customizer options
    $understrap_builder_comments_form_layout = get_option( 'understrap_builder_comments_form_layout', '');
    
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );
		$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
		$consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
    
    // BUILDER Form layout
    if($understrap_builder_comments_form_layout == ''){ // Standard vertical layout
      $fields    = array(
        'author'  => '<div class="form-group comment-form-author"><label for="author">' . __( 'Name',
            'understrap-builder' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . '></div>',
        'email'   => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email',
            'understrap-builder' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . '></div>',
        'url'     => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website',
            'understrap-builder' ) . '</label> ' .
                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"></div>',
        'cookies' => '<div class="form-group form-check comment-form-cookies-consent"><input class="form-check-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' /> ' .
                 '<label class="form-check-label" for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment', 'understrap-builder' ) . '</label></div>',
      );
    } else if($understrap_builder_comments_form_layout == 'horizontal'){ // Horizontal layout
      $fields    = array(
        'author'  => '<div class="row"><div class="col-md-4"><div class="form-group comment-form-author"><label for="author">' . __( 'Name',
            'understrap-builder' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . '></div></div>',
        'email'   => '<div class="col-md-4"><div class="form-group comment-form-email"><label for="email">' . __( 'Email',
            'understrap-builder' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . '></div></div>',
        'url'     => '<div class="col-md-4"><div class="form-group comment-form-url"><label for="url">' . __( 'Website',
            'understrap-builder' ) . '</label> ' .
                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"></div></div></div>',
        'cookies' => '<div class="form-group form-check comment-form-cookies-consent text-left"><input class="form-check-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' /> ' .
                 '<label class="form-check-label" for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment', 'understrap-builder' ) . '</label></div>',
      );
    }

		return $fields;
	}
}



/* OVERRIDE UnderStrap Comment Form Filter */

if ( ! function_exists( 'understrap_bootstrap_comment_form' ) ) {

	function understrap_bootstrap_comment_form( $args ) {
    
    // Load Customizer options
    $understrap_builder_comments_button_class = get_option( 'understrap_builder_comments_button_class', 'secondary');
    $understrap_builder_comments_label = get_option( 'understrap_builder_comments_label', 'comment');
    $understrap_builder_comments_form_title = get_option( 'understrap_builder_comments_form_title', 'Leave a Reply');
    
		$args['comment_field'] = '<div class="form-group comment-form-comment">
	    <label for="comment">' . _x( ucfirst(esc_attr($understrap_builder_comments_label)), 'noun', 'understrap-builder' ) . ( ' <span class="required">*</span>' ) . '</label>
	    <textarea class="form-control" id="comment" name="comment" aria-required="true" cols="45" rows="8"></textarea>
	    </div>';
		$args['class_submit']  = 'btn btn-'.esc_attr($understrap_builder_comments_button_class).' mt-3 mb-4'; // since WP 4.1.
    $args['label_submit']  = 'Post '.ucfirst(esc_attr($understrap_builder_comments_label));
    $args['title_reply']   =  esc_attr($understrap_builder_comments_form_title);
    
		return $args;
	}
}



/* BUILDER Bootstrap 4 media comment format */

class BUILDER_Bootstrap_Comment_Walker extends Walker_Comment {
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( $args['style'] === 'div' ) ? 'div' : 'li';
?>		
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'has-children media' : ' media' ); ?>>
			
      <div class="media w-100 mb-4" id="div-comment-<?php comment_ID(); ?>">
        
        <?php if ( $args['avatar_size'] != 0  ): ?>
        <a href="<?php echo get_comment_author_url(); ?>">
          <?php echo get_avatar( $comment, $args['avatar_size'],'mm','', array('class'=>"comment_avatar mr-4") ); ?>
        </a>
        <?php endif; ?>
        
        <div class="media-body">
          <h5 class="mt-0"><?php echo get_comment_author_link() ?> <small class="text-muted ml-2"><?php comment_date() ?>, <?php comment_time() ?></small></h5>
          <?php if ( '0' == $comment->comment_approved ) : ?>
            <p class="card-text comment-awaiting-moderation label label-info text-warning small"><?php _e( 'Your comment is awaiting moderation.', 'understrap-builder' ); ?></p>
          <?php endif; ?>				
          <div class="comment-content card-text">
            <?php comment_text(); ?>
          </div><!-- .comment-content -->
          <ul class="list-inline">
            <?php edit_comment_link( __( 'Edit', 'understrap-builder' ), '<li class="mt-2 edit-link list-inline-item btn btn-sm btn-secondary chip">', '</li>' ); ?>
            <?php
              comment_reply_link( array_merge( $args, array(
                'add_below' => 'comment',
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
                'before'    => '<li class="mt-2 reply-link list-inline-item btn btn-sm btn-secondary chip">',
                'after'     => '</li>'
              ) ) );	
            ?>
          </ul>
        </div>
        
      </div>
    </li>
    <?php
	}	
}
