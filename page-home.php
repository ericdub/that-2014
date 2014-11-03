<?php get_header(); ?>

<?php

// get user's comment display setting
$comments_display = get_theme_mod('ct_tracks_comments_setting');

echo '<div class="home-archive">';
echo '<h1 class=\'entry-title\'>I\'m Eric. I build great Web sites. </h1>';
// The loop


$args = array(
    'post_type' => 'jetpack-portfolio'
);
$wp_query = new WP_Query( $args );

 if($wp_query->have_posts()) : 
      while($wp_query->have_posts()) : 
         $wp_query->the_post();
    
        /* Blog */
        if(is_home()){

            /* Two-column Images Layout */
            if(get_theme_mod('premium_layouts_setting') == 'two-column-images'){
                get_template_part('licenses/content/content-two-column-images');
            }
            /* Full-width Images Layout */
            elseif(get_theme_mod('premium_layouts_setting') == 'full-width-images'){
                get_template_part('licenses/content/content-full-width-images');
            }
            /* Blog - No Premium Layout */
            else {
                get_template_part('content-jetpack-portfolio');
            }
        }
        /* Post */
        elseif(is_singular('jetpack-portfolio')){
            get_template_part('content-jetpack-portfolio');

            // error prevention
            if( is_array( $comments_display ) ) {

                // check for posts as a selected option
                if (in_array( 'posts', $comments_display ) ) {
                    comments_template();
                }
            }
        }
        /* Page */
        elseif(is_page()){
            get_template_part('content-jetpack-portfolio');

            // error prevention
            if( is_array( $comments_display ) ) {

                // check for pages as a selected option
                if (in_array( 'pages', $comments_display ) ) {
                    comments_template();
                }
            }
        }
        /* Attachment */
        elseif(is_attachment()){
            get_template_part( 'content', 'attachment' );

            // error prevention
            if( is_array( $comments_display ) ) {

                // check for attachments as a selected option
                if (in_array( 'attachments', $comments_display ) ) {
                    comments_template();
                }
            }
        }
        /* Archive */
        elseif(is_archive()){

            /* check if bbPress is active */
            if( function_exists( 'is_bbpress' ) ) {

                /* if is bbPress forum list */
                if( is_bbpress() ) {
                    get_template_part( 'content/bbpress' );
                }
                /* normal archive */
                else {
                    get_template_part('content-jetpack-portfolio');
                }
            }
            elseif(get_theme_mod('premium_layouts_setting') == 'two-column-images'){
                get_template_part('licenses/content/content-two-column-images');
            }
            elseif(get_theme_mod('premium_layouts_setting') == 'full-width-images'){
                get_template_part('licenses/content/content-full-width-images');
            }
            else {
                get_template_part('content-jetpack-portfolio');
            }
        }
        /* bbPress */
        elseif( function_exists( 'is_bbpress' ) && is_bbpress() ) {
            get_template_part( 'content/bbpress' );
        }
        /* Custom Post Types */
        else {

            get_template_part('content-jetpack-portfolio');
        }
    endwhile;
endif; ?>

<?php

// include loop pagination except for on bbPress Forum root
if( function_exists( 'is_bbpress' ) ) {

    if( ! ( is_bbpress() && is_archive() ) ) {
        ct_tracks_post_navigation();
    }

}

echo '</div>';

?>

<?php get_footer(); ?>