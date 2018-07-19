<?php
if (!defined('INITIALIZED'))
    exit;

if (isset($_POST['a_CharacterName'])) {
    function f($e)
    {
        echo '{"AjaxObjects": 
	          [
                  {"DataType": "Attributes",
                    "Data": "style=background-image:url(account/nok.gif)",
                    "Target": "#charactername_indicator"},
                  {"DataType": "HTML",
                    "Data": "' . $e . '",
                    "Target": "#charactername_errormessage"},
                  {"DataType": "Attributes",
                    "Data": "class=red",
                    "Target": "#charactername_label"}
              ]}';
    }
    function s(){
        echo '{"AjaxObjects":
             [
                 {"DataType": "Attributes",
                 "Data": "style=background-image:url(account/ok.gif);",
                 "Target": "#charactername_indicator"},
                 {"DataType": "HTML",
                 "Data": "","Target": "#charactername_errormessage"},
                 {"DataType": "Attributes",
                 "Data": "class=",
                 "Target": "#charactername_label"}
             ]}';
    }

    $s = isset($_POST['a_CharacterName']) ? $_POST['a_CharacterName'] : '';


    if (empty($s)){
        f('Please enter a name for your character!');
        die();
    }
    elseif (strlen($s) < 2 || strlen($s) > 20){
        f('A name must have at least 2 but no more than 20 letters!');
        die();
    }
    elseif (strlen($s) < 2 || strlen($s) < 5){
        f('Your name is mutch short!');
        die();
    }
    elseif (preg_match('/[^a-zA-Z ]/', $s)){
        f('This name contains invalid letters. Please use only A-Z, a-z and space!');
        die();
    }
    elseif ($s[0] == ' '){
        f('This name contains a space at the beginning. Please remove this space!');
        die();
    }
    elseif (substr($s, -1) == ' '){
        f('This name contains a space at the end. Please remove this space!');
        die();
    }
    /*elseif (!ctype_upper($s[0])){
        f('The first letter of a name has to be a capital letter!');
        die();
    }*/
    elseif (strpos($s, '  ') !== false){
        f('This name contains more than one space between words. Please use only one space between words!');
        die();
    }

    foreach (explode(' ', $s) as $k => $v) {
        $words[$k] = str_split($v);
        $len = strlen($v);
        if ($len == 1)
            f('This name contains a word with only one letter. Please use more than one letter for each word!');
        elseif ($len > 14)
            f('This name contains a word that is too long. Please use no more than 14 letters for each word!');
        $total = 0;
        foreach ($words as $k => $p) {
            $total++;
            if ($total > 3)
                f('This name contains more than 3 words. Please choose another name!');
            $len = 0;
            foreach ($p as $i => $j) {
                $len++;
                if ($i != 0 && ctype_upper($j))
                    f('In names capital letters are only allowed at the beginning of a word!');
                elseif ($i == $len - 1) {
                    $ff = null;
                    for ($h = 0; $h < strlen($v); $h++) {
                        if (in_array(strtolower($v[$h]), array('a', 'e', 'i', 'o', 'u')) !== false) {
                            $ff = true;
                            break;
                        }
                    }
                    if (!$ff)
                        f('This name contains a word without vowels. Please choose another name!');
                }
            }
        }
    }
    $s = strtolower($s);
    for ($i = 0; $i < strlen($s); $i++)
        if ($s[$i] == $s[($i + 1)] && $s[$i] == $s[($i + 2)]){
            f('This character name have more them 3 letters repeated together.<br> Please select another one!');
            die();
        }
    foreach (array('aa ', 'ee', 'ii', 'oo', 'uu', 'gm', 'cm', 'aff ', 'god ', 'abc', 'tutor', 'game', 'admin', 'the ') as $v)
        if ($v == substr($s, 0, strlen($v))){
            f('This character name is already used. Please select another one!');
            die();
        }
    foreach (array('game', 'customer', 'support', 'fuck', 'haha', 'sux', ' abc', 'suck', 'noob', 'tutor', 'admin', 'account', 'gay', 'password', 'manager') as $v)
        if (strpos($s, $v) !== false){
            f('This character name is already used. Please select another one!');
            die();
        }

    $char_name = trim(stripslashes($s));


    $char_name = new Player();
    $char_name->loadByName($s);
    if ($char_name->isLoaded()) {
        f('This character name is already used. Please select another one!');
    } else {
        s();
    }
    exit;

}else{
    header("Location: ./");
}