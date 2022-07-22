<?php

/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App;

use OpenEMR\Pdf\PdfCreator;

class InsuranceNotifications
{

    protected array $statuses;
    protected $letter;
    protected $pid;
    protected $pdf;
    /**
     * @param array $appointmentData
     */
    public function __construct(array $appointmentData)
    {
        $this->pid = $appointmentData['form_pid'];
        $checkInsurance = Database::isPatientTriWest($this->pid);
        if ($checkInsurance) {
            $document = new TemplateProcessor($appointmentData); //fill out template
            $this->letter = $document->letterTemplate();
        }

        file_put_contents("/var/www/html/errors/returnedToPdfit.txt", $this->letter);
        //$this->pdf = self::convertHtmlToPdf();
        //self::storeTempPdfDocument();
    }

    protected function storeTempPdfDocument(): void
    {
        $file_name = date('Y-m-d') . "TriWest.pdf";
        $templocation = "/sites" . $GLOBALS['site_id'] . "/documents/temp/";
        file_put_contents($templocation . $file_name, $this->pdf);
        $postlocation = "/controller.php?document&amp;upload&amp;patient_id=2123&amp;parent_id=645046&amp";

    }

    protected function convertHtmlToPdf()
    {
        $top = $_POST["left_ubmargin"] ?? $GLOBALS['left_ubmargin_default'];
        $side = $_POST["top_ubmargin"] ?? $GLOBALS['top_ubmargin_default'];

        // convert points to inches-some tricky calculus here! 72 pts/inch
        $top = round($top / 72.00, 2) . "in";
        $side = round($side / 72.00, 2) . "in";

        $makePdf = new PdfCreator();
        $options = array(
            'margin-top' => $top,
            'margin-bottom' => '0in',
            'margin-left' => $side,
            'margin-right' => $side,
            'zoom' => '1.045',
            'print-media-type' => true,
            'lowquality' => true,
            'no-outline' => true,
            'keep-relative-links' => true,
            'no-images' => false,
            'grayscale' => false,
            'page-size' => 'Letter',
            'orientation' => 'Portrait'
        );

        return $makePdf->getPdf($this->document, $options);
    }


}
