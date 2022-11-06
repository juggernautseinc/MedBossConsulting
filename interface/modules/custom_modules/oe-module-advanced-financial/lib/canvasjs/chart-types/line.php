<?php




include '../headers.php';
include '../sidemenu.php';
include '../content.php';
require_once dirname(__FILE__, 6) . "/../globals.php";
require_once dirname(__FILE__, 3) . "/../vendor/autoload.php";

use Juggernaut\App\Controllers\MonthlyIncomeDataPoints;

$genDatapoints = new MonthlyIncomeDataPoints();
$insurersId = 106;
$dataPointsToDisplay = $genDatapoints->buildDataPoints($insurersId);


?>
<h1><?php echo xlt('Insurance Income'); ?></h1>
<div id="chartContainer"></div>

<script type="text/javascript">

    $(function () {
        const chart = new CanvasJS.Chart("chartContainer", {
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

                    dataPoints: <?php echo json_encode($dataPointsToDisplay, JSON_NUMERIC_CHECK); ?>
                }
            ]

        });
        chart.render();
    });

</script>


<?php include '../footer.php'; ?>
