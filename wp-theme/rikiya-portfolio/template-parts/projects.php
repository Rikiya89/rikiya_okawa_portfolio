<?php
/**
 * Projects Section Template Part
 */

$projects = get_projects();
?>

<!-- Projects Section -->
<section class="projects">
    <div class="anchor-projects" id="projects"></div>
    <div class="project-inner">
        <h2 class="project-title fz24">
            <?php echo get_theme_mod('projects_title', 'Some of my Recent Projects'); ?>
        </h2>
        
        <ul class="card-list">
            <?php
            if ($projects->have_posts()) {
                while ($projects->have_posts()) {
                    $projects->the_post();
                    
                    $project_url = get_post_meta(get_the_ID(), '_project_url', true);
                    $project_tech = get_post_meta(get_the_ID(), '_project_tech', true);
                    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    ?>
                    
                    <li class="card-item">
                        <a href="<?php echo esc_url($project_url ?: '#'); ?>" class="card-block project-card-fadein" <?php echo $project_url ? 'target="_blank"' : ''; ?>>
                            <?php if ($featured_image) : ?>
                                <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title(); ?>" loading="lazy" class="project-pic" />
                            <?php endif; ?>
                            
                            <h3 class="project-title">
                                <?php the_title(); ?>
                            </h3>
                            
                            <p class="project-details">
                                <?php echo wp_trim_words(get_the_content(), 30); ?>
                            </p>
                            
                            <?php if ($project_tech) : ?>
                                <p class="project-tech">
                                    <strong>Technologies:</strong> <?php echo esc_html($project_tech); ?>
                                </p>
                            <?php endif; ?>
                            
                            <p class="project-text">
                                <?php echo $project_url ? 'Check it Out' : 'Learn More'; ?>
                            </p>
                        </a>
                    </li>
                    
                    <?php
                }
                wp_reset_postdata();
            } else {
                // Fallback for when no projects exist yet
                ?>
                <li class="card-item">
                    <div class="card-block">
                        <h3 class="project-title">Coming Soon</h3>
                        <p class="project-details">Projects will appear here when you add them in WordPress admin.</p>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</section>