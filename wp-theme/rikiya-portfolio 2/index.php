<?php
/**
 * Main template file for Rikiya Portfolio Theme
 * This will be the main homepage template
 */

get_header(); ?>

<!-- Main Content -->
<main>
    <?php
    // Include template parts
    get_template_part('template-parts/hero');
    get_template_part('template-parts/about');
    get_template_part('template-parts/skills');
    get_template_part('template-parts/projects');
    get_template_part('template-parts/contact');
    ?>
</main>

<?php get_footer(); ?>