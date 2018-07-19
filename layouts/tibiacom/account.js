  // change the selected service
  function ChangeService(a_ServiceID, a_ServiceCategoryID)
  {
     console.log('# ChangeService(' + a_ServiceID + ' ' + a_ServiceCategoryID + ') #');
    // set the ServiceID for the change country form
    $('#CC_ServiceID').val(a_ServiceID);
    $('#CC_ServiceID').attr('name', 'InitialServiceID');
    // activate the radio button itself and set the price
    $('#ServiceID_' + a_ServiceID).attr('checked', 'checked');
    $('.ServiceID_Icon_Container').css('background-color', '');
    // handle mounts
    if (a_ServiceCategoryID == g_QF_Mounts_ServiceCategoryID || a_ServiceCategoryID == g_QF_Outfits_ServiceCategoryID) {
      $('.ServiceID_Icon_Animation_1').hide();
      $('.ServiceID_Icon_New_Animation_1').hide();
      $('.ServiceID_Icon_New').show();
      $('#ServiceID_Icon_Animation_1_' + a_ServiceID).show();
      $('#ServiceID_Icon_New_' + a_ServiceID).hide();
    }
    // handle payment methods
    for (var i = 0; i < g_PaymentMethodCategories.length; i++) {
      if (typeof g_Prices[a_ServiceID][g_PaymentMethodCategories[i]] === 'undefined' /*|| g_Prices[a_ServiceID][g_PaymentMethodCategories[i]].indexOf("NoValidPrice") >= 0*/) {
        // deactivate the payment method
        // note: the radio button can not be disabled or we will receive the wrong error message
        $('#PMCID_NotAllowed_' + g_PaymentMethodCategories[i]).show();
        //console.log('## deactivate payment method #' + g_PaymentMethodCategories[i] + '# ##');
      } else {
        // activate the payment method
        $('#PMCID_NotAllowed_' + g_PaymentMethodCategories[i]).hide();
        //console.log('## activate payment method #' + g_PaymentMethodCategories[i] + '# ##');
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
    console.log('# ChangePMC(' + a_PaymentMethodID + ') #');
    // set the PMCID for the change country form
    $('#CC_PMCID').val(a_PaymentMethodID);
    $('#CC_PMCID').attr('name', 'InitialPMCID');
    // activate the radio button
    $('#PMCID_' + a_PaymentMethodID).attr('checked', 'checked');
    $('.PMCID_Icon_Container').css('background-color', '');
    // handle services
    for (var i = 0; i < g_Services.length; i++) {
      if (typeof g_Prices[g_Services[i]][a_PaymentMethodID] === 'undefined' /*|| g_Prices[g_Services[i]][a_PaymentMethodID].indexOf("NoValidPrice") >= 0*/) {
        // deactivate the service
        // note: the radio button can not be disabled or we will receive the wrong error message
        $('#ServiceID_NotAllowed_' + g_Services[i]).show();
        // set the price
        $('#PD_' + g_Services[i]).html('---');
        //console.log('## deactivate service #' + g_Services[i] + '# #' + i + '# ##');
      } else {
        // activate the service
        // set the price
        $('#PD_' + g_Services[i]).html(g_Prices[g_Services[i]][a_PaymentMethodID]);
        $('#ServiceID_NotAllowed_' + g_Services[i]).hide();
        //console.log('## activate service #' + g_Services[i] + '# #' + i + '# ##');
      }
    }
    // activate and mark the selected icon
    $('.PMCID_Icon_Selected').css('background-image', '');
    $('#PMCID_Icon_Selected_' + a_PaymentMethodID).css('background-image', 'url(' + JS_DIR_IMAGES + 'payment/pmcid_icon_selected.png)');
    return;
  }

  function MouseOverPMCID(a_PMCID)
  {
    //console.log('# MouseOverPMCID(' + a_PMCID + ') #');
    $('#PMCID_Icon_Over_' + a_PMCID).css('background-image', 'url(' + JS_DIR_IMAGES + 'payment/pmcid_icon_over.png)');
  }

  function MouseOutPMCID(a_PMCID)
  {
    //console.log('# MouseOutPMCID(' + a_PMCID + ') #');
    $('#PMCID_Icon_Over_' + a_PMCID).css('background-image', '');
  }


  function MouseOverServiceID(a_ServiceID, a_ServiceCategoryID)
  {
    // console.log('# MouseOverServiceID(' + a_ServiceID + ') #');
    $('#ServiceID_Icon_Over_' + a_ServiceID).css('background-image', 'url(' + JS_DIR_IMAGES + 'payment/serviceid_icon_over.png)');
    if (a_ServiceCategoryID == g_QF_Mounts_ServiceCategoryID || a_ServiceCategoryID == g_QF_Outfits_ServiceCategoryID) {
      $('#ServiceID_Icon_Animation_1_' + a_ServiceID).show();
      $('#ServiceID_Icon_New_' + a_ServiceID).hide();
    }
  }

  function MouseOutServiceID(a_ServiceID, a_ServiceCategoryID)
  {
    // console.log('# MouseOutServiceID(' + a_ServiceID + ') #');
    $('#ServiceID_Icon_Over_' + a_ServiceID).css('background-image', '');
    // mounts have an animation
    if ((a_ServiceCategoryID == g_QF_Mounts_ServiceCategoryID || a_ServiceCategoryID == g_QF_Outfits_ServiceCategoryID) && ($('#ServiceID_' + a_ServiceID).attr('checked') != 'checked')) {
      $('#ServiceID_Icon_Animation_1_' + a_ServiceID).hide();
      $('#ServiceID_Icon_New_' + a_ServiceID).show();
    }
  }