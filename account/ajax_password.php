<?PHP

date_default_timezone_set('America/Sao_Paulo');
ob_start('ob_gzhandler');
header('Connection: close');
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
    exit();

header('X-Ajax-Cip-Response-Type: Container');

function f($e)
{
    die('{"AjaxObjects": [{"DataType": "Attributes","Data": "style=background-image:url(account/nok.gif)","Target": "#password1_indicator"},{"DataType": "Attributes","Data": "style=background-image:url(account/nok.gif)","Target": "#password2_indicator"},{"DataType": "HTML","Data": "' . $e . '","Target": "#password_errormessage"},{"DataType": "Attributes","Data": "class=red","Target": "#password1_label"},{"DataType": "Attributes","Data": "class=red","Target": "#password2_label"}]}');
}

$s1 = isset($_POST['a_Password1']) ? $_POST['a_Password1'] : '';
$s2 = isset($_POST['a_Password2']) ? $_POST['a_Password2'] : '';

if (empty($s2))
    f('Please enter the password again!');
elseif ($s1 != $s2)
    f('The two passwords do not match!');

$err = array();
if (strlen($s1) < 8 || strlen($s1) > 29)
    $err[] = 'The password must have at least 8 and less than 30 letters!';
if (!ctype_alnum($s1))
    $err[] = 'The password contains invalid letters!';
if (!preg_match('/[a-zA-Z]/', $s1))
    $err[] = 'The password must contain at least one letter A-Z or a-z!';
elseif (!preg_match('/[0-9]/', $s1))
    $err[] = 'The password must contain at least one number!';

if (count($err) != 0) {
    $s = '';
    for ($i = 0; $i < count($err); $i++)
        $s .= ($i == 0 ? '' : '<br/>') . $err[$i];
    f($s);
}

echo '{"AjaxObjects": [{"DataType": "Attributes","Data": "style=background-image:url(account/ok.gif);","Target": "#password1_indicator"},{"DataType": "Attributes","Data": "style=background-image:url(account/ok.gif);","Target": "#password2_indicator"},{"DataType": "HTML","Data": "","Target": "#password_errormessage"},{"DataType": "Attributes","Data": "class=","Target": "#password1_label"},{"DataType": "Attributes","Data": "class=","Target": "#password2_label"}]}';
ob_end_flush();
?>