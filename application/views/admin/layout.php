<!doctype html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Purple CV Maker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="pragma" content="no-cache" />
    <link rel="icon" type="image/x-icon" href="<?php echo RESOURCEPATH; ?>images/favicon.ico" />
    <link rel="icon" type="image/png" href="<?php echo RESOURCEPATH; ?>images/favicon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo RESOURCEPATH; ?>css/style.css" />
    <link rel="stylesheet" href="<?php echo RESOURCEPATH; ?>css/style-new.css" />
    <script src="<?php echo RESOURCEPATH; ?>js/script.js"></script>
    <script type="text/javascript">
        $(".accordian").first().addClass("current");
    </script>
    <script src="https://cdn.tiny.cloud/1/5agvwofxv6zf3gj3obr3uxntoeby9zhdzmmno3o4ps25luqd/tinymce/5/tinymce.min.js" ></script>

     <style>
         .tox-tinymce-aux{z-index:99999999999 !important;}
     </style>
</head>

<body>

    <div>
        <div class="container fade fade-entered">

            <?php include_once('header.php'); ?>

            <div class="main center">
                <?php

                echo $content_for_layout;
                ?>

            </div>
            <!-- /Logo -->
            <!-- Login Box -->
        </div>

        <div class="heading__bg"></div>
        <div class="modals"></div>
    </div>

</body>

</html>