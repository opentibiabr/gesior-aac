<?php
if (!defined('INITIALIZED'))
    exit;

ob_start('ob_gzhandler');
header('Connection: close');

if (isset($_POST['a_AccountName'])) {
    function f($e)
    {
        echo '{"AjaxObjects": [{
        "DataType": "Attributes",
        "Data": "style=background-image:url(account/nok.gif)",
        "Target": "#accountname_indicator"},
        {"DataType": "HTML",
        "Data": "' . $e . '",
        "Target": "#accountname_errormessage"},
        {"DataType": "Attributes",
        "Data": "class=red",
        "Target": "#accountname_label"}]}';
    }

    $s = isset($_POST['a_AccountName']) ? $_POST['a_AccountName'] : '';

    if ($s == '')
        f('Please enter an account name!');
    elseif (strlen($s) < 3)
        f('This account name is too short!');
    elseif (strlen($s) > 30)
        f('This account name is too long!');

    $s = strtoupper($s);

    if (!ctype_alnum($s))
        f('This account name has an invalid format. Your account name may only consist of numbers 0-9 and letters A-Z!');

    $acc_name = trim(stripslashes($s));
    $check_account = $SQL->query("SELECT `id` FROM `accounts` WHERE `name` = '$acc_name' LIMIT 1")->fetch();

    if (count($check_account) > 0)
        f('This account name is already used. Please select another one!');

    echo '{"AjaxObjects": [{"DataType": "Attributes",
    "Data": "style=background-image:url(account/ok.gif);",
    "Target": "#accountname_indicator"},
    {"DataType": "HTML",
    "Data": "","Target": "#accountname_errormessage"},
    {"DataType": "Attributes",
    "Data": "class=",
    "Target": "#accountname_label"}]}';

    ob_end_flush();

}