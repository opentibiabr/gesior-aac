<?php

/**
 *
 * @package        uam.skeleton
 * @subpackage     controllers
 * @author         Codenome Developpers - Main Developer: Ricardo <http://codenome.com>
 * @copyright      Copyright (c) 2018, Codenome. (http://myara.net/)
 * @license        GPL v3
 * @link           http://uam.codenome.com
 * @since          Version 0.0.1
 * @filesource
 */

/**
 * @param $status
 * @param $msg
 * @return array
 */
function getStatus($status, $msg)
{
	$data = [];
	$data['error'] = $status;
	$data['msg'] = $msg;
	return $data;
}

/**
 * @param $rk
 * @return bool
 */
$verifica_rk = function ($rk) use ($SQL, $account_logged) {
	$acc_rk = $account_logged->getKey();
	if ($acc_rk == strtoupper($rk)) {
		return TRUE;
	} else {
		return false;
	}
};

/**
 * @param $player_id  int
 * @param $price_type int
 * @param $price      int
 * @param $rk         String
 * @return string
 */
$add_sell_character = function ($player_id, $price_type, $price, $rk) use ($verifica_rk, $account_logged, $config, $SQL) {
	$reqs = valida_multiplas_reqs();
	$vrk = $verifica_rk($rk);
	if ($vrk) {
		if ($reqs) {
			$va = $SQL->query("SELECT player_sell_bank FROM accounts WHERE id = {$account_logged->getID()}")->fetchAll();
			$va = $va[0]['player_sell_bank'];
			if ($va != NULL && $va != '' && $va != '0' && $va != 0 || !Website::getWebsiteConfig()->getValue('sell_by_gold')) {
				if ($va != $player_id || !Website::getWebsiteConfig()->getValue('sell_by_gold')) {
					$player_id = (int) $player_id;
					$price_type = (int) $price_type;
					$price = (int) $price;
					$player = new Player();
					$player->loadById($player_id);
					$account = new Account();
					$account->loadById($player->getAccountID());
					$date = new DateTime();
					$now = $date->format('Y-m-d H:i:s');
					$valid = date_add($date, date_interval_create_from_date_string('5 days'))->format('Y-m-d H:i:s');
					$price_coin = 0;
					$price_gold = 0;
					if (Website::getWebsiteConfig()->getValue('sell_by_gold')) {
						$price_type = ($price_type == 0 ? 0 : 1);
					} else {
						$price_type = 0;
					}
					if ($price_type == 0) {
						$price_coin = $price;
						$price_max = Website::getWebsiteConfig()->getValue('max_price_coin');
					} else {
						$price_gold = $price;
						$price_max = Website::getWebsiteConfig()->getValue('max_price_gold');
					}
					if (!$player->isOnline()) {
						if ($price > 0 && $price <= $price_max) {
							$valida = $SQL->query("SELECT id_player FROM account_character_sale where id_player = {$player_id}")->rowCount();
							if ($account_logged->getID()) {
								if ($valida == 0) {
									$query = $SQL->prepare("SELECT * FROM players WHERE id = :p_id AND level >= " . Website::getWebsiteConfig()->getValue("min_lvl_to_sell"));
									$query->execute(['p_id' => $player_id]);
									$valida = $query->rowCount();
									if ($valida > 0) {
										if ($player->getAccountID() == $account_logged->getID()) {
											$query = $SQL->prepare("INSERT INTO `account_character_sale`
									   (`id_account`,`id_player`,`status`, `price_type`,`price_coins`,`price_gold`, `dta_insert`,`dta_valid`)
									   VALUES (:account_id, :player_id, 0, :price_type, :price_coin, :price_gold, :now, :valid);");
											$query->execute(['account_id' => $player->getAccountID(), 'player_id' => $player_id, 'price_type' => $price_type, 'price_coin' => $price_coin, 'price_gold' => $price_gold, 'now' => $now, 'valid' => $valid]);

											$query = $SQL->prepare("UPDATE `players` SET `account_id` = :account_id WHERE `id` = :player_id;");
											$query->execute(['account_id' => $config['sell']['account_seller_id'], 'player_id' => $player_id]);
											$query = $SQL->prepare("INSERT INTO account_character_sale_history
									   (id_old_account, id_new_account, id_player,dta_insert, dta_sale)
									   VALUES (:account_id, NULL , :player_id, :now, NULL);");
											$query->execute(['account_id' => $player->getAccountID(), 'player_id' => $player_id, 'now' => $now]);

											if (Website::getWebsiteConfig()->getValue('sell_by_gold')) {
												$data = getStatus(false, 'Player inserido com sucesso.');
											} else {
												$data = getStatus(false, 'Player inserido com sucesso. A venda via GOLD está inativa portanto o valor escolhido será tratado como coins.');
											}
											return json_encode($data);
										} else {
											$data = getStatus(TRUE, 'O player que você tentou vender não pertence à essa account.');
											return json_encode($data);
										}
									} else {
										$data = getStatus(TRUE, 'Este player está abaixo do Level necessário para venda.');
										return json_encode($data);
									}
								} else {
									$data = getStatus(TRUE, 'Esse player já se encontra em venda.');
									return json_encode($data);
								}
							}
						} else {
							$data = getStatus(TRUE, "Preço deve estar entre 1 e " . number_format($price_max, 0, ',', '.'));
							return json_encode($data);
						}
					} else {
						$data = getStatus(TRUE, "O jogador deve estar offline");
						return json_encode($data);
					}
				} else {
					$data = getStatus(TRUE, "Você não pode vender seu char que está recebendo o dinheiro de suas compras.");
					return json_encode($data);
				}
			} else {
				$data = getStatus(TRUE, "Você não pode vender sem antes selecionar um player para receber o valor das suas vendas realizadas em coins.");
				return json_encode($data);
			}
		} else {
			$data = getStatus(TRUE, "Número máximo de requisições por minuto atingido.");
			return json_encode($data);
		}
	} else {
		$data = getStatus(TRUE, "A RK(recovery key) digitada não é compatível com a RK da conta logada.");
		return json_encode($data);
	}
};

/**
 * @param $player_id
 * @return bool
 */
$remove_sell_characters = function ($player_id, $rk) use ($config, $SQL, $account_logged, $verifica_rk) {
	$req = valida_multiplas_reqs();
	$vrk = $verifica_rk($rk);
	if ($vrk) {
		if ($req) {
			$player_id = (int) $player_id;
			$valida = $SQL->prepare("SELECT `id_account` FROM `account_character_sale` WHERE id_player = :id_player AND id_account = :id_account");
			$valida->execute(['id_player' => $player_id, 'id_account' => $account_logged->getID()]);
			//    var_dump($valida->rowCount(), $valida->fetchAll());
			if ($valida->rowCount() > 0) {
				$account_id = $valida->fetchAll()[0]['id_account'];
				$query = $SQL->prepare("UPDATE players SET account_id = :account_id WHERE id = :player_id");
				$query->execute(['account_id' => $account_id, 'player_id' => $player_id]);
				$query = $SQL->prepare("DELETE FROM `account_character_sale` WHERE `id_player` = :player_id");
				$query->execute(['player_id' => $player_id]);
				$data = getStatus(false, 'Player removido da venda com sucesso');
				return json_encode($data);
			} else {
				$data = getStatus(TRUE, 'Falha ao remover este player ou ele não se encontra em venda ou não pertence à sua account.');
				return json_encode($data);
			}
		} else {
			$data = getStatus(TRUE, "Número máximo de requisições por minuto atingido.");
			return json_encode($data);
		}
	} else {
		$data = getStatus(TRUE, "A RK(recovery key) digitada não é compatível com a RK da conta logada.");
		return json_encode($data);
	}
};


/**
 * Só deve ser utilizado por administradores do site!
 * @param $id
 */
$extorna_venda_by_id_venda = function ($id) use ($SQL) {
	$q = $SQL->query("SELECT * FROM account_character_sale_history WHERE id = $id")->fetchAll();
	if ($q[0]['dta_sale'] != NULL && $q[0]['extornada'] != 1) {
		$id_old = $q[0]['id_old_account'];
		$id_pla = $q[0]['id_player'];
		$id_new = $q[0]['id_new_account'];
		$price_type = $q[0]['price_type'];
		$price = $q[0]['price'];
		$pbankid = $q[0]['char_id'];
		$bank_char_id = $SQL->query("SELECT player_sell_bank from accounts WHERE id = $id_old")->fetchAll();
		$bank_char_id = (int) $bank_char_id[0]['player_sell_bank'];
		$percent = Website::getWebsiteConfig()->getValue('percent_sellchar_sale') / 100;
		$SQL->query("UPDATE account_character_sale_history SET extornada = 1 WHERE id = $id")->fetchAll();
		if ($price_type == 0) {
			$SQL->query("UPDATE accounts SET coins = (coins+$price) WHERE id = $id_new")->fetchAll();
			$SQL->query("UPDATE accounts SET coins = (coins-($price-($price*$percent))) WHERE id = $id_old")->fetchAll();
		} else {
			$SQL->query("UPDATE players SET balance = (balance+$price) WHERE id = $pbankid")->fetchAll();
			$p = new Player();
			$p->loadById($bank_char_id);
			$p->setBalance($p->getBalance() - $price);
			$p->save();
		}
		$SQL->query("UPDATE players SET account_id = $id_old WHERE id = $id_pla")->fetchAll();
	} else {
		echo "erro";
	}
};

/**
 * @param      $player_id
 * @param      $account_id
 * @param null $char_id
 * @return string
 */
$buy_character_in_sale = function ($player_id, $account_id, $char_id = NULL) use ($config, $SQL, $account_logged) {
	$req = valida_multiplas_reqs();
	if ($req) {
		if ($account_id == $account_logged->getID()) {
			$valida_acc = $SQL->prepare("SELECT id_player,id_account FROM account_character_sale WHERE id_player = :player_id AND id_account = :account_id");
			$valida_acc->execute(['player_id' => $player_id, 'account_id' => $account_id]);
			$valida_id = $SQL->prepare("SELECT id_player,id_account FROM account_character_sale WHERE id_player = :player_id");
			$valida_id->execute(['player_id' => $player_id]);
			if ($valida_id->rowCount() != 0) {
				if ($valida_acc->rowCount() == 0) {
					$v = $SQL->prepare("SELECT * FROM account_character_sale WHERE id_player = :id_player");
					$v->execute(['id_player' => $player_id]);
					$p = $v->fetchAll();
					if ($char_id != NULL) {
						$s = new Player();
						$s->loadById($char_id);
						//trava o codigo caso o player não seja da conta do maluco logado
						if ($account_logged->getID() != $s->getAccountID()) {
							$data = getStatus(TRUE, 'Você não tem permissão pra isso.');
							return json_encode($data);
						}
						$balance = $s->getBalance();
					} else {
						$balance = 0;
					}
					$price = ($p[0]['price_type'] == 0 ? $p[0]['price_coins'] : $p[0]['price_gold']);
					$old_id = $valida_id->fetchAll();
					$old_id = $old_id[0]['id_account'];
					$dta = new DateTime();
					$dta = $dta->format('Y-m-d H:i:s');
					$percent = Website::getWebsiteConfig()->getValue('percent_sellchar_sale') / 100;
					if ($p[0]['price_type'] == 0) {
						$saldo = $account_logged->getPremiumPoints();
						if ($price <= $saldo) {
							$query = $SQL->prepare("INSERT INTO account_character_sale_history (id_old_account, id_player, id_new_account,price_type,price, dta_insert,dta_sale) VALUES (:old_id, :player_id, :account_id, :price_type, :price, $dta, :dta)");
							$query->execute(['old_id' => $old_id, 'player_id' => $player_id, 'account_id' => $account_id, 'price_type' => $p[0]['price_type'], 'price' => $price, 'dta' => $dta]);
							$query = $SQL->prepare("DELETE FROM account_character_sale WHERE id_player = :id");
							$query->execute(['id' => $player_id]);
							$query = $SQL->prepare("UPDATE accounts SET coins = (coins-:price) WHERE id = :account_id");
							$query->execute(['price' => $price, 'account_id' => $account_id]);
							$query = $SQL->prepare("UPDATE accounts SET coins = (coins+(:price-(:price*($percent)))) WHERE id = :account_id");
							$query->execute(['price' => $price, 'account_id' => $old_id]);
							$query = $SQL->prepare("UPDATE players SET account_id = :acc_id WHERE id = :pl_id");
							$query->execute(['acc_id' => $account_logged->getID(), 'pl_id' => $player_id]);
							$data = getStatus(false, 'Você comprou este personagem com sucesso.');
							return json_encode($data);
						} else {
							$data = getStatus(TRUE, 'Você não tem saldo suficiente para essa compra.');
							return json_encode($data);
						}
					} else {
						if ($char_id > 0) {
							$saldo = $balance;
							if ($price <= $saldo) {
								$verifica_logado = $SQL->prepare("SELECT * FROM players_online WHERE player_id = :pid");
								$verifica_logado->execute(['pid' => $char_id]);
								if ($verifica_logado->rowCount() == 0) {
									$bank_char_id = $SQL->query("SELECT player_sell_bank from accounts WHERE id = $old_id")->fetchAll();
									$bank_char_id = $bank_char_id[0]['player_sell_bank'];
									$query = $SQL->prepare("INSERT INTO account_character_sale_history (id_old_account, id_player, id_new_account,price_type,price,char_id,dta_insert, dta_sale) VALUES (:old_id, :player_id, :account_id, :price_type, :price, :char_id, $dta, :dta)");
									$query->execute(['old_id' => $old_id, 'player_id' => $player_id, 'account_id' => $account_id, 'price_type' => $p[0]['price_type'], 'price' => $price, 'char_id' => $char_id, 'dta' => $dta]);
									$query = $SQL->prepare("DELETE FROM account_character_sale WHERE id_player = :id");
									$query->execute(['id' => $player_id]);
									$query = $SQL->prepare("UPDATE players SET balance = (balance-:price) WHERE id = :p_id");
									$query->execute(['price' => $price, 'p_id' => $char_id]);
									$query = $SQL->prepare("UPDATE players SET balance = (balance+(:price-(:price*($percent)))) WHERE id = :p_id");
									$query->execute(['price' => $price, 'p_id' => $bank_char_id]);
									$query = $SQL->prepare("UPDATE players SET account_id = :acc_id WHERE id = :pl_id");
									$query->execute(['acc_id' => $account_logged->getID(), 'pl_id' => $player_id]);
									$data = getStatus(false, 'Você comprou este personagem com sucesso.');
									return json_encode($data);
								} else {
									$data = getStatus(TRUE, 'Seu personagem não pode estar logado ao realizar essa compra. Por favor faça logout e tente novamente.');
									return json_encode($data);
								}
							} else {
								$data = getStatus(TRUE, 'Você não tem saldo suficiente para essa compra.');
								return json_encode($data);
							}
						} else {
							$data = getStatus(TRUE, 'Para essa operação você precisa selecionar um personagem cujo qual será utilizado o saldo do balance para a compra.');
							return json_encode($data);
						}
					}
				} else {
					$data = getStatus(TRUE, 'Você não pode comprar seu próprio personagem.');
					return json_encode($data);
				}
			} else {
				$data = getStatus(TRUE, "Você não tem permissão pra isso.");
				return json_encode($data);
			}
		} else {
			$data = getStatus(TRUE, "Você não tem permissão pra isso.");
			return json_encode($data);
		}
	} else {
		$data = getStatus(TRUE, "Número máximo de requisições por minuto atingido.");
		return json_encode($data);
	}
};
$select_player_bank = function ($id) use ($config, $SQL, $account_logged) {
	$req = valida_multiplas_reqs();
	if ($req) {
		if ($id > 0) {
			$val = $SQL->query("SELECT * FROM players WHERE id = $id AND account_id = {$account_logged->getID()}")->fetchAll();
			if (count($val) > 0) {
				$q = $SQL->prepare("UPDATE accounts SET player_sell_bank = $id WHERE id = {$account_logged->getID()}");
				$q->execute();
				$data = getStatus(false, 'Você atualizou o player com sucesso. Caso venda algum character via Gold os golds serão entregues à ele.');
				return json_encode($data);
			} else {
				$data = getStatus(TRUE, 'Esse player não pertence à você');
				return json_encode($data);
			}
		} else {
			$data = getStatus(TRUE, 'Selecione um player!');
			return json_encode($data);
		}
	} else {
		$data = getStatus(TRUE, "Número máximo de requisições por minuto atingido.");
		return json_encode($data);
	}
};

$type = $_POST['type'];
if ($_POST['type']) {
	if ($type == 1) {
		$rk = $_REQUEST['rk'];
		$player_sell_id = (int) $_POST['id'];
		$sell_type = (int) $_POST['price_type'];
		$price = (int) $_POST['price'];
		echo $add_sell_character($player_sell_id, $sell_type, $price, $rk);
		die();
	}
	if ($type == 2) {
		$rk = $_REQUEST['rk'];
		$remove_id = $_POST['remove_id'];
		echo $remove_sell_characters($remove_id, $rk);
		die();
	}
	if ($type == 3) {
		$player_id = (int) $_POST['id'];
		if (isset($_POST['char_id'])) {
			$char_id = (int) $_POST['char_id'];
			echo $buy_character_in_sale($player_id, $account_logged->getID(), $char_id);
			die();
		} else {
			echo $buy_character_in_sale($player_id, $account_logged->getID());
			die();
		}
	}
	if ($type == 4) {
		$id = $_POST['id'];
		echo $select_player_bank($id);
		die();
	}
} else {
	$main_content .= "
<p>Welcome to our character selling system, look carefully at the information below so you can make a safe and trouble-free sale of your character.</p>
<p><b>Who can sell, and how?</b></p>
<p>Anyone who has a character above the <b>level " . Website::getWebsiteConfig()->getValue('min_lvl_to_sell') . "</b>, that is not banned you can put it on sale. The process is simple, you will choose the character you want to sell, then put the value (in premium points) that you will ask for it.</p>
<p style='text-align: center'><b>Attention!</b></p>
<p style='text-align: center'>Será cobrado uma porcentagem de (" . Website::getWebsiteConfig()->getValue('percent_sellchar_sale') . "%) para cada venda realizada.</p>
<p>Antes de fazer uma venda você precisa escolher um player para receber o gold das vendas - Esse player não poderá ser vendido.</p>";
	$q = $SQL->query("SELECT id FROM players WHERE account_id = {$account_logged->getID()}")->fetchAll();
	$selected = $SQL->query("SELECT player_sell_bank FROM accounts WHERE id = {$account_logged->getID()}")->fetchAll();
	$selected = $selected[0]['player_sell_bank'];
	$main_content .= "<form id='select_player_bank' method='post' action='./?subtopic=accountmanagement&action=sellchar'>
	<input type='hidden' value='4' name='type'>
	<select name='id'>
	<option value='0' " . ($selected == NULL ? "selected" : "") . ">-->SELECT PLAYER<--</option>";
	foreach ($q as $play) {
		$pl = new Player();
		$pl->loadById($play['id']);
		$main_content .= "
<option value='{$pl->getID()}' " . ($selected == $pl->getID() ? "selected" : "") . " name='{$pl->getID()}'>{$pl->getName()}</option>";
	}
	$main_content .= "</select>
	<input type='submit' value='escolher'>
</form>";
	$main_content .= "
<script>
$('#select_player_bank').submit(function() {
	var form = $(this);
	var data = form.serialize();
	var url = form.attr('action');
	var type = form.attr('method');
	$.ajax({
	url: url,
	data: data,
	type: type,
	dataType: 'json',
	beforeSend: function(){
//        $('.se-pre-con').fadeIn('fast');
		iziToast.show({
	title: 'Now...',
	message: 'Loading!!',
	position:'topRight',
	timeout:2000
});
	},
	success: function(response) {
	  if(response.error === true){
			$('.se-pre-con').fadeOut('slow');
			iziToast.error({
							title: 'ERROR:',
							message: response.msg,
							position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
							timeout: 3000
						});
	  }else{          
		$('.se-pre-con').fadeOut('slow');
		iziToast.success({
				title:'Success:',
				message:response.msg,
				position:'topRight',                
				timeout: 4000
		});
	  }
	}
	});
	return false;
});
</script>";
	$main_content .= "
<p>Check correctly if the character you are selling is what you really want to sell, and also the price of it, once you post the sale you can just give up the sale a day later. Below is the list of characters you can sell.</p>";
	$main_content .= '<div class="sell_error_handler"></div>';
	$main_content .= '<div class="TableContainer">';
	$main_content .= $make_content_header("Character");
	$main_content .= $make_table_header();
	$main_content .= '
					<tr style="height: 40px">
						<td width="8%"><strong>*</strong></td>
						<td><strong>Character</strong></td>
						<td align="center"><strong>Recovery Key</strong></td>
						<td align="center"><strong>Offer Type</strong></td>
						<td align="center"><strong>Offer Value<br></strong></td>
						<td width="15%" align="center"><strong>Sell</strong></td>
					</tr>';

	$p = $account_logged->getPlayersList()->data;
	$i = 0;
	if (count($p) > 0) {
		foreach ($p as $players) {
			$pl = new Player();
			$bgcolor = (($i++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
			$pl->loadById($players['id']);
			$main_content .= "<form id='sell_char_" . $pl->getID() . "' method='post' action='./?subtopic=accountmanagement&action=sellchar'>";
			$main_content .= '<tr class="char_' . $pl->getID() . '" style="background-color:' . $bgcolor . ';">';
			$main_content .= "<td><img class='Outfit' src='" . $pl->makeOutfitUrl() . "' alt='' name=''></td>";
			$main_content .= "<td><a href='./?subtopic=characters&name=" . urlencode($pl->getName()) . "' <b>" . $pl->getName() . "</b></a><br/><small>" . $pl->getVocationName() . "<br/>lvl: " . $pl->getLevel() . "</small></td>";
			$main_content .= "<td><input type='text' name='rk' style='text-transform: uppercase' required></td>";
			$main_content .= "
<td>
<select name='price_type' required>
	<option value='0' name='0'>Coins</option>
	<option value='1' name='1'>Gold</option>
</select>
</td>";
			$main_content .= "<td><input type='number' name='price' required></td>";
			$main_content .= "<input type='hidden' name='type' value='1'>";
			$main_content .= "<input type='hidden' name='id' value='" . $pl->getID() . "'>";
			$main_content .= "<td align='center'><input type='submit' name='submit' value='Vender'></td>";
			$main_content .= '
<script>
var q = $("#sell_char_' . $pl->getID() . '");
q.submit(function() {
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
		$(".se-pre-con").fadeIn("fast");
	},
	success: function(response) {
	  if(response.error === true){
			$(".se-pre-con").fadeOut("slow");
			iziToast.error({
							title: "ERROR:",
							message: response.msg,
							position: \'topRight\', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
							timeout: 2500
						});
	  }else{          
		$(".char_' . $pl->getID() . '").fadeOut("slow");
		$(".se-pre-con").fadeOut("slow");
		iziToast.success({
				title:"Success:",
				message:response.msg,
				position:"topRight",                
				timeout: 2500,
				onClosing: function (instance, toast, closedBy) {
								// console.info(\'closedBy: \' + closedBy);
								window.location.replace("./?subtopic=accountmanagement&action=sellchar");
							}
		});
	  }
	}
	});
	return false;
});
</script>
';
			$main_content .= '</tr>';
			$main_content .= "</form>";
		}
	} else {
		$main_content .= '
					<tr style="background-color:#F1E0C6;">
						<td colspan="6">Você ainda não possui personagens em sua conta.</td>
					</tr>';
	}
	$main_content .= $make_table_footer();
	$main_content .= '</div>';

	$main_content .= '<p>Once put up for sale, you can only withdraw after of <span style="color: #5b0600">(1 hours)</span></p>';

	$main_content .= '<div class="TableContainer">';
	$main_content .= $make_content_header("Characters for sale");
	$main_content .= $make_table_header();
	$main_content .= '
					<tr style="height: 40px;">
						<td width="8%"><strong>*</strong></td>
						<td width="15%"><strong>Character</strong></td>
						<td align="center"><strong>Value</strong></td>
						<td width="25%" align="center"><strong>Date</strong></td>
						<td width="25%" align="center"><strong>Recovery Key</strong></td>
						<td width="15%" align="center"><strong>Cancel</strong></td>
					</tr>';
	$sellers = $SQL->query("SELECT * FROM account_character_sale WHERE id_account = {$account_logged->getID()}")->fetchAll();
	if (count($sellers) > 0) {
		$i = 0;
		foreach ($sellers as $seller) {
			$pl = new Player();
			$pl->loadById($seller['id_player']);
			$bgcolor = (($i++ % 2 == 1) ? $config['site']['darkborder'] : $config['site']['lightborder']);
			$main_content .= "<form id='remove_sell_player_{$pl->getID()}' method='post' action='./?subtopic=accountmanagement&action=sellchar'>";
			$main_content .= "<tr style='background-color: {$bgcolor}'>";
			$main_content .= "<td><img class='Outfit' src='{$pl->makeOutfitUrl()}'' alt='' name=''></td>";
			$main_content .= "<td><a href='./?subtopic=characters&name=" . urlencode($pl->getName()) . "' <b>" . $pl->getName() . "</b></a> <br/> <small>{$pl->getVocationName()}<br/>lvl: {$pl->getLevel()}</small></td>";
			$main_content .= "<td>" . ($seller['price_type'] == 0 ? number_format($seller['price_coins'], 0, ',', '.') . " Coins" : number_format($seller['price_gold'], 0, ',', '.') . " Gold") . "</td>";
			$main_content .= "<td>{$seller['dta_valid']}</td>";
			$main_content .= "<td><input type='text' style='text-transform: uppercase' name='rk' required></td>";
			$main_content .= "<input type='hidden' value='2' name='type'>";
			$main_content .= "<input type='hidden' value='{$pl->getID()}' name='remove_id'>";
			$main_content .= "<td align='center'><input type='submit' value='remover'></td>";
			$main_content .= "</tr>";
			$main_content .= "</form>";
			$main_content .= "
<script>
	$('#remove_sell_player_{$pl->getID()}').submit(function() {
	var form = $(this);
	var data = form.serialize();
	var url = form.attr(\"action\");
	var type = form.attr(\"method\");
	$.ajax({
	url: url,
	data: data,
	type: type,
	dataType: \"json\",
	beforeSend: function(){
		$(\".se-pre-con\").fadeIn(\"fast\");
	},
	success: function(response) {
		console.log(response.error);
	  if(response.error === true){
			$(\".se-pre-con\").fadeOut(\"slow\");
			iziToast.error({
							title: \"ERROR:\",
							message: response.msg,
							position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
							timeout: 2500
						});
	  }else{
		$(\".se-pre-con\").fadeOut(\"slow\");
		iziToast.success({
				title:\"Success:\",
				message:response.msg,
				position:\"topRight\",
				timeout: 2500,
				onClosing: function (instance, toast, closedBy) {
					// console.info('closedBy: ' + closedBy);
					window.location.replace(\"./?subtopic=accountmanagement&action=sellchar\");
				}
		});
	  }
	}
	});
	return false;
	})
</script>
		";
		}
	} else {
		$main_content .= '
					<tr style="background-color:#F1E0C6;">
						<td colspan="6">Você não possui personagens à venda.</td>
					</tr>';
	}

	$main_content .= $make_table_footer();
	$main_content .= '</div>';
}
