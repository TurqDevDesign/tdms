<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <style>
            <?php include TDMS_SERVER_ROOT . "/tdms_setup/css/tdms_main_css.css"; ?>
        </style>
        </head>
    <body class="setup-body">

        <div class="tdms-fullpage-contain" id="tdms-fullpage-contain">

            <div class="setupPage-logo">

                <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents(TDMS_SERVER_ROOT . '/tdms_setup/images/tdms_logo.png')); ?>" alt="Turq Development Module Sidebar Logo">

            </div>

            <div class="setup-form">

                <p>Thank you for choosing TDMS to manage your website! Our goal is to make an easy-to-use, easy-to-implement CMS that always caters to the needs of you, the developer! We would like to get you up and running as soon as possible, but first we'll need a few things to make sure everything works as smoothly as possible.</p>

                <ul class="needs-list">

                    <li>What we'll need to set up your database:</li>
                    <li>Database Username</li>
                    <li>Database Password</li>
                    <li>Database Host</li>
                    <li>Database Prefix</li>

                </ul>

                <ul class="needs-list">

                    <li>Then, we'll need some information to register an administrator:</li>
                    <li>Admin Username</li>
                    <li>Admin Password</li>
                    <li>Recovery E-mail</li>

                </ul>

                <p>If this is all ok, then please click continue to get started. Otherwise you may click off of this page and nothing will be changed.</p>

                <form method="post" action="<?php echo 'http://' . TDMS_BASE_URL . '/setup_2' ;?>">

                    <input class="r-float" type="submit" name="submit" value="Continue"/>

                </form>

            </div>

        </div>


        <script>
            <?php include TDMS_SERVER_ROOT . "/tdms_setup/js/tdms_setup.js"; ?>
        </script>


    </body>
</html>
