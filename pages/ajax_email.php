<?php
if(!defined('INITIALIZED'))exit;

function f($e) {
	echo('{"AjaxObjects": [{"DataType": "Attributes","Data": "style=background-image:url(account/nok.gif)","Target": "#email_indicator"},{"DataType": "HTML","Data": "'.$e.'","Target": "#email_errormessage"},{"DataType": "Attributes","Data": "class=red","Target": "#email_label"}]}');
}

$s = isset($_POST['a_EMail']) ? $_POST['a_EMail'] : '';

if($s == '')
	f('Please enter your email address!');
elseif(strlen($s) > 49)
	f('Your email address is too long!');
elseif(!filter_var($s, FILTER_VALIDATE_EMAIL))
	f('This email address has an invalid format. Please enter a correct email address!');
else {
    $account = new Account();
    $account->loadByEmail($s);


    if ($account->isLoaded())
        f('This email address is already used. Please enter another email address!');
    else
        echo '{"AjaxObjects": [{"DataType": "Attributes","Data": "style=background-image:url(account/ok.gif);","Target": "#email_indicator"},{"DataType": "HTML","Data": "","Target": "#email_errormessage"},{"DataType": "Attributes","Data": "class=","Target": "#email_label"}]}';
}
exit;
?>