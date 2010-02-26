<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php echo Kohana::$charset ?>" />
    <title><?php echo $title ?></title>
    <?php foreach ($styles as $style => $media)
        echo HTML::style($style, array('media' => $media)), "\n" ?>

    <?php foreach ($scripts as $script)
        echo HTML::script($script), "\n" ?>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>
      article, aside, dialog, figure, footer, header,
      hgroup, menu, nav, section { display: block; }
    </style>
</head>
<body>
    <?php echo $content ?>
</body>
</html>
