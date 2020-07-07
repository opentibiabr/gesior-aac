/**
 * ------------------------------------------------------------------ JavaScripts which are loaded by the OnLoad function of the body tag -------------------------------------------------------------------
 */

// executes JavaScripts for the loginbox and the menu
function InitializePage() {
    LoadLoginBox();
    LoadMenu();
    console.log("%cEspere! Este local é apenas para desenvolvedores. Seu ip foi registrado em nosso banco de dados para averiguação! Caso não tenha autorização você pode ser banido de nosso site. ", "color: red; font-size: x-large");
}

// remove the deactivation container from the website
function ActivateWebsiteFrame() {
    g_Deactivated = false;
    if (document.getElementById('DeactivationContainer') != null) {
        document.getElementById('DeactivationContainer').style.display = "none";
    }
    if (document.getElementById('DeactivationContainerThemebox') != null) {
        document.getElementById('DeactivationContainerThemebox').style.display = "none";
    }
}

// remove the deactivation container from the website
function DeactivateWebsiteFrame() {
    if (document.getElementById('DeactivationContainer') != null) {
        document.getElementById('DeactivationContainer').style.display = "block";
    }
    if (document.getElementById('DeactivationContainerThemebox') != null) {
        document.getElementById('DeactivationContainerThemebox').style.display = "block";
    }
}

// functions for mouse-over and click events of non-content-buttons
function MouseOverBigButton(source) {
    if (source.firstChild.style) {
        source.firstChild.style.visibility = "visible";
    }
}

function MouseOutBigButton(source) {
    if (source.firstChild.style) {
        source.firstChild.style.visibility = "hidden";
    }
}

// functions for mouse-over and click events of medium non-content-buttons
function MouseOverMediumButton(source) {
    if (source.firstChild.style) {
        source.firstChild.style.visibility = "visible";
    }
}

function MouseOutMediumButton(source) {
    if (source.firstChild.style) {
        source.firstChild.style.visibility = "hidden";
    }
}

// functions for mouse-over and click events of medium non-content-buttons
function MouseOverMediumButton(source) {
    if (source.firstChild.style) {
        source.firstChild.style.visibility = "visible";
    }
}

function MouseOutMediumButton(source) {
    if (source.firstChild.style) {
        source.firstChild.style.visibility = "hidden";
    }
}

// function for Forum-Management
function CheckAll(form_name, checkbox_name) {
    var form = document.getElementById(form_name);
    if (form.ALL) {
        var c = form.ALL.checked;
    }
    for (var i = 0; i < form.elements.length; i++) {
        var e = form.elements[i];
        if (e.name !== checkbox_name)
            continue;
        e.checked = c;
    }
}

/**
 * --------------------- Loginbox functionality ----------------------
 */

// initialisation of the loginbox status by the value of the variable
// 'loginStatus' which is provided to the HTML-document by PHP in the file
// 'header.inc'
function LoadLoginBox() {
    if (loginStatus === "false") {
        document.getElementById('PlayNowContainer').childNodes[0].childNodes[1].childNodes[1].src = JS_DIR_IMAGES + "global/buttons/mediumbutton_playnow.png";
        document.getElementById('LoginstatusText_1').style.backgroundImage = "url('" + JS_DIR_IMAGES + "global/loginbox/loginbox-font-create-account.gif')";
        document.getElementById('LoginstatusText_2').style.backgroundImage = "url('" + JS_DIR_IMAGES + "global/loginbox/loginbox-font-create-account-over.gif')";
    } else {
        document.getElementById('PlayNowContainer').childNodes[0].childNodes[1].childNodes[1].src = JS_DIR_IMAGES + "global/buttons/mediumbutton_myaccount.png";
        document.getElementById('LoginstatusText_1').style.backgroundImage = "url('" + JS_DIR_IMAGES + "global/loginbox/loginbox-font-logout.gif')";
        document.getElementById('LoginstatusText_2').style.backgroundImage = "url('" + JS_DIR_IMAGES + "global/loginbox/loginbox-font-logout-over.gif')";
    }
}

// mouse-over and click events of the loginbox
function MouseOverLoginBoxText(source) {
    source.lastElementChild.style.visibility = "visible";
    source.firstElementChild.style.visibility = "hidden";
}

function MouseOutLoginBoxText(source) {
    source.firstElementChild.style.visibility = "visible";
    source.lastElementChild.style.visibility = "hidden";
}

function LoginButtonAction() {
    if (loginStatus === "false") {
        window.location = "?subtopic=accountmanagement";
    } else {
        window.location = "?subtopic=accountmanagement";
    }
}

function LoginstatusTextAction(source) {
    if (loginStatus === "false") {
        window.location = "?subtopic=createaccount";
    } else {
        window.location = "?subtopic=accountmanagement&action=logout";
    }
}

/**
 * ------------------ Menu functionality ------------------
 */

/*
 * useful code for debugging: var temp; for(menuItemName in menu[0]) { temp += menu[0][menuItemName]; temp += " "; alert(menu[0][menuItemName] + " " + menuItemName); }
 */

/**
 * LOAD and SAVE the menu status by using arrays and the variable "self.name" which is a consistent JavaScript variable and allows to pass its values from the source page to the destination page
 *
 * "self.name" has the following format in this document: [menuname]=[value]&[menuname]=[value]& [...] & news=1&abouttibia=0&gameguides=0&library=0&community=0&forum=0&account=0&support=0&
 *
 * the variable 'unloadhelper' is used because IE needs the event OnBeforeUnload() and all other browsers OnUnload()
 */

var menu = [];
menu[0] = {};
var unloadhelper = false;
var menuItemName = '';

// load the menu and set the active submenu item by using the variable
// 'activeSubmenuItem' (provided to HTML-document by PHP in the file
// 'header.inc'
function LoadMenu() {
    if(document.getElementById("submenu_" + activeSubmenuItem)){
        document.getElementById("submenu_" + activeSubmenuItem).style.color = "white";
    }
    if(document.getElementById("ActiveSubmenuItemIcon_" + activeSubmenuItem)){
        document.getElementById("ActiveSubmenuItemIcon_" + activeSubmenuItem).style.visibility = "visible";
    }
    if (self.name.lastIndexOf("&") === -1) {
        self.name = "news=1&community=0&forum=0&account=0&library=0&wars=0&events=0&support=0&shop=0&";
    }
    FillMenuArray();
    InitializeMenu();
}

function SaveMenu() {
    if (unloadhelper === false) {
        SaveMenuArray();
        unloadhelper = true;
    }
}

// parse the values of the variable 'self.name' and store it in the array menu
// ATTENTION:
// if the user navigates from our website to another website which modifies
// self.name and returns to our page via the browsers back button
// our website receives the modified self.name value
function FillMenuArray() {
    var MenuCount = 0;
    var mark1 = 0;
    var mark2 = 0;
    while (self.name.length > 0) {
        MenuCount++;
        mark1 = self.name.indexOf("=");
        mark2 = self.name.indexOf("&");
        // abort parsing of self.name when:
        // - a maximum 15 main menu points are parsed (our website uses currently
        // (16.06.2010) 10 main menu points)
        // - no more "=" or "&" characters are found in the string
        // - the string was parsed completely
        if (MenuCount > 15 || mark1 < 0 || mark2 < 0)
            break;
        menuItemName = self.name.substr(0, mark1);
        menu[0][menuItemName] = self.name.substring(mark1 + 1, mark2);
        self.name = self.name.substr(mark2 + 1, self.name.length);
    }
}

// hide or show the corresponding submenus
function InitializeMenu() {
    for (menuItemName in menu[0]) {
        if (menu[0][menuItemName] === "0") {
            if(document.getElementById(menuItemName + "_Submenu")){
                document.getElementById(menuItemName + "_Submenu").style.visibility = "hidden";
                document.getElementById(menuItemName + "_Submenu").style.display = "none";
            }
            if(document.getElementById(menuItemName + "_Lights")){
                document.getElementById(menuItemName + "_Lights").style.visibility = "visible";
            }
            if(document.getElementById(menuItemName + "_Extend")){
                document.getElementById(menuItemName + "_Extend").style.backgroundImage = "url(" + JS_DIR_IMAGES + "global/general/plus.gif)";
            }
        } else {
            if(document.getElementById(menuItemName + "_Submenu")){
                document.getElementById(menuItemName + "_Submenu").style.visibility = "visible";
                document.getElementById(menuItemName + "_Submenu").style.display = "block";
            }
            if(document.getElementById(menuItemName + "_Lights")){
                document.getElementById(menuItemName + "_Lights").style.visibility = "hidden";
            }
            if(document.getElementById(menuItemName + "_Extend")){
                document.getElementById(menuItemName + "_Extend").style.backgroundImage = "url(" + JS_DIR_IMAGES + "global/general/minus.gif)";
            }
        }
    }
    var OpennedMenu =  $('#submenu_'+activeSubmenuItem)[0].dataset['menu'];
    if(menu[0][OpennedMenu] === '0'){
        MenuItemAction(OpennedMenu);
    }
}

// reconstruct the variable "self.name" out of the array menu
function SaveMenuArray() {
    var stringSlices = "";
    var temp = "";
    for (menuItemName in menu[0]) {
        stringSlices = menuItemName + "=" + menu[0][menuItemName] + "&";
        temp = temp + stringSlices;
    }
    self.name = temp;
}

// onClick open or close submenus
function MenuItemAction(sourceId) {
    if (menu[0][sourceId] === '1') {
        CloseMenuItem(sourceId);
    } else {
        $.each(menu[0], function (index, value) {
            if(value === '1'){
                CloseMenuItem(index);
            }
        });
        OpenMenuItem(sourceId);
    }
}

function OpenMenuItem(sourceId) {
    menu[0][sourceId] = '1';
    document.getElementById(sourceId + "_Submenu").style.visibility = "visible";
    document.getElementById(sourceId + "_Extend").style.backgroundImage = "url(" + JS_DIR_IMAGES + "global/general/minus.gif)";
    document.getElementById(sourceId + "_Lights").style.visibility = "hidden";
    $('#'+sourceId+'_Submenu').slideDown('slow');
    //document.getElementById(sourceId + "_Submenu").style.display = "block";
    //document.getElementById(sourceId + "_Lights").style.visibility = "hidden";
    //document.getElementById(sourceId + "_Extend").style.backgroundImage = "url(" + JS_DIR_IMAGES + "global/general/minus.gif)";
}

function CloseMenuItem(sourceId) {
    menu[0][sourceId] = '0';
    document.getElementById(sourceId + "_Lights").style.visibility = "visible";
    document.getElementById(sourceId + "_Extend").style.backgroundImage = "url(" + JS_DIR_IMAGES + "global/general/plus.gif)";
    $('#'+sourceId+'_Submenu').slideUp('fast', function () {
        // document.getElementById(sourceId + "_Submenu").style.visibility = "hidden";
    });
    //document.getElementById(sourceId + "_Submenu").style.visibility = "hidden";
    //document.getElementById(sourceId + "_Submenu").style.display = "none";
    //document.getElementById(sourceId + "_Lights").style.visibility = "visible";
    //document.getElementById(sourceId + "_Extend").style.backgroundImage = "url(" + JS_DIR_IMAGES + "global/general/plus.gif)";
}

// mouse-over effects of menubuttons and submenuitems
function MouseOverMenuItem(source) {
    if(source.firstChild.style){
        source.firstChild.style.visibility = "visible";
    }
}

function MouseOutMenuItem(source) {
    if(source.firstChild.style){
        source.firstChild.style.visibility = "hidden";
    }
}

function MouseOverSubmenuItem(source) {
    if(source.style){
        source.style.backgroundColor = "#14433F";
    }
}

function MouseOutSubmenuItem(source) {
    if(source.style){
        source.style.backgroundColor = "#0D2E2B";
    }
}

// display payment standby message
function PaymentStandBy(a_Source, a_Case) {
    var m_Agree = false;
    if (a_Source === "setup" && a_Case !== 1) {
        if (document.getElementById("CheckBoxAgreePayment").checked === true) {
            m_Agree = true;
        }
    }
    if (a_Source === "setup" && a_Case === 1) {
        if (document.getElementById("CheckBoxAgreePayment").checked === true && document.getElementById("CheckBoxAgreeSubscription").checked === true) {
            m_Agree = true;
        }
    }
    if (a_Source === "cancel") {
        m_Agree = true;
    }
    if (m_Agree === true) {
        document.getElementById("Step4MinorErrorBox").style.visibility = "hidden";
        document.getElementById("Step4MinorErrorBox").style.display = "none";
        document.getElementById("DisplayText").style.visibility = "hidden";
        document.getElementById("DisplayText").style.display = "none";
        document.getElementById("StandByMessage").style.visibility = "visible";
        document.getElementById("StandByMessage").style.display = "block";
        document.getElementById("DisplaySubmitButton").style.visibility = "hidden";
        document.getElementById("DisplaySubmitButton").style.display = "none";
        document.getElementById("DisplayBackButton").style.visibility = "hidden";
        document.getElementById("DisplayBackButton").style.display = "none";
    }
}

/**
 * ------------------ Exit Point Analysis -------------------
 */

// identify windows or linux client download
function NoteDownload(a_ClientType) {
    parent.confirmclient.location = JS_DIR_ACCOUNT + 'downloadaction.php?clienttype=' + a_ClientType;
}

/**
 * ------------------------- functions related to forms --------------------------
 */

// set cursor focus in form (g_FormName) to field (g_FieldName)
function SetFormFocus() {
    if (g_FormName.length > 0 && g_FieldName.length > 0) {
        var l_SetFocus = true;
        if (g_FormName === 'AccountLogin') {
            if (document.getElementsByName('loginname')[0].value.length > 0) {
                l_SetFocus = false;
            }
        }
        if (l_SetFocus === true) {
            document.forms[g_FormName].elements[g_FieldName].focus();
        }
    }
}

// set cursor focus in form (a_FormName) to field (a_FieldName)
function SetFormFocusToArguments(a_FormName, a_FieldName) {
    if (a_FormName.length > 0 && a_FieldName.length > 0) {
        document.forms[a_FormName].elements[a_FieldName].focus();
        document.forms[a_FormName].elements[a_FieldName].focus();
        document.forms[a_FormName].elements[a_FieldName].focus();
        document.forms[a_FormName].elements[a_FieldName].blur();
        document.forms[a_FormName].elements[a_FieldName].blur();
        document.forms[a_FormName].elements[a_FieldName].blur();
    }
}

// toggle masked texts with readable texts
function ToggleMaskedText(a_TextFieldID) {
    m_DisplayedText = document.getElementById('Display' + a_TextFieldID).innerHTML;
    m_MaskedText = document.getElementById('Masked' + a_TextFieldID).innerHTML;
    m_ReadableText = document.getElementById('Readable' + a_TextFieldID).innerHTML;
    if (m_DisplayedText === m_MaskedText) {
        document.getElementById('Display' + a_TextFieldID).innerHTML = document.getElementById('Readable' + a_TextFieldID).innerHTML;
        document.getElementById('Button' + a_TextFieldID).src = JS_DIR_IMAGES + 'global/general/hide.gif';
    } else {
        document.getElementById('Display' + a_TextFieldID).innerHTML = document.getElementById('Masked' + a_TextFieldID).innerHTML;
        document.getElementById('Button' + a_TextFieldID).src = JS_DIR_IMAGES + 'global/general/show.gif';
    }
}

// deactivate the deactivation container when the create account form which is
// activated if a website visitor arrives from the landing page
function DisableDeactivationContainer() {
    // currently it is not desired to allow the deactivation of the container
    /*
     * document.getElementsByName('noframe')[0].value = 0; document.getElementById('DeactivationContainer').style.display = 'none'; document.getElementById('DeactivationContainerThemebox').style.display = 'none'; document.getElementById('ThemeboxesColumn').style.opacity = "1"; document.getElementById('ThemeboxesColumn').style.MozOpacity = "1";
     * document.getElementById('ThemeboxesColumn').filters.alpha.opacity = "1"; document.getElementById('ThemeboxesColumn').style.filter = "alpha(opacity=100); opacity: 1";
     */
}

function FormatDate(a_DateTimeStamp, a_Format) {
    l_Format = 'full';
    l_Date = new Date(a_DateTimeStamp);
    l_Output = l_Date.toString().substring(4);
    // console.log(l_Date);
    // console.log(l_Output);
    return l_Output;
}

// post redirect function using jQuery
function RedirectGET(a_Target) {
    window.location = a_Target;
}

// post paramter object that will be used for post redirects
// PostParameters["KEY"] = "VALUE";
var PostParameters = {};

// post redirect function using jQuery
function RedirectPOST(a_Target, a_ParameterArray) {
    $('<form />').hide().attr({
        method: "post",
        id: "RedirectForm"
    }).attr({
        action: a_Target
    }).append('<input type="submit" />').appendTo($("body"));

    $.each(a_ParameterArray, function (key, value) {
        //console.log(key + ": " + value);
        $('#RedirectForm').append($('<input />').attr("type", "hidden").attr({
            "name": key
        }).val(value));
    });
    $('#RedirectForm').submit();
}

// -----------------------------
// functionality for screenshots
// -----------------------------

// define variables
var g_CurrentScreenshot = 0;
var g_NumberOfScreenshots = 0;
var g_Screenshots = [];
var g_ScreenshotTexts = [];

// set a certain screenshot
function SetScreenshot(a_Number) {
    g_CurrentScreenshot = a_Number;
    // fade out the old screen shot
    $("#ScreenshotContainer").fadeTo("fast", 0, function () {
        // when animation is complete set the new screenshot to display
        $('#ScreenshotImage').attr('src', g_Screenshots[g_CurrentScreenshot].src);
        $('.ScreenshotTextRow').text(g_ScreenshotTexts[g_CurrentScreenshot]);
        // fade in the new screenshot
        $("#ScreenshotContainer").fadeTo("fast", 1, function () {
            // fade in animation is complete
        });
    });
}

// show the next screenshot
function ShowNextScreenshot() {
    g_CurrentScreenshot = (g_CurrentScreenshot + 1);
    if (g_CurrentScreenshot > g_NumberOfScreenshots) {
        g_CurrentScreenshot = 1;
    }
    SetScreenshot(g_CurrentScreenshot);
}

// show the previous screenshot
function ShowPreviousScreenshot() {
    g_CurrentScreenshot = (g_CurrentScreenshot - 1);
    if (g_CurrentScreenshot < 1) {
        g_CurrentScreenshot = g_NumberOfScreenshots;
    }
    SetScreenshot(g_CurrentScreenshot);
}

// show the light box with containing control elements and the screenshot
function ShowScreenshot(a_Number, a_NumberOfScreenshots) {
    g_NumberOfScreenshots = a_NumberOfScreenshots;
    g_CurrentScreenshot = a_Number;
    // show light box
    $("#LightBox").fadeTo("fast", 1, function () {
        // animation complete.
    });
    $("#LightBoxBackground").fadeTo("fast", 0.75, function () {
        // animation complete.
    });
    // set the screenshot
    SetScreenshot(a_Number);
}

// preload all screenshots
function PreloadScreenshots(a_NumberOfScreenshots) {
    for (i = 1; i <= a_NumberOfScreenshots; i++) {
        g_Screenshots[i] = new Image();
        g_Screenshots[i].src = JS_DIR_IMAGES + 'abouttibia/tibia_screenshot_' + i + '.png'
    }
}