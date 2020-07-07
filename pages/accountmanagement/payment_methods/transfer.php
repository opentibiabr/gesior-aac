<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 23/04/2018
 * Time: 01:31
 */
if ($_POST['bank']) {
	if (!isset($_SESSION['dnt_bank'])) {
		$date = new DateTime();
		$now = time();
		$product_id = $_POST['pid'];
		$price = array_keys($config['donate']['offers'][intval($product_id)])[0];
		$coinCount = array_values($config['donate']['offers'][intval($product_id)])[0];
		$insert = $SQL->prepare("INSERT INTO z_shop_donates (date, reference, account_name, method, price, points, status) VALUES (:date, :reference, :account_name, :method, :price, :points, :status)");
		$insert->execute(['date' => $now, 'reference' => $account_logged->getName() . '-' . $_POST['bank'], 'account_name' => $account_logged->getName(), 'method' => $_POST['method'], 'price' => ($price / 100), 'points' => $coinCount, 'status' => 'Pending']);

		$_SESSION['dnt_bank'] = TRUE;
		$_SESSION['dnt_bank_tries'] = 0;
		$data = [
			'status' => 'success',
			'msg' => 'Pagamento processado com sucesso, estamos aguardando o e-mail de confirmação do depósito.',
		];
		echo json_encode($data);
		die();
	} else {
		$_SESSION['dnt_bank_tries'] = $_SESSION['dnt_bank_tries'] + 1;
		$data = [
			'status' => 'error',
			'msg' => 'Pagamento já processado anteriormente'
		];
		echo json_encode($data);
		die();
	}
}

$a = 0;
$main_content .= '<div class="bank_link">';
foreach ($config['banktransfer'] as $contas) {
	$main_content .= '<div id="' . $contas['bank'] . 'modal">';
	$main_content .= '    <div style="text-align: center; padding: 20px">';
	$main_content .= "        <div><b>" . $contas['bank'] . "</b></div>";
	$main_content .= "        <div><b>Favorecido:</b> " . $contas['name'] . "</div>";
	$main_content .= "        <div><b>Agencia:</b> " . $contas['agency'] . "</div>";
	$main_content .= "        <div><b>CPF:</b> " . $contas['cpf'] . "</div>";
	$main_content .= "        <div><b>" . $contas['acctype'] . ":</b> " . $contas['account'] . "</div>";
	$main_content .= "        <div>(" . $contas['acctype'] . ")</div>";
	$main_content .= "        <div>(enviar comprovante no email: " . $contas['email'] . ")</div>";
	$main_content .= '<script>
$("#' . $contas['bank'] . 'form").submit(function() {
		var form = $(this);
		var data = form.serialize();
		var url = form.attr("action");
		var type = form.attr("method");
		
		$.ajax({
			url: url,
			data: data,
			type: type,
			dataType: "json",
			beforeSend: function(){
				iziToast.show({
					title:"Now:",
					message: "Loading",
					position:"topRight",
					zindex: 99999,
					timeout: 2500
				})
			},
			success: function(response) {
				console.log(response);
				if(response.status == "success"){
					iziToast.success({
						title:"Success:",
						message:response.msg,
						position:"topRight",
						timeout: 2500,
						zindex: 99999,
						onClosing: function (instance, toast, closedBy) {
							// console.info(\'closedBy: \' + closedBy);
							window.location.replace("./?subtopic=accountmanagement&action=paymentshistory");
						}
					})
				}else{
					iziToast.error({
						title:"Error:",
						message:response.msg,
						position:"topRight",
						timeout:2500,
						zindex: 99999
					})
				}
			}
		});
		return false;
	})
</script>';
	$main_content .= "        <div class='SubmitButtonRow'>";
	$main_content .= '
								<div class="CenterButton">
									<form id="' . $contas['bank'] . 'form" action="./?subtopic=accountmanagement&action=process_transfer_payment" method="post" style="padding:0px;margin:0px;">
										<input type="hidden" name="bank" value="' . $contas['bank'] . '">
										<input type="hidden" name="method" value="' . $payment_data["storage_OrderServiceData"]["PaymentMethodName"] . '">
										<input type="hidden" name="pid" value="' . $payment_data["storage_OrderServiceData"]["ServiceID"] . '">
										<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)">
											<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
												<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);"></div>
												<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_buynow.gif">
											</div>
										</div>
									</form>
								</div>';
	$main_content .= "        </div>";
	$main_content .= "    </div>";
	$main_content .= "</div>";
	$main_content .= "
<script>
	$('#" . $contas['bank'] . "modal').iziModal({
		headerColor: '#5f4d41',
		background: 'url(./layouts/tibiacom/images/global/content/scroll.gif)',
		title: 'Fazer doação via depósito com " . ucfirst($contas['bank']) . "',
		subtitle: 'Faça sua doação via depósito com " . ucfirst($contas['bank']) . " de acordo com o plano solicitado.',
		icon: 'icon-settings_system_daydream',
		overlayClose: true,
		fullscreen: true,
		openFullscreen: false,
		group: 'transfer_methods',
		onFullscreen: function(modal){
			console.log(modal.isFullscreen);
		}
	});

	$(document).on('click', '." . $contas['bank'] . "', function (event) {
		event.preventDefault();
		$('#" . $contas['bank'] . "modal').iziModal('open', event);
	});
</script>";
	$main_content .= '<a href="#" ' . ($a > 0 ? 'style="margin-left:15px"' : '') . ' class="' . $contas['bank'] . '">' . ucfirst($contas['bank']) . '</a>';
	$a++;
}
$main_content .= '</div>';
