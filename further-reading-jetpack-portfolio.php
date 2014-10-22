<?php

global $post;

// gets the next & previous posts if they exist
$previous_blog_post = get_adjacent_post(false,'',true);
$next_blog_post = get_adjacent_post(false,'',false);

if(get_the_title($previous_blog_post)) {
    $previous_title = get_the_title($previous_blog_post);
} else {
    $previous_title = "The Previous Post";
}
if(get_the_title($next_blog_post)) {
    $next_title = get_the_title($next_blog_post);
} else {
    $next_title = "The Next Post";
}

echo "<nav class='further-reading'>";

if($previous_blog_post) {
    echo "<p class='prev'>
            <span>Previous Project</span>
            <a href='".get_permalink($previous_blog_post)."'>".$previous_title."</a>
        </p>";
} else {
    echo "<p class='prev'>
            <span>This is the last project</span>
            <a href='".esc_url(home_url())."'>Return to Blog</a>
        </p>";
}
if($next_blog_post) {

    echo "<p class='next'>
            <span>Next Project</span>
            <a href='".get_permalink($next_blog_post)."'>".$next_title."</a>
        </p>";
} else {
    echo "<p class='next'>
            <span>This is the newest project</span>
            <a href='".get_post_type_archive_link( 'jetpack-portfolio' )."'>Return to Portfolio</a>
         </p>";
}
echo "</nav>";