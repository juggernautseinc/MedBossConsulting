<?php

require_once dirname(__FILE__, 3) . "/vendor/autoload.php";

require_once dirname(__FILE__) . '/header.php';
require_once dirname(__FILE__) . '/sidebar.php';
require_once dirname(__FILE__) . '/content.php';

use Juggernaut\App\MonthlyIncomeDataPoints;

$genDatapoints = new MonthlyIncomeDataPoints();
$insurersId = 106;
$dataPointsToDisplay = $genDatapoints->buildDataPoints($insurersId);
?>

<h1>Home</h1>
<div id="chartContainer"></div>

<?php
    $dataPoints = array(
        array("y" => 6, "label" => "Apple"),
        array("y" => 4, "label" => "Mango"),
        array("y" => 5, "label" => "Orange"),
        array("y" => 7, "label" => "Banana"),
        array("y" => 4, "label" => "Pineapple"),
        array("y" => 6, "label" => "Pears"),
        array("y" => 7, "label" => "Grapes"),
        array("y" => 5, "label" => "Lychee"),
        array("y" => 4, "label" => "Jackfruit")
    );
?>

<script type="text/javascript">

    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "Simple Column Chart in PHP"
            },
            data: [
            {
                type: "column",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    });
</script>

<?php include dirname(__FILE__) . '/footer.php'; ?>
