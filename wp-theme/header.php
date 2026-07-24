<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Welcome, my World!" />
	<meta name="keywords" content="大川力也,大川 力也,おおかわ りきや,オオカワ リキヤ,おおかわりきや,オオカワリキヤ,Rikiya Okawa, Ricky Okawa, Ricky O'kawa" />

	<!-- Favicons -->
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/img/icons/favicon.png" />

	<!-- Animate CSS CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	<title>Rikiya Okawa | UI/UX Designer | Web Developer|</title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="l-container">

		<!-- loading animation -->
		<div class="intersecting-circles-spinner">
			<div class="spinnerBlock">
				<span class="circle"></span>
				<span class="circle"></span>
				<span class="circle"></span>
				<span class="circle"></span>
				<span class="circle"></span>
				<span class="circle"></span>
				<span class="circle"></span>
			</div>
		</div>
		<!-- Navbar -->
		<nav class="nav">
			<h1 class="name">Rikiya Okawa</h1>
			<ul class="navigation-list">
				<li class="list-item">
					<a href="#about" class="nav-link">
						About
					</a>
				</li>
				<li class="list-item">
					<a href="#skills" class="nav-link">
						Skills
					</a>
				</li>
				<li class="list-item">
					<a href="#projects" class="nav-link">
						Projects
					</a>
				</li>
				<li class="list-item">
					<a href="#digital_arts" class="nav-link">
						Digital Arts
					</a>
				</li>
				<li class="list-item">
					<a href="#contact" class="nav-link">
						Contact
					</a>
				</li>
				<li class="list-item">
					<?php if ( is_page_template( 'page-english.php' ) || is_page( 'english' ) ) : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">
							Japanese
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/english' ) ); ?>" class="nav-link">
							English
						</a>
					<?php endif; ?>
				</li>
			</ul>
			<button class="burger-menu" id="burger-menu">
				<ion-icon class="bars" name="menu-outline"></ion-icon>
			</button>
		</nav>
