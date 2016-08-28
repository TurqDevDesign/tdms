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
                    Now we need to set up an administrator login for the TDMS system. This will give you the power to dictate who can use TDMS on your website. Please fill in the form below and then click register to start setting up your website!
                </p>
            </div>

            <form action="<?php echo 'http://' . TDMS_BASE_URL . '/setup_3' ;?>" method="post" autocomplete="off" class="setup-db-form">

                <span>

                    <label for="admin_user" class="label-field-empty">Admin Username</label>

                    <input type="text" name="admin_user" id="admin_user" value="<?php echo isset($_POST['admin_user']) ? $_POST['admin_user'] : ''; ?>"
                    data-tooltip="Select an Administrator Username for TDMS. This can be anything you'd like. </br></br>
                    NOTICE: Do not give this to anyone who should not have administrator priviledges to
                    your website. You can create extra accounts for other users later, limiting their
                    usage."
                    data-pattern="^([\w\-#%&!\$]{8,30})$"
                    data-pattern-expl="Character set: a-z A-Z 0-9 _ - # % & ! $; 8-30 characters."
                    data-required="true"/>

                </span>

                <span>

                    <label for="admin_pass" class="label-field-empty">Admin Password</label>

                    <input type="text" name="admin_pass" id="admin_pass" value="<?php echo isset($_POST['admin_pass']) ? $_POST['admin_pass'] : ''; ?>"
                    data-tooltip="Select an Administrator Password for TDMS. This can be anything you'd like, but we
                    suggest making it tough to guess, as this will keep out any unwanted users. </br></br>
                    NOTICE: Do not give this to anyone who should not have administrator priviledges to
                    your website. You can create extra accounts for other users later, limiting their
                    usage."
                    data-pattern="^([\w\-#%&!\$]{8,30})$"
                    data-pattern-expl="Character set: a-z A-Z 0-9 _ - # % & ! $; 8-30 characters."
                    data-required="true"/>

                </span>

                <span>

                    <label for="admin_email" class="label-field-empty">E-mail</label>

                    <input type="text" name="admin_email" id="admin_email" value="<?php echo isset($_POST['admin_email']) ? $_POST['admin_email'] : ''; ?>"
                    data-tooltip="Please supply an E-mail address. If you ever forget your admin username or password,
                    this will allow us to send you the instructions to reset."
                    data-pattern="^([\w\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$"
                    data-pattern-expl="Should be in the form example@site.com"
                    data-required="true"/>

                </span>

                <span>

                    <label for="confirm_email" class="label-field-empty">Confirm E-mail</label>

                    <input type="text" name="confirm_email" id="confirm_email" value="<?php echo isset($_POST['confirm_email']) ? $_POST['confirm_email'] : ''; ?>"
                    data-tooltip="Please confirm the E-mail address supplied above. If you ever forget your admin username or password,
                    this will allow us to send you the instructions to reset."
                    data-pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$"
                    data-pattern-expl="Should be in the form example@site.com"
                    data-required="true"/>

                </span>

                <input class="r-float" type="submit" name="admin_account" value="Register" disabled/>

            </form>

        </div>

    </div>


    <script>
    <?php include TDMS_SERVER_ROOT . "/tdms_setup/js/tdms_setup.js"; ?>
    </script>


</body>
</html>
