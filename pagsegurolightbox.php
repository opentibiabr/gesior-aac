<?php
if (isset($_POST)) {

    require_once "config/config.php";


    if ($config['pagseguro']['testing'] == true) {
        $token = $config['pagseguro']['tokentest'];
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout?';
    } else {
        $token = $config['pagseguro']['token'];
        $url = 'https://ws.pagseguro.uol.com.br/v2/checkout?';
    }
    $email = $config['pagseguro']['email'];

    function to_xml(SimpleXMLElement $object, array $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $new_object = $object->addChild($key);
                to_xml($new_object, $value);
            } else {
                // if the key is an integer, it needs text with it to actually work.
                if ($key == (int)$key) {
                    $key = "$key";
                }
                $object->addChild($key, $value);
            }
        }
    }

    $product_id = $_POST['pid'];
    $account_name = $_POST['accname'];
    $coinCount = $config['donate']['offers'][intval($product_id)];
    $pagseguroDados = [
        "currency" => "BRL",
        "items" => [
            "item" => [
                "id" => 0001,
                "description" => $coinCount . " " . $config['pagseguro']['produtoNome'],
                "amount" => ($product_id / 100.0) . ".00",
                "quantity" => "1"
            ]
        ],
        "reference" => $account_name . "-" . $coinCount,
        "redirectURL" => $config['pagseguro']['urlNotification'],
        "receiver" => [
            "email" => $email
        ]
    ];

    $data = new SimpleXMLElement('<?xml version="1.0"?><checkout/>');
    to_xml($data, $pagseguroDados);
    $data = $data->asXML();

    $curl = curl_init("{$url}email={$email}&token={$token}");
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, Array('Content-Type: application/xml; charset=ISO-8859-1'));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    $xml = curl_exec($curl);
    curl_close($curl);
    $xml = simplexml_load_string($xml);
    echo $xml->code;

} else {
    header("Location: ./");
}





