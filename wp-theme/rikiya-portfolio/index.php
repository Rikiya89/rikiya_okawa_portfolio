<?php
/**
 * Main template file for Rikiya Portfolio Theme
 * This will be the main homepage template
 */

get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta keyword="大川力也,大川 力也,おおかわ りきや,オオカワ リキヤ,おおかわりきや,オオカワリキヤ,Rikiya Okawa, Ricky Okawa, Ricky O'kawa" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/favicon.png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,900;1,900&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/common.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/styles.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
    <!-- Navigation -->
    <nav class="nav">
        <div class="inner">
            <div class="nav-left">
                <a href="<?php echo home_url(); ?>" class="logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/man-guy-person-desk-table-furniture-laptop-computer-sheld-speakers.svg" alt="Rikiya Okawa" loading="lazy" class="icon" />
                </a>
            </div>
            <div class="nav-right">
                <div class="nav-menu">
                    <a href="#about" class="nav-link">About</a>
                    <a href="#skills" class="nav-link">Skills</a>
                    <a href="#projects" class="nav-link">Projects</a>
                    <a href="#contact" class="nav-link">Contact</a>
                </div>
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

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

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Rikiya Okawa. All rights reserved.</p>
    </footer>

    <!-- JavaScript -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/libraries/jquery.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/libraries/scrollmagic.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/libraries/jquery.easing.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/common.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/app.js"></script>
    
    <?php wp_footer(); ?>
</body>
</html>