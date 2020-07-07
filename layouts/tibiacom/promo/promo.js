function showPromo() {
    var promo = ouibounce(false,{
        'cookieName':'promoDepressao',
        'aggressive': true,
        callback:function () {
            $('#promo-overlay').fadeIn();
            $('#promoloader').fadeIn();
        }
    });
    promo.fire();
    promo.destroy();
}

function closePromo() {
    $('#promoloader').fadeOut();
    $('#promo-overlay').fadeOut();
}