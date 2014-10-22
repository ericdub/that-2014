<?php get_header(); ?>

<?php

// get user's comment display setting
$comments_display = get_theme_mod('ct_tracks_comments_setting');

/* Front page header */
if(is_front_page()){ ?>
    <div class='archive-header'>
    
    <h2>Recent Work</h2>
    </div><?php
}
/* Tag header */
elseif(is_tag()){ ?>
    <div class='archive-header'>
    <p>Tag:</p>
    <h2><?php single_tag_title(); ?></h2>
    </div><?php
}
/* Author header */
elseif(is_author()){ ?>
    <div class='archive-header'>
    <p>These Posts are by:</p>
    <h2><?php echo get_the_author(); ?></h2>
    </div><?php
}


// The loop
$args = array(
    'post_type' => 'jetpack-portfolio', 
);
$recent_work = new WP_Query( $args );

 if($recent_work->have_posts()) : 
      while($recent_work->have_posts()) : 
         $recent_work->the_post();
    

        /* Blog */
        if(is_front_page()){

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
                get_template_part('content');
            }
        }
        /* Post */
        elseif(is_singular('post')){
            get_template_part('content');

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
            get_template_part('content', 'page');

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
        elseif(is_front_page()){

            /* check if bbPress is active */
            if( function_exists( 'is_bbpress' ) ) {

                /* if is bbPress forum list */
                if( is_bbpress() ) {
                    get_template_part( 'content/bbpress' );
                }
                /* normal archive */
                else {
                    get_template_part('content');
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

} else {
    ct_tracks_post_navigation();
}

?>

<?php get_footer(); ?>

     
        
         
 