<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

use OpenEMR\Core\Header;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Text</title>
    <?php Header::setupHeader(['common']); ?>
</head>
<body>
<div class="container m-5 main_container">
    <h1>Send Text</h1>
    <form action='../../public/index.php/texting/individualPatient' method="post">
        <input type="hidden" name="phone" value="<?php echo filter_input('GET', 'phone', FILTER_VALIDATE_INT); ?>">
        <textarea class="form-control col-3" name="messageoutbound"></textarea>
        <input class="form-control col-1" type="submit" value="Send">
    </form>
</div>


</body>
</html>
