<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php wp_head(); ?>
        <link rel="shortcut icon" type="image/png" href="<?php echo get_stylesheet_directory_uri() ?>/assets/images/tgds-favicon.png">
    </head>
    <body>

        <?php bb_inject_inertia(); ?>

        <?php wp_footer(); ?>
    </body>
</html>