<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 2015-11-06
 * Time: 8:27 PM
 */

function loadView($view,$data = null){
    $CI = get_instance();
    return $CI->load->view($view,$data,true);
}