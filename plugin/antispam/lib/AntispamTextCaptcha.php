<?php

/**
 * @copyright (C) 2025, Champion Consulting, LLC
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <andrew@championconsulting.com>
 * 
 * @package https://github.com/ChampionConsulting/champion-cms
 */
defined('ROOT') OR exit('Access denied!');

class AntispamTextCaptcha extends AntispamAbstractCaptcha {

    protected $operation;
    protected $result;

    public function getText() {
        if (!isset($this->operation)) {
            $this->generate();
        }
        return '<p><label for="antispam">' . $this->operation . lang::get('antispam.in-numbers') . '</label><br><input required="required" type="text" name="antispam" id="antispam" value="" /></p>' . $this->getGenericHtml();
    }

    public function isValid() {
        return (isset($_SESSION['antispam_result']) && isset($_POST['antispam']) && $_SESSION['antispam_result'] === sha1($_POST['antispam']) && $this->isGenericValid());
    }

    protected function generate() {
        $numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $letters = [];
        foreach ($numbers as $number) {
            $letters[] = lang::get('antispam.' . $number);
        }
        $first = rand(0, count($numbers) - 1);
        $second = rand(0, count($numbers) - 1);
        $sign = rand(0, 1);
        $o = lang::get('antispam.how-counts') . $letters[$first];
        if ($second <= $first && $sign == 1) {
            $r = $numbers[$first] - $numbers[$second];
            $o .= lang::get('antispam.minus-alt');
        } elseif ($second <= $first && $sign == 0) {
            $r = $numbers[$first] - $numbers[$second];
            $o .= lang::get('antispam.minus');
        } elseif ($second > $first && $sign == 1) {
            $r = $numbers[$first] + $numbers[$second];
            $o .= lang::get('antispam.plus-alt');
        } else {
            $r = $numbers[$first] + $numbers[$second];
            $o .= lang::get('antispam.plus');
        }
        $this->operation = $o . $letters[$second] . " ?";
        $this->result = $r;
        $_SESSION['antispam_result'] = sha1($this->result);
    }

}