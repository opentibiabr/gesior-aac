<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 23/04/2018
 * Time: 01:30
 */

if ($config['pagseguro']['lightbox'] == TRUE) {
	if ($config['pagseguro']['testing'] == TRUE) {
		$main_content .= '<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>';
	} else {
		$main_content .= '<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>';
	}
	$main_content .= '
		<script>
		function enviaPagseguro() {
		  $.post("pagsegurolightbox.php", {pid:"' . $payment_data['ServiceID'] . '",accname:"' . $account_logged->getName() . '"}, function(data) {
			  //alert(data);
			  var isOpenLightbox = PagSeguroLightbox({
					code: data
			  }, {
					success : function(transactionCode) {
						location.href="./?subtopic=tankyou&tcode="+transactionCode;
			  },
					abort : function() {
						//alert("abort");
					}
			  });
			  // Redirecionando o cliente caso o navegador não tenha suporte ao Lightbox
			  if (!isOpenLightbox){
					location.href="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code="+code;
			  }
		  })
		}
		</script>
		<div class="SubmitButtonRow">
			<div class="CenterButton">
				<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)">
					<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
						<div class="BigButtonOver" style="background-image: url(&quot;' . $layout_name . '/images/global/buttons/sbutton_green_over.gif&quot;); visibility: hidden;"></div>
						<input class="ButtonText" onclick="enviaPagseguro()" type="image" name="Next" alt="Next" src="' . $layout_name . '/images/global/buttons/_sbutton_next.gif">
					</div>
				</div>
			</div>
		</div>
		<form id="comprar"
		action="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html"
		method="POST"
		onsubmit="PagSeguroLightbox(this); return false;">
			<input type="hidden" name="code" id="code" value=""/>
		</form>
		';
} else {
	$main_content .= '
<div class="SubmitButtonRow">
	<div class="CenterButton">
		<form target="pagseguro" method="post" action="dntpagseguro.php">
			<input type="hidden" name="accname" value="' . $account_logged->getName() . '">
			<input type="hidden" name="pid" value="' . $payment_data['ServiceID'] . '">
			<input type="hidden" name="store_id" value="">
			<input type="hidden" name="return" value="">
			<input type="hidden" name="notify_url" value="">
			<input type="hidden" name="order_id" value="">
			<input type="hidden" name="order_description" value="">
			<input type="hidden" name="amount" value="">
			<input type="hidden" name="currency_code" value="">
			<input type="hidden" name="client_email" value="">
			<input type="hidden" name="hash_key" value="">
			<input type="hidden" name="payment_id" value="">
			<input type="hidden" name="language" value="">
			<input type="hidden" name="country_payment" value="">
			<input type="hidden" name="project_id" value="">
			<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)">
				<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
					<div class="BigButtonOver" style="background-image: url(&quot;' . $layout_name . '/images/global/buttons/sbutton_green_over.gif&quot;); visibility: hidden;"></div>
					<input class="ButtonText" type="image" name="Next" alt="Next" src="' . $layout_name . '/images/global/buttons/_sbutton_next.gif">
				</div>
			</div>
		</form>
	</div>
</div>';
}
