<?php

use DingNotice\DingTalk;

if (!function_exists('ding')){

    /**
     * @return bool|DingTalk
     */
    function ding(){

        $arguments = func_get_args();

        $dingTalk = DingTalk::getInstance();

        if (empty($arguments)) {
            return $dingTalk;
        }

        if (is_string($arguments[0])) {
            return $dingTalk->text($arguments[0]);
        }

    }
}