<?php

/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 17/07/2018
 * Time: 10:37
 */

/**
 * @param $msg
 * @param $status
 * @return array
 */
function ajax($msg, $status)
{
	$aj = [];
	$aj['msg'] = $msg;
	$aj['status'] = $status;

	return $aj;
};

/**
 * @param $name
 * @param $desc
 * @param $button
 * @return mixed
 */
$create_category = function ($name, $desc, $button) use ($SQL) {
	$name = (string) $name;
	$desc = (string) $desc;
	$button = (string) $button;
	$create = $SQL->prepare("INSERT INTO z_shop_category (name, `desc`, button) VALUES (:nome, :descr, :button)");
	$create->execute(['nome' => $name, 'descr' => $desc, 'button' => $button]);
	if ($create->errorInfo()[0] === "00000") {
		return json_encode(ajax('Categoria inserida com sucesso.', TRUE));
	} else {
		return json_encode(ajax('error', false));
	}
};

/**
 * @param $id
 * @return string
 */
$remove_category = function ($id) use ($SQL) {
	$id = (int) $id;
	$remove = $SQL->prepare("DELETE FROM z_shop_category WHERE id = :id");
	$remove->execute(['id' => $id]);
	if ($remove->errorCode() === '00000') {
		return json_encode(ajax('Categoria removida com sucesso', TRUE));
	} else {
		return json_encode($remove->errorInfo());
	}
};

/**
 * @param $id
 * @param $name
 * @param $desc
 * @param $button
 * @param $hide
 */
$update_category = function ($id, $name, $desc, $button, $hide = 0) use ($SQL) {
	$id = (int) $id;
	$name = (string) $name;
	$desc = (string) $desc;
	$button = (string) $button;
	$hide = (int) $hide;
	$update = $SQL->prepare("UPDATE z_shop_category  SET name = :name,`desc` = :desc, button = :button, hide = :hide WHERE id = :id");
	$update->execute(['id' => $id, 'name' => $name, 'desc' => $desc, 'button' => $button, 'hide' => $hide]);
};



//var_dump($remove_category(6));


die();

$main_content .= $make_double_archs('AJAX SHOP SYSTEM');
$main_content .= "<div class='TableContainer'>";
$main_content .= $make_content_header("TESTE");
$main_content .= $make_table_header();
$main_content .= "<tr><td>AAAAAAAAAAAAAAA</td></tr>";
$main_content .= $make_table_footer();
$main_content .= "</div>";
