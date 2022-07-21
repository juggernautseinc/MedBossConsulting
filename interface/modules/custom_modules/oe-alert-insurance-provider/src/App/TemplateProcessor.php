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


    public function __construct($appointmentData)
    {
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

    protected function getTemplateData($pid)
    {
        $patientData = new Database();
        return $patientData->lookUpPatientData($pid);
    }

    protected function mergeDataIntoTemplate()
    {
        $s = $this->template;
        $s = str_replace("{{APPSTATUS}}", $this->data['appstatus'], $s);
        $s = str_replace("{{VeteranVAAuthorizationnumber}}", $this->auth, $s);
        file_put_contents("/var/www/html/errors/filled.txt", $s);
        //return $s;

    }
}
