<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App;

use GuzzleHttp\Client;
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
        $flag = $document->createTemplateFlag();
        if ($this->checkInsurance && !empty($contact[1]['field_value']) && $flag) {
             //fill out template if the contact form has an email address
            $this->letter = $document->letterTemplate();
        }

        self::storeTempPdfDocument();
    }

    protected function storeTempPdfDocument(): void
    {
        $fileStoreLocation = dirname(__FILE__, 7) . "/sites/serenity/documents/" . $this->pid;

        $fileName = $this->pid . "-" . date('Y-m-d_H:m:s') . ".html";

        file_put_contents($fileStoreLocation . DIRECTORY_SEPARATOR . $fileName, $this->leter);
    }
}
