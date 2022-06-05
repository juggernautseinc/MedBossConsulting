<?php

/**
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
    <title><?php echo xlt('Notifications'); ?></title>
    <?php Header::setupHeader(['common']) ?>
</head>
<body>
    <div class="container-fluid main-container m-5 w-auto">
        <div class="row">
            <h1><?php echo xlt('Notifications'); ?></h1>
            <table class="table table-striped">
                <tr>
                    <th scope="col"><?php echo xlt('Date'); ?></th>
                    <th scope="col"><?php echo xlt('From'); ?></th>
                    <th scope="col"><?php echo xlt('To'); ?></th>
                    <th scope="col"><?php echo xlt('Result'); ?></th>
                    <th scope="col"><?php echo xlt('Message'); ?></th>
                    <th scope="col"><?php echo xlt('View'); ?></th>
                </tr>
                <?php
                    foreach ($this->params as $item) {
                        print "<tr>";
                        print "<td>";
                        print $item['date'];
                        print "</td>";
                        print "<td>";
                        print $item['fromnumber'];
                        print "</td>";
                        print "<td>";
                        print $item['to'];
                        print "</td>";
                        print "<td>";
                        print "results?";
                        print "</td>";
                        print "<td>";
                        print $item['text'];
                        print "</td>";
                        print "<td>";
                        print "view";
                        print "</td>";
                        print "</tr>";
                    }

                ?>

            </table>
        </div>
    </div>
</body>
</html>

