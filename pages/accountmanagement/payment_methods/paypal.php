<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 23/04/2018
 * Time: 01:31
 */


$main_content .= '<script src="https://www.paypalobjects.com/api/checkout.js"></script>';
$main_content .= '<div style="text-align: center; margin-top: 20px">';
$main_content .= '<div id="paypal-button-container"></div>';
$main_content .= '

<style>

	/* Media query for mobile viewport */
	@media screen and (max-width: 400px) {
		#paypal-button-container {
			width: 100%;
		}
	}

	/* Media query for desktop viewport */
	@media screen and (min-width: 400px) {
		#paypal-button-container {
			width: 250px;
			display: inline-block;
		}
	}

</style>';
$main_content .= '</div>';
$main_content .= '
				<script>

				var CREATE_PAYMENT_URL  = \'./paypal_create.php\';
				paypal.Button.render({
					env: \'' . $config['paypal']['env'] . '\', // Or \'sandbox\',
					commit: true, // Show a \'Pay Now\' button
					style: {
						  label: \'checkout\',  // checkout | credit | pay | buynow | generic
						  size:  \'responsive\', // small | medium | large | responsive
						  shape: \'rect\',   // pill | rect
						  color: \'black\'   // gold | blue | silver | black
						  },
					  payment: function(data, actions) {

									  var params = {
										  product_id:\'' . $payment_data['ServiceID'] . '\',
										  accname:\'' . $account_logged->getName() . '\'
									  };
						return paypal.request.post(CREATE_PAYMENT_URL, params).then(function(data) {
								return data.id;
							});
					  },

		onAuthorize: function(data, actions) {
			return actions.payment.execute().then(function(res) {
				var desc = res.transactions[\'0\'].item_list.items[\'0\'].description;
				iziToast.show({
							title:\'Que legaaal!!!\',
							message:\'Você acabou de comprar \'+desc+\'.\',
							position:\'center\',
							onClosing:function() {
							   window.location.href = \'./?subtopic=accountmanagement\';
							}
						});
			});
		},

	  // onAuthorize() is called when the buyer approves the payment
//            onAuthorize: function(data, actions) {

				// Set up a url on your server to execute the payment
//                var EXECUTE_PAYMENT_URL = \'./paypal_execute.php\';

				// Set up the data you need to pass to your server
//                var data = {
//                    paymentID: data.paymentID,
//                    payerID: data.payerID
//                };

				// Make a call to your server to execute the payment
//                return paypal.request.post(EXECUTE_PAYMENT_URL, data)
//                    .then(function (res) {
//                        window.alert(\'Payment Complete!\');
//                    });
//            },



	  onCancel: function(data, actions) {
		iziToast.show({
					title:\'Que pena!\',
					message:\'Você acabou de cancelar essa compra, tente novamente.\',
					position:\'center\',
					icon: \'material-icons\',
					timeout:40000,
					iconText:\'mood_bad\'
				});
	  },

	  onError: function(err) {
				iziToast.error({
					title:\'OPPPPSSSSS!\',
					message:\'Ocorreu algum erro na hora de passar a venda, favor tentar novamente.\',
					position:\'center\'
				});
	  }
	}, \'#paypal-button-container\');
  </script>';
