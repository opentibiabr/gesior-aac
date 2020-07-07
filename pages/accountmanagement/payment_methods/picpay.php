<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 23/04/2018
 * Time: 01:31
 */

if ($_POST['pic']) {
	if (!isset($_SESSION['dnt_bank'])) {
		$date = new DateTime();
		$now = time();
		$product_id = $_POST['pid'];
		$price = array_keys($config['donate']['offers'][intval($product_id)])[0];
		$coinCount = array_values($config['donate']['offers'][intval($product_id)])[0];
		$insert = $SQL->prepare("INSERT INTO z_shop_donates (date, reference, account_name, method, price, points, status) VALUES (:date, :reference, :account_name, :method, :price, :points, :status)");
		$insert->execute(['date' => $now, 'reference' => $account_logged->getName() . '-' . $_POST['pic'], 'account_name' => $account_logged->getName(), 'method' => 'picpay', 'price' => ($price / 100), 'points' => $coinCount, 'status' => 'Pending']);
		$_SESSION['dnt_bank'] = TRUE;
		$_SESSION['dnt_bank_tries'] = 0;
		$data = [
			'status' => 'success',
			'msg' => 'Pagamento processado com sucesso, estamos aguardando o e-mail de confirmação do depósito.'
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

$main_content .= "<br/>";
$main_content .= "
<div id='modal-picpay' class='iziModal'></div>
<script>
	$('#modal-picpay').iziModal({
		top: 50,
		headerColor: '#21c25e',
		background: 'green',
		title: 'Fazer doação com PicPay',
		subtitle: 'Faça sua doação com picpay de acordo com o plano solicitado.',
		icon: 'icon-settings_system_daydream',
		overlayClose: true,
		iframe : true,
		iframeURL: 'https://app.picpay.com/user/" . $config['picpay']['user'] . "',
		iframeHeight:500,
		fullscreen: true,
		openFullscreen: false,
		borderBottom: false,
		group: 'grupo1',
		onFullscreen: function(modal){
			console.log(modal.isFullscreen);
		},
		onClosing: function(){
			window.location.replace(\"./?subtopic=accountmanagement&action=paymentshistory\");
		},
	});
	
//    $(document).on('click', '#picpay', function (event) {
//        event.preventDefault();
//        $('#modal-picpay').iziModal('open', event);
//    });
</script>";
$main_content .= "<p style='font-size: 1.2em; text-align: center'>Ao clicar no botão abaixo será aberto um modal para você escanear nosso qrcode com o aplicativo PICPAY no seu smartphone.<br/> <b>Verifique antes o valor que você deverá doar</b> pois doações com valor diferente do solicitado poderão ser <b>recusadas</b>.<br/> Fique atento!</p>";
$main_content .= '
<div class="SubmitButtonRow">
	<div class="CenterButton">
		<form id="picpayform" action="./?subtopic=accountmanagement&action=process_picpay_payment" method="post">
			<input type="hidden" value="picpay" name="pic"/>
			<input type="hidden" name="pid" value="' . $payment_data["storage_OrderServiceData"]["ServiceID"] . '">
			<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)">
				<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
					<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);"></div>
					<input id="picpay" class="ButtonText" type="image" name="" alt="" src="' . $layout_name . '/images/global/buttons/_sbutton_buynow.gif">
				</div>
			</div>
		</form>
	 </div>
</div>';
$main_content .= '<script>
$("#picpayform").submit(function() {
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
							console.info(\'closedBy: \' + closedBy);
							//window.location.replace("./?subtopic=accountmanagement&action=paymentshistory");
							$(\'#modal-picpay\').iziModal(\'open\');
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
