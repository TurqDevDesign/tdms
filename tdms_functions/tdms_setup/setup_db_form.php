<?php require 'db_validate.php' ?>


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

                <div class="setup-information" id="setupInformation">
                    <p>
                        Please fill in your database information, then click the 'Check Connection' button to verify that TDMS could connect to your database. This information will be stored in a secure location for future database connections.
                    </p>
                    </br>
                    <p>
                        Tip: the only bit of information that should be new here is your 'Database Prefix', everything else should have been set up when you installed your database.
                    </p>
                    </br>
                    <p>
                        NOTICE: At this time, TDMS only supports MySQL database connections.
                    </p>
                    </br>
                </div>

                <form action="<?php echo 'http://' . TDMS_BASE_URL . '/setup_2' ;?>" method="post" autocomplete="off" class="setup-db-form">

                    <span>

                        <label for="db_username" class="label-field-empty">Database Username</label>

                        <input type="text" name="db_username" id="db_username" value="<?php echo isset($_POST['db_username']) ? $_POST['db_username'] : ''; ?>"
                               data-tooltip="Input the Username for your MySQL database user. This should already be set up.
                                             This is the account username which will be used to access your database on
                                             behalf of TDMS."
                               data-pattern="^(.{1,32})$"
                               data-pattern-expl="Character set: all, 1-32 characters."
                               data-required="true"/>

                    </span>

                    <span>

                        <label for="db_password" class="label-field-empty">Database Password</label>

                        <input type="text" name="db_password" id="db_password" value="<?php echo isset($_POST['db_password']) ? $_POST['db_password'] : ''; ?>"
                               data-tooltip="Input the Password for your MySQL database user. This should already be set up.
                                             This is the account password which will be used to access your database on
                                             behalf of TDMS."
                               data-pattern="^(.{1,32})$"
                               data-pattern-expl="Character set: all; 1-32 characters."
                               data-required="true"/>

                    </span>

                    <span>

                        <label for="db_host" class="label-field-empty">Database Host</label>

                        <input type="text" name="db_host" id="db_host" value="<?php echo isset($_POST['db_host']) ? $_POST['db_host'] : ''; ?>"
                               data-tooltip="Input the Host of your MySQL database. This should already be set up.
                                             This is where TDMS should look for your database. If your database is
                                             not hosted remotely, then in most cases you may simply input localhost."
                               data-pattern="^(.{1,32})$"
                               data-pattern-expl="Character set: all; 1-32 characters."
                               data-required="true"/>

                    </span>

                    <span>

                        <label for="db_port" class="label-field-empty">Database Host Port</label>

                        <input type="text" name="db_port" id="db_port" value="<?php echo isset($_POST['db_port']) ? $_POST['db_port'] : ''; ?>"
                               data-tooltip="If your database connection requires a connection through a specific port, then
                                             input the port number here. If you're not sure if you need to supply a port, then
                                             you may leave this field blank, fill out the rest of the form, then check the
                                             connection. If the connection fails, and you've verified that the other information
                                             is correct, then you may need to dig around or seek help in finding which port
                                             number you must use to connect."
                               data-pattern="^([0-9]{1,5})$"
                               data-pattern-expl="Character set: 0-9; 1-5 digits."
                               data-required="false"/>

                    </span>

                    <span>

                        <label for="db_prefix" class="label-field-empty">Database Prefix</label>

                        <input type="text" name="db_prefix" id="db_prefix" value="<?php echo isset($_POST['db_prefix']) ? $_POST['db_prefix'] : ''; ?>"
                               data-tooltip="Input the Prefix you'd like TDMS to use when creating database tables.
                                             This helps us separate multiple installations located in the same directory."
                               data-pattern="^([A-Za-z0-9]{2,15})$"
                               data-pattern-expl="Character set: a-z A-Z 0-9; 2-32 characters."
                               data-required="true"/>

                    </span>

                    <input class="r-float" type="submit" name="<?php echo $db_form_name; ?>" value="<?php echo $db_form_value; ?>"/>

                </form>

            </div>

        </div>


        <script>
            <?php include TDMS_SERVER_ROOT . "/tdms_setup/js/tdms_setup.js"; ?>
        </script>


    </body>
</html>
