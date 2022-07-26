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
use Mpdf\Mpdf;

class InsuranceNotifications
{
    protected array $statuses;
    protected $letter;
    protected $pid;
    protected $pdf;
    protected bool $checkInsurance;
    protected $output;
    protected $pdfName;
    /**
     * @param array $appointmentData
     */
    public function __construct(array $appointmentData)
    {
        $this->pid = $appointmentData['form_pid'];
        $this->checkInsurance = Database::isPatientTriWest($this->pid);
        $contact = Database::vaContactName($this->pid);
        $document = new TemplateProcessor($appointmentData);
        file_put_contents("/var/www/html/errors/contactInfo.txt", print_r($contact, true));
        if ($this->checkInsurance) {
             //fill out template
            $this->letter = $document->letterTemplate();
            file_put_contents("/var/www/html/errors/" . $this->pid . "-" . date('Y-m-d_H:m:s') . ".html", $this->letter);
        }
        $this->pdfName = date('Y-m-d_H:m:s') . ".pdf";
        $config_mpdf = array(
            'tempDir' => $GLOBALS['MPDF_WRITE_DIR'],
            'mode' => $GLOBALS['pdf_language'],
            'format' => $GLOBALS['pdf_size'],
            'default_font_size' => '9',
            'default_font' => 'dejavusans',
            'margin_left' => $GLOBALS['pdf_left_margin'],
            'margin_right' => $GLOBALS['pdf_right_margin'],
            'margin_top' => $GLOBALS['pdf_top_margin'],
            'margin_bottom' => $GLOBALS['pdf_bottom_margin'],
            'margin_header' => '',
            'margin_footer' => '',
            'orientation' => $GLOBALS['pdf_layout'],
            'shrink_tables_to_fit' => 1,
            'use_kwt' => true,
            'autoScriptToLang' => true,
            'keep_table_proportions' => true
        );
        $mpdf = new Mpdf($config_mpdf);
        //$mpdf->WriteHTML(__toString($this->letter));
        //$this->output = $mpdf->Output($this->pdfName);
        //file_put_contents("/var/www/html/errors/" . $this->pid . "-" . date('Y-m-d_H:m:s') . ".pdf", $this->output);

        //self::storeTempPdfDocument();
    }

    protected function storeTempPdfDocument(): void
    {
        $postlocation = dirname(__DIR__, 6) . "/controller.php?document&upload&patient_id=" . $this->pid . "&parent_id=685461&";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $postlocation, [
            'multipart' => [
                'name' => $this->pdfName,
                'contents' => $this->output
            ]
    ]);

         "//controller.php?document&upload&patient_id=2635&parent_id=685461&";

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

        return $makePdf->getPdf($this->letter, $options);
    }


}
