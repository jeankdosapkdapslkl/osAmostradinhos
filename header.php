<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Document</title>
    <?php wp_head(); ?>
</head>
<body>
    <header>
        <nav class="container" role="navigation">
            <a href="<?php echo home_url(); ?>" class='a-logo'>
                <?php
                echo '<img src="' . get_template_directory_uri() . '/images/logo.png" alt="Logo do site">';
                ?>
                <p>PORTAL DE TURISMO RIO DO SUL</p>
            </a>
            <?php
                wp_nav_menu();
            ?>
        </nav>
    </header>
    <?php


