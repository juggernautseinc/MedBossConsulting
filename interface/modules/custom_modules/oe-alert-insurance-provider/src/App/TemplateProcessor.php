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
    protected string $template;
    protected string $title;
    protected string $pid;

    public function __construct($pid, $title)
    {
        $this->pid = $pid;
        $this->title = $title;
        self::letterTemplate($this->pid);
    }

    protected function letterTemplate($pid): void
    {
        $this->template = self::getLetterTemplate();
        file_put_contents('/var/www/html/errors/aTemplate.txt', $this->template); die;
        $this->data = self::getTemplateData($pid);
        $formFilled = self::mergeDataIntoTemplate($this->template, $this->data);
    }

    protected function getLetterTemplate()
    {
        $template = dirname(__FILE__) . "/../Templates/Letter-head-NO-SHOW-template.html";
        return fopen($template, 'r');
    }

    protected function getTemplateData($pid)
    {
        $patientData = new Database();
        return $patientData->lookUpPatientData($pid);
    }

    protected function mergeDataIntoTemplate($template, $data)
    {
        $s = $template;
        $s = str_replace("{{APPSTATUS}}", $data['appstatus'], $s);
        $s = str_replace("{{VeteranVAAuthorizationnumber}}", $data['vetsname'], $s);
        return $s;

    }
}
