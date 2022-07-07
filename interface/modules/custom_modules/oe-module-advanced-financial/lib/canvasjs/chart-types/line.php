<?php

include '../headers.php';
include '../sidebars.php';
include '../content.php';

require_once dirname(__FILE__, 3) . "/../vendor/autoload.php";

use Juggernaut\App\MonthlyIncomeDataPoints;

$genDatapoints = new MonthlyIncomeDataPoints();
$insurersId = 106;
$dataPointsToDisplay = $genDatapoints->buildDataPoints($insurersId);

?>
<h1>Line Chart</h1>
<div id="chartContainer"></div>

<?php
    $dataPoints = array(
	array("label" => "January", "y" => '8507.88'),
	array("label" => "February", "y" => '5313.72'),
	array("label" => "March", "y" => '5305.51'),
	array("label" => "April", "y" => '3130.7'),
    array("label" => "May", "y" => '4168.9'),
	array("label" => "June", "y" => '3945.66')
    );
?>

<script type="text/javascript">

    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2",
            zoomEnabled: true,
            animationEnabled: true,
            title: {
                text: "Revenues From TriCare West"
            },
            subtitles: [
                {
                    text: "2022 - Month to date"
                }
            ],
            data: [
            {
                type: "line",

                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    });
</script>

<?php include '../footer.php'; ?>
