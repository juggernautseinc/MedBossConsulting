<?php

/**
 * prior auth form
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once($GLOBALS['fileroot'] . "/library/forms.inc");
require_once("FormPriorAuth.class.php");

use OpenEMR\Common\Csrf\CsrfUtils;

class C_FormPriorAuth extends Controller
{

    var $template_dir;
    private $id;
    private $prior_auth_number;
    private $comments;
    private $date_from;
    private $date_to;
    private $activity;

    function __construct($template_mod = "general")
    {
        parent::__construct();
        $returnurl = 'encounter_top.php';
        $this->template_mod = $template_mod;
        $this->template_dir = dirname(__FILE__) . "/templates/prior_auth/";
        $this->assign("FORM_ACTION", $GLOBALS['web_root']);
        $this->assign("DONT_SAVE_LINK", $GLOBALS['form_exit_url']);
        $this->assign("STYLE", $GLOBALS['style']);
        $this->assign("CSRF_TOKEN_FORM", CsrfUtils::collectCsrfToken());
    }

    function default_action()
    {
        $this->getFormData();
        $this->assign("FORM_ID", $this->id);
        $this->assign("FORM_COMMENTS", $this->comments);
        $this->assign("FORM_DATE_FROM", $this->date_from);
        $this->assign("FORM_DATE_TO", $this->date_to);
        $this->assign("FORM_PRIOR_AUTH", $this->prior_auth_number);
        $this->assign("FORM_ACTIVITY", $this->activity);
        $this->assign("FORM_PID", $_SESSION['pid']);
        $this->assign("REFER_LINK", $_SERVER['HTTP_REFERER']);

        $prior_auth = new FormPriorAuth();
        $this->assign("prior_auth", $prior_auth);
        return $this->fetch($this->template_dir . $this->template_mod . "_new.html");
    }

    function getFormData()
    {
        $sql = "select id, date_from, date_to, prior_auth_number, comments, activity from form_prior_auth where pid = ? order by id desc";
        $data = sqlQuery($sql, [$_SESSION['pid']]);
        $this->id = $data['id'];
        $this->comments = $data['comments'];
        $this->date_from = $data['date_from'];
        $this->date_to = $data['date_to'];
        $this->prior_auth_number = $data['prior_auth_number'];
        $this->activity = $data['activity'];
    }

    function view_action($form_id)
    {
        if (is_numeric($form_id)) {
            $prior_auth = new FormPriorAuth($form_id);
        } else {
            $prior_auth = new FormPriorAuth();
        }

        $this->assign("VIEW", true);
        $this->assign("prior_auth", $prior_auth);
        return $this->fetch($this->template_dir . $this->template_mod . "_new.html");
    }

    function default_action_process()
    {
        if ($_POST['process'] != "true") {
            return;
        }

        $this->prior_auth = new FormPriorAuth($_POST['id']);
        parent::populate_object($this->prior_auth);


        $this->prior_auth->persist();
        if ($GLOBALS['encounter'] == "") {
            $GLOBALS['encounter'] = date("Ymd");
        }

        if (empty($_POST['id'])) {
            addForm($GLOBALS['encounter'], "Prior Authorization", $this->prior_auth->id, "prior_auth", $GLOBALS['pid'], $_SESSION['userauthorized']);
            $_POST['process'] = "";
        }
        return;
    }
}
