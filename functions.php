<?php 


function ct_tracks_excerpt_read_more_link2($output) {
		remove_filter('the_excerpt', 'ct_tracks_excerpt_read_more_link');
			global $post;

			if ( is_archive( 'jetpack-portfolio' ) ) {
    

			return $output . "<p><a class='more-link' href='". get_permalink() ."'>View project <span class='screen-reader-text'>" . get_the_title() . "</span></a></p>";

			} else {
			return $output . "<p><a class='more-link' href='". get_permalink() ."'>Read post <span class='screen-reader-text'>" . get_the_title() . "</span></a></p>";
			} 
			
		
		
		}

add_filter('the_excerpt', 'ct_tracks_excerpt_read_more_link2');
remove_filter('the_excerpt', 'ct_tracks_excerpt_read_more_link');

    // filter the link on excerpts
   
	
	
	


?>