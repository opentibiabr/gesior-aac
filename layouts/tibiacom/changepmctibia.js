// define data structures
var g_Services = [133,134,135,136,137];
var g_PaymentMethodCategories = [11,21,22,31,32,33];
var g_Prices = {"133":{"11":"36.00 BRL","21":"36.00 BRL","22":"36.00 BRL","31":"36.00 BRL","32":"36.00 BRL","33":"38.00 BRL"},"134":{"11":"100.00 BRL","21":"100.00 BRL","22":"100.00 BRL","31":"100.00 BRL","32":"100.00 BRL","33":"106.00 BRL"},"135":{"11":"201.00 BRL","21":"201.00 BRL","22":"201.00 BRL","31":"201.00 BRL","32":"201.00 BRL","33":"213.00 BRL"},"136":{"11":"402.00 BRL","21":"402.00 BRL","22":"402.00 BRL","31":"402.00 BRL","32":"402.00 BRL","33":"426.00 BRL"},"137":{"11":"603.00 BRL","21":"603.00 BRL","22":"603.00 BRL","31":"603.00 BRL","32":"603.00 BRL","33":"638.00 BRL"}};

// change the selected service
function ChangeService(a_ServiceID, a_ServiceCategoryID)
{
    // console.log('### ChangeService() ### a_ServiceID #' + a_ServiceID + '# a_ServiceCategoryID #' + a_ServiceCategoryID + '#');
    // set the ServiceID for the change country form
    $('#CC_ServiceID').val(a_ServiceID);
    $('#CC_ServiceID').attr('name', 'InitialServiceID');
    // activate the radio button itself and set the price
    $('#ServiceID_' + a_ServiceID).attr('checked', 'checked');
    $('.ServiceID_Icon_Container').css('background-color', '');
    // handle payment methods
    for (var i = 0; i < g_PaymentMethodCategories.length; i++) {
        if (typeof g_Prices[a_ServiceID] !== 'undefined') {
            // console.log('### ChangeService() ### check  #' + typeof g_Prices[a_ServiceID][g_PaymentMethodCategories[i]] + '# #' + g_Prices[a_ServiceID][g_PaymentMethodCategories[i]] + '#');
            if (typeof g_Prices[a_ServiceID][g_PaymentMethodCategories[i]] === 'undefined' // ###peter: [TIBIA-10665]
                || typeof g_Prices[a_ServiceID][g_PaymentMethodCategories[i]] === 'string' && g_Prices[a_ServiceID][g_PaymentMethodCategories[i]] == 'The product is not available for the selected payment method!') {
                // deactivate the payment method
                // note: the radio button can not be disabled or we will receive the wrong error message
                $('#PMCID_NotAllowed_' + g_PaymentMethodCategories[i]).show();
            } else {
                // activate the payment method
                $('#PMCID_NotAllowed_' + g_PaymentMethodCategories[i]).hide();
            }
        }
    }
    // activate and mark the selected icon
    $('.ServiceID_Icon_Selected').css('background-image', '');
    $('#ServiceID_Icon_Selected_' + a_ServiceID).css('background-image', 'url(' + JS_DIR_IMAGES + 'payment/serviceid_icon_selected.png)');
    return;
}

// change the selected payment method category
function ChangePMC(a_PaymentMethodID)
{
    // console.log('### ChangePMC() ### a_PaymentMethodID #' + a_PaymentMethodID + '#');
    // set the PMCID for the change country form
    $('#CC_PMCID').val(a_PaymentMethodID);
    $('#CC_PMCID').attr('name', 'InitialPMCID');
    // activate the radio button
    $('#PMCID_' + a_PaymentMethodID).attr('checked', 'checked');
    $('.PMCID_Icon_Container').css('background-color', '');
    // handle services
    for (var i = 0; i < g_Services.length; i++) {
        if (typeof g_Prices[g_Services[i]] !== 'undefined') {
            // console.log('### ChangePMC() ### check  #' + typeof g_Prices[g_Services[i]][a_PaymentMethodID] + '# #' + g_Prices[g_Services[i]][a_PaymentMethodID] + '#');
            if (typeof g_Prices[g_Services[i]][a_PaymentMethodID] === 'undefined' // ###peter: [TIBIA-10665]
                || typeof g_Prices[g_Services[i]][a_PaymentMethodID] === 'string' && g_Prices[g_Services[i]][a_PaymentMethodID] == 'The product is not available for the selected payment method!') {
                // deactivate the service
                // note: the radio button can not be disabled or we will receive the wrong error message
                $('#ServiceID_NotAllowed_' + g_Services[i]).show();
                // set the price
                $('#PD_' + g_Services[i]).html('---');
            } else {
                // activate the service
                // set the price
                $('#PD_' + g_Services[i]).html(g_Prices[g_Services[i]][a_PaymentMethodID]);
                $('#ServiceID_NotAllowed_' + g_Services[i]).hide();
            }
        }
    }
    // activate and mark the selected icon
    $('.PMCID_Icon_Selected').css('background-image', '');
    $('#PMCID_Icon_Selected_' + a_PaymentMethodID).css('background-image', 'url(' + JS_DIR_IMAGES + 'payment/pmcid_icon_selected.png)');
    return;
}

// mouse over effect for payment methods
function MouseOverPMCID(a_PMCID)
{
    $('#PMCID_Icon_Over_' + a_PMCID).css('background-image', 'url(' + JS_DIR_IMAGES + 'payment/pmcid_icon_over.png)');
}

// mouse out effect for payment methods
function MouseOutPMCID(a_PMCID)
{
    $('#PMCID_Icon_Over_' + a_PMCID).css('background-image', '');
}

// mouse over effect for products
function MouseOverServiceID(a_ServiceID, a_ServiceCategoryID)
{
    $('#ServiceID_Icon_Over_' + a_ServiceID).css('background-image', 'url(' + JS_DIR_IMAGES + 'payment/serviceid_icon_over.png)');
}

// mouse out effect for products
function MouseOutServiceID(a_ServiceID, a_ServiceCategoryID)
{
    $('#ServiceID_Icon_Over_' + a_ServiceID).css('background-image', '');
}