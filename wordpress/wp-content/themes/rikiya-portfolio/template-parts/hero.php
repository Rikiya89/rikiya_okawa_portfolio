<?php
/**
 * Hero Section Template Part - Exact copy from original static site
 */
?>

<!-- Hero Section -->
<section class="hero">
    <div class="anchor-about" id="about"></div>
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/man-guy-person-desk-table-furniture-laptop-computer-sheld-speakers.svg" alt="rikiya_icon" loading="lazy" class="hero-img" />
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