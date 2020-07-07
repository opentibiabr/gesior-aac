<?PHP
require 'config/config.php';

// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE',false);

define('INITIALIZED', true);

// if not defined before, set 'false' to load all normal
if(!defined('ONLY_PAGE'))
	define('ONLY_PAGE', false);

// check if site is disabled/requires installation
include_once('./system/load.loadCheck.php');

// fix user data, load config, enable class auto loader
include_once('./system/load.init.php');

// DATABASE
include_once('./system/load.database.php');
if(DEBUG_DATABASE)
	Website::getDBHandle()->setPrintQueries(true);
// DATABASE END

$retorno_token = $config['pagseguro']['apitoken']; // Token gerado pelo PagSeguro
##############################################################
#                         CONFIGURAÇÕES
##############################################################


if (empty($_POST['Referencia'])) { header("Location http://pagseguro.com.br");  }

list($accname, $world) = explode('-', $_POST['Referencia']);
// Validando dados no PagSeguro

$PagSeguro = 'Comando=validar';
$PagSeguro .= '&Token=' . $retorno_token;
$Cabecalho = "Retorno PagSeguro";

foreach ($_POST as $key => $value)
{
	$value = urlencode(stripslashes($value));
	$PagSeguro .= "&$key=$value";
}

if (function_exists('curl_exec'))
{
	$curl = true;
}
elseif ( (PHP_VERSION >= 4.3) && ($fp = @fsockopen ('ssl://pagseguro.uol.com.br', 443, $errno, $errstr, 30)) )
{
	$fsocket = true;
}
elseif ($fp = @fsockopen('pagseguro.uol.com.br', 80, $errno, $errstr, 30))
{
	$fsocket = true;
}

if ($curl == true)
{
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://pagseguro.uol.com.br/Security/NPI/Default.aspx');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $PagSeguro);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	curl_setopt($ch, CURLOPT_URL, 'https://pagseguro.uol.com.br/Security/NPI/Default.aspx');
	$resp = curl_exec($ch);

	curl_close($ch);
	$confirma = (strcmp ($resp, "VERIFICADO") == 0);
}
elseif ($fsocket == true)
{
 $Cabecalho  = "POST /Security/NPI/Default.aspx HTTP/1.0\r\n";
 $Cabecalho .= "Content-Type: application/x-www-form-urlencoded\r\n";
 $Cabecalho .= "Content-Length: " . strlen($PagSeguro) . "\r\n\r\n";

 if ($fp || $errno>0)
 {
	fputs ($fp, $Cabecalho . $PagSeguro);
	$confirma = false;
	$resp = '';
	while (!feof($fp))
	{
	   $res = @fgets ($fp, 1024);
	   $resp .= $res;
	   if (strcmp ($res, "VERIFICADO") == 0)
	   {
		  $confirma=true;﻿
		  // break;
	   }
	}
	fclose ($fp);
 }
 else
 {
	echo "$errstr ($errno)<br />\n";
 }
}


if ($confirma) {
## Recebendo Dados ##
$TransacaoID = $_POST['TransacaoID'];
$VendedorEmail  = $_POST['VendedorEmail'];
$Referencia = $_POST['Referencia'];
$TipoFrete = $_POST['TipoFrete'];
$ValorFrete = $_POST['ValorFrete'];
$Extras = $_POST['Extras'];
$Anotacao = $_POST['Anotacao'];
$TipoPagamento = $_POST['TipoPagamento'];
$StatusTransacao = $_POST['StatusTransacao'];
$CliNome = $_POST['CliNome'];
$CliEmail = $_POST['CliEmail'];
$CliEndereco = $_POST['CliEndereco'];
$CliNumero = $_POST['CliNumero'];
$CliComplemento = $_POST['CliComplemento'];
$CliBairro = $_POST['CliBairro'];
$CliCidade = $_POST['CliCidade'];
$CliEstado = $_POST['CliEstado'];
$CliCEP = $_POST['CliCEP'];
$CliTelefone = $_POST['CliTelefone'];
$NumItens = $_POST['NumItens'];
$ProdQuantidade_x = $POST['ProdQuantidade_x'];
$ProdValor_x = $POST['ProdValor_x'];
$ProdDescricao_x = $POST['ProdDescricao_x'];

# GRAVA OS DADOS NO BANCO DE DADOS #


try {

	$conn = $SQL;
	$stmt = $conn->prepare('INSERT into pagseguro_transactions SET transaction_code = :transaction_code, name = :name, payment_method = :payment_method, status = :status, item_count = :item_count, data = :data, payment_amount = :payment_amount');
	$stmt->bindParam(":transaction_code", $TransacaoID);
	$stmt->bindParam(":name", $accname);
	$stmt->bindParam(":payment_method", $TipoPagamento);
	$stmt->bindParam(":item_count", $NumItens);
	$stmt->bindParam(":data", date('Y-m-d H:i:s'));
	$stmt->bindParam(":status", $StatusTransacao);
	$stmt->bindParam(":payment_amount", $ProdValor_x);
	$stmt->execute();

	$itens = array(
		"50 Tibia Coins" => 50,
		"100 Tibia Coins" => 100,
		"250 Tibia Coins" => 250,
		"500 Tibia Coins" => 500,
		"1000 Tibia Coins" => 1000,
		"2000 Tibia Coins" => 2000,
		"3000 Tibia Coins" => 3000,
		"4000 Tibia Coins" => 4000,
		"10 Tibia Coins" => 10,
	);
	if ($StatusTransacao == 'Aprovado') {
		if ($config['pagseguro']['doublePoints']) {
			$NumItens *= 2;
		}
		$stmt = $conn->prepare('UPDATE accounts SET coins = coins + :item_count WHERE name = :name');
		$stmt->execute(array('item_count' => $NumItens * ($itens[$ProdDescricao_x]), 'name' => $accname));

		$stmt = $conn->prepare("UPDATE pagseguro_transactions SET status = 'Entregue' WHERE transaction_code = :transaction_code");
		$stmt->execute(array('transaction_code' => $TransacaoID);
	}
	echo 'wow';

} catch(PDOException $e) {
	echo 'ERROR: ' . $e->getMessage();
}

}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Donate Server</title>
<style type="text/css">
body {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 16px;
	width: 900px;
	margin: 0px auto;
	margin-top: 30px;
}
b {
	font-size: 18px;
	font-weight: bold;
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
	<td width="11%" align="center" valign="middle"><img src="images/true.png" height="auto" width="64" /></td>
	<td width="89%"><p><b>S</b>ua compra está sendo processada por nossos sistemas de apuração, dentro de no máximo <u>1 hora seus pontos serão creditados</u>, caso o pagamento não for efetuado, ficará em aberto 1 ou mais pagamentos pendentes em sua conta. Caso você tenha mais de 3 pagamentos pendentes por falta de pagamento, sua conta será bloqueada temporariamente para efetuar pagamentos.</p></td>
  </tr>
</table>
<!--p><b>ID de Transação:</b> <?php echo $_POST['TransacaoID']; ?></p-->
</body>
</html>