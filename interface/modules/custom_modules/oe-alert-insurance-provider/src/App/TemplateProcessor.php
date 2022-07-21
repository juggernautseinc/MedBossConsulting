<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\App;

class TemplateProcessor
{
    protected $auth;
    protected $template;
    protected string $title;
    protected string $pid;
    protected array $data;
    protected array $status;


    public function __construct($appointmentData)
    {
        $this->status = ['+', '?', 'x'];
        $this->data = $appointmentData;
        $this->pid = $appointmentData['form_pid'];
        $this->title = $appointmentData['form_title'];
        self::letterTemplate();
    }

    protected function letterTemplate(): void
    {
        $this->template = self::getLetterTemplate(); // retrieve template contents
        $this->auth = self::getTemplateData($this->pid); //auth number
        file_put_contents('/var/www/html/errors/aTemplate.txt', $this->template);
        $formFilled = self::mergeDataIntoTemplate();
    }

    protected function getLetterTemplate()
    {
        $this->template = dirname(__FILE__) . "/../Templates/Letter-head-template.html";
        return file_get_contents($this->template);
    }

    protected function getTemplateData()
    {
        $patientData = new Database();
        return $patientData->lookUpPatientData($this->pid);
    }

    protected function mergeDataIntoTemplate()
    {
        $s = $this->template;
        $status = self::convertStatus();
        if (in_array_r($this->data['form_apptstatus'], $this->status)) {
            $s = str_replace("{{APPSTATUS}}", $status, $s);
            $s = str_replace("{{VeteranVAAuthorizationnumber}}", $this->auth, $s);
            file_put_contents("/var/www/html/errors/filled.txt", $s);
            //return $s;
        }
    }

    protected function convertStatus()
    {

        switch ($this->data['form_apptstatus']) {
            case '+':
                return 'Rescheduled';

            case '?':
                return 'No Show';

            case 'x':
                return 'Canceled';

            default:
                return null;
        }
//        return match ($s) {
//            '+' => 'Rescheduled',
//            'x' => 'Canceled',
//            '?' => 'No Show',
//            default => null,
//        };
    }
}
