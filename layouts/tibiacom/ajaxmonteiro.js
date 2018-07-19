// Ajax.

$(document).ready(function() { // This show and hide category manage button and disable and active them	
	$('#categoryStatus').live('click',function(e){
		var thiis = $(this);
		var serviceID = thiis.next('.ServiceId').val();
		var manageLink = thiis.parent().next().children();
		
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {
				acao:"manageCategories",
				catID:serviceID
			},
			dataType: "json",
			success: function(data) {
				if(data.status == "success") {
					if(data.action == "hide") {
						thiis.html('Enable');
						manageLink.hide();
					} else {
						thiis.html('Disable');
						manageLink.show();
					}
				}
			}
		});
		e.preventDefault();
	});
});

$(document).ready(function() {
	$('#addP').click(function(e){
		//vars
		var newPoints = $('input[name=addPoints]').val();
		var accountPoints = $('input[name=accountPoints]').val();
		
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {
				acao:"playerPoints",
				points:newPoints,
				accName:accountPoints
			},
			dataType: "json",
			success: function(data) {
				if(data.status == "success") {
					alert("you added " + newPoints + " points to the player successfully.");
					$('input[name=addPoints]').val('');
				}
			}
		});
		e.preventDefault();
	});
});

$(document).ready(function() { // This show and hide category manage button and disable and active them	
	$('#paymentStatus').live('click',function(e){
		var thiis = $(this);
		var paymentID = thiis.next('.PaymentId').val();
		
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {
				acao:"managePayments",
				payID:paymentID
			},
			dataType: "json",
			success: function(data) {
				if(data.status == "success") {
					if(data.action == "hide") {
						thiis.html('Enable');
					} else {
						thiis.html('Disable');
					}
				}
			}
		});
		e.preventDefault();
	});
});

///Mounts And Outfits add
$(document).ready(function() {
	
	$('#mountSubmit').click(function(e){ //AddMounts
		var mountInfo = $('select[name=selectMount]').val();
		var mountCosts = $('input[name=mountPrice]').val();
		var proceder = true;
		
		if(mountInfo == "" || mountCosts == "") {
			$('.mountStatusError').slideDown(500).html('All fields are required.');
			$('.mountStatusError').delay(3000);
			$('.mountStatusError').slideUp(500);
			proceder = false;
		}
		
		if(proceder) {
			$.ajax({
				url: 'ajax.php',
				type: 'POST',
				data: {
					acao:"addMounts",
					mountInfo:mountInfo,
					mountCost:mountCosts
				},
				dataType:"json",
				success: function(data) {
					$('.mountStatusSuccess').slideDown().html(data.msg);
					$('.mountStatusSuccess').delay(3000);
					$('.mountStatusSuccess').slideUp();
					$('select[name=selectMount]').val('');
					$('input[name=mountPrice]').de.val('');
					
				}
			});
		}
		
		e.preventDefault();
	});
	
	$('#delMount').live('submit',function(e){ //Delete mounts
		var offerId = $(this).find('.delMountId').val();
		var del = confirm('Do you really want delete this mount ?');
		if(del) {
			$.ajax({
				url: 'ajax.php',
				type: 'POST',
				data: {acao:"delMount",offerId:offerId},
				dataType: "json",
				success: function(data) {
					if(data.status == "success") {
						location.reload();
					}
				}
			});
		}else{
			e.preventDefault();
		}
	});
	
	//Outfit Submit
	$('#outfitSubmit').click(function(e){
		var outfitInfo = $('select[name=selectOutfit]').val();
		var outfitPrice = $('input[name=outfitPrice]').val();
		
		if (outfitInfo == "" || outfitPrice == "") {
			alert('Fill out all fields!');
			return false;
		}
		
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {
				acao:"addOutfits",
				outfitName:outfitInfo,
				outfitPrice:outfitPrice
			},
			dataType: "json",
			success: function(data) {
				if (data.status == "success"){
					$('.msgStatusSuccess').slideDown(500).html(data.msg);
					$('.msgStatusSuccess').delay(3000);
					$('.msgStatusSuccess').slideUp(500);
				}
			}
		});
		e.preventDefault();
	});
	
	$('#delOutfit').live('submit',function(e){ //Delete mounts
		var offerId = $(this).find('.delOutfitId').val();
		var del = confirm('Do you really want delete this outfit ?');
		if(del) {
			$.ajax({
				url: 'ajax.php',
				type: 'POST',
				data: {acao:"delOutfit",offerId:offerId},
				dataType: "json",
				success: function(data) {
					if(data.status == "success") {
						location.reload();
					}
				}
			});
		}else{
			e.preventDefault();
		}
	});
	
});

$(document).ready(function() {
	$('#itemSubmit').click(function(){
		//Variables to send ajax
		var itemID = $('input[name=itemID]').val();
		var itemName = $("input[name=itemName]").val();
		var itemDesc = $('input[name=itemDesc]').val();
		var itemAmount = $('input[name=itemAmount]').val();
		var itemPrice = $('input[name=itemPrice]').val();
		
		if (itemID == "" || itemName == "" || itemAmount == "" || itemPrice == "") {
			alert('Fill out all fields!');
			return false;
		}
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {
				acao:"addItems",
				itemId:itemID,
				itemName:itemName,
				itemDesc:itemDesc,
				itemAmount:itemAmount,
				itemPrice:itemPrice
			},
			dataType: "json",
			success: function(data) {
				if (data.status == "success"){
					$('.msgStatusSuccess').slideDown(500).html(data.msg);
					$('.msgStatusSuccess').delay(3000);
					$('.msgStatusSuccess').slideUp(500);
				}
			}
		});
		
	});
	
	$('#delItem').live('submit',function(e){ //Delete items
		var offerId = $(this).find('.delItemId').val();
		var del = confirm('Do you really want delete this item ?');
		if(del) {
			$.ajax({
				url: 'ajax.php',
				type: 'POST',
				data: {acao:"delItem",offerId:offerId},
				dataType: "json",
				success: function(data) {
					if(data.status == "success") {
						location.reload();
					}
				}
			});
		}else{
			e.preventDefault();
		}
	});
	
});

//Extra Services
$(document).ready(function() {
	$('#extraStatus').live('click',function(e){
		
		var thiis = $(this);
		var offerId = $(this).parent().parent().find('input[name=offerID]').val();
		var extraValue = $(this).parent().parent().find('input[name=extraValue]');
		var extraUpdate = $(this).parent().parent().find('input[name=extraUpdate]');
		var setStatus = $(this).parent().parent().find('.settingStatus');
		
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {
				acao:"extraServiceStatus",
				offerID:offerId
			},
			dataType: "json",
			success: function(data) {
				if (data.status) {
					if (data.action == "hide") {
						thiis.html('Enable');
						extraValue.attr('disabled','disabled');
						extraUpdate.attr('disabled','disabled');
						setStatus.html('<font style="color:red;">Disabled</font>');
					}else{
						thiis.html('Disable');
						extraValue.removeAttr('disabled');
						extraUpdate.removeAttr('disabled');
						setStatus.html('<font style="color:green;">Enabled</font>');
					}
				}
			}
		});
		e.preventDefault();
	});
	
	$('#extraUpdate').live('click',function(){
		var thiis = $(this);
		var valOffer = thiis.parent().find('input[name=offerID]').val();
		var newPrice = thiis.parent().find('input[name=extraValue]').val();
		
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {
				acao:"extraUpdatePrice",
				offerId:valOffer,
				pointsChange:newPrice
			},
			dataType: "json",
			success: function(data) {
				if(data.status) {
					$('.msgStatus').slideDown(500).html(data.msg);
					$('.msgStatus').delay(3000);
					$('.msgStatus').slideUp(500);
					
				}
			}
		});
	});
	
});

//Add and delete tickers ;)
$(document).ready(function() {
	$('#insertTicker').click(function(event){
		//vars
		var tickerText = $('input[name=tickerText]').val();
		var tickerIcon = $('select[name=tickerIcon]').val();
		
		if (tickerText == "" || tickerIcon == "") {
			alert('All fields are required!');
			return false;
		}
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {
				acao:"addTicker",
				ticker:tickerText,
				icon:tickerIcon
			},
			dataType:"json",
			success: function(data) {
				if (data.status == "success") {
					location.reload();
				}
			}
		});
		event.preventDefault();
	});
	
	$('#delTicker').live('click',function(e){
		//var
		var tickerID = $(this).parent().find('input[name=tickerID]').val();
		var del = confirm('Do you really want delete this ticker ?');
		if (del) {
			$.ajax({
				url: 'ajax.php',
				type: 'POST',
				data: {
					acao:"delTicker",
					tickerID:tickerID
				},
				dataType:"json",
				success: function(data) {
					if (data.status == "success") {
						location.reload();
					}
				}
			});
		}
		e.preventDefault();
	});
});

//adding points package
$(document).ready(function() {
	$('#pointsSubmit').click(function(){
		//vars
		var pointsAmount = $('input[name=pointsAmount]').val();
		var pointsPrice = $('input[name=pointsPrice]').val();
		var pointsDesc = $('input[name=pointsDesc]').val();
		
		if (pointsAmount == "" || pointsPrice == "") {
			alert('Points amount and points price are required!');
			return false;
		}
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {
				acao:"addPoints",
				pointsAmount:pointsAmount,
				pointsPrice:pointsPrice,
				pointsDesc:pointsDesc
			},
			dataType: "json",
			success: function(data) {
				if(data.status) {
					$('.msgStatusSuccess').slideDown(500).html(data.msg);
					$('.msgStatusSuccess').delay(3000);
					$('.msgStatusSuccess').slideUp(500);					
				}
			}
		});
	});
	
	$('#delPoint').live('click',function(e){
		//var
		var pointsID = $(this).parent().find('input[name=delPointId]').val();
		var del = confirm('Do you really want delete this point package ?');
		if (del) {
			$.ajax({
				url: 'ajax.php',
				type: 'POST',
				data: {
					acao:"delPoints",
					pointsID:pointsID
				},
				dataType:"json",
				success: function(data) {
					if (data.status == "success") {
						location.reload();
					}
				}
			});
		}
		e.preventDefault();
	});
});

function refreshPage() {
	location.reload();
}

$(document).ready(function() {
	$('#doubleStatus').live("click", function(e) {
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			data: {
				acao:"doublePoints"
			},
			dataType:"json",
			success: function(data) {
				if (data.status == "success") {
					if (data.points == "on") {
						$('#doubleStatus').html('<img src="layouts/tibiacom/images/shop/on.png" width="47px" height="23px" title="Ativo">');
						$('#doublePointsSelector').html('<div class="ribbon-double"></div>');
					} else {
						$('#doubleStatus').html('<img src="layouts/tibiacom/images/shop/off.png" width="47px" height="23px" title="Desativado">');
						$('#doublePointsSelector').html('');
					}
				}
			}
		});
		e.preventDefault();
	});
});


