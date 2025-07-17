<?php
/**
 * Hero Section Template Part
 */
?>

<!-- Hero Section -->
<section class="hero" id="about">
    <div class="intro">
        <h1 class="title">
            <span class="title-text">
                Hi, I am
            </span>
            <span class="title-name">
                <?php echo get_theme_mod('hero_name', 'Rikiya Okawa'); ?>
            </span>
        </h1>
        
        <p class="subtitle">
            <?php echo get_theme_mod('hero_subtitle', 'I am a Web Engineer'); ?>
        </p>
        
        <div class="cta-buttons">
            <a href="#projects" class="cta-button cta-primary">
                <?php echo get_theme_mod('cta_primary_text', 'View My Work'); ?>
            </a>
            <a href="#contact" class="cta-button cta-secondary">
                <?php echo get_theme_mod('cta_secondary_text', 'Contact Me'); ?>
            </a>
        </div>
    </div>
    
    <div class="hero-image">
        <?php 
        $hero_image = get_theme_mod('hero_image');
        if ($hero_image) {
            echo '<img src="' . esc_url($hero_image) . '" alt="Rikiya Okawa" class="profile-image" />';
        }
        ?>
    </div>
</section>

<!-- Bio Section -->
<section class="about">
    <div class="bio animate__animated animate__shakeX">
        <div class="bio_inner">
            <h2 class="bio-title fz24">
                <?php echo get_theme_mod('about_title', 'About Me'); ?>
            </h2>
            <p class="bio-text">
                <?php echo get_theme_mod('about_bio', '大川 力也です。<br>帰国後、コストコホールセールで約1年間勤務した後、アコーホテルズで3年間勤務しました。その後、2022年9月までデジタルハリウッド東京本校にてUI/UXデザインを学びました。'); ?>
            </p>
        </div>
    </div>
</section>