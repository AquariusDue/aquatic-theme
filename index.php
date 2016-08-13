<?php
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['options'] = get_option( 'aquatic_settings' );
$templates = array( 'index.twig' );
$context['me_image'] = new TimberImage('http://aquariusdue.com/app/uploads/2016/05/me-cropped-blur.jpg');
Timber::render( $templates, $context );
