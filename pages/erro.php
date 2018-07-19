<?php
if(!defined('INITIALIZED'))
    exit;
$main_content .= '	
	<div class="panel panel-default">
	<div class="panel-body">
		<div class="error-404">
			<div class="error-code m-b-10 m-t-20">404 <i class="fa fa-warning"></i></div>
			<h2 class="font-bold">Oops 404! That page can’t be found.</h2>
			<div class="error-desc">
				<p>Sorry, but the page you are looking for was either not found or does not exist. <br/>
				Try refreshing the page or click the button below to go back to the Homepage.</p><br>';

$main_content .= '
		<center>
			<form action="?subtopic=latestnews" method="post">
					<tr>
						<td style="border:0px;" ><div class="BigButton" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_red.gif)" >
						<div onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/global/buttons/sbutton_red_over.gif);" ></div>
						<input class="ButtonText" type="image" name="Back" alt="Back" src="'.$layout_name.'/images/global/buttons/_sbutton_back.gif" >
					</div>
				</div>
			</form>
		</center>';

$main_content .= '
			</div>
		</div>
	</div>
</div>';