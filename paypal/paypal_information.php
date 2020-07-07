<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 24/03/2018
 * Time: 20:38
 */
require_once "../paypal_config.php";

use PayPal\Api\Payment;
use PayPal\Api\Sale;

if(isset($_REQUEST['sale_id'])){
    $saleId = $_REQUEST['sale_id'];
    try{
        $sale = Sale::get($saleId, $apiContext);
        var_dump($sale);
    }catch (Exception $ex){
        exit(1);
    }
    return $sale;
}
