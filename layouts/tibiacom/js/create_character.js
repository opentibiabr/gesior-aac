/**
 * @fileoverview JS functions for the dynamic part of the character creation page
 */

var ServerList = new Array();
var Options = new Array();
var PreselectWorld = '';

/**
 * For Internet Explorer returns its major version number, for all other browsers returns null
 * 
 * Note that IE8 supports browsing in backwards compatibility mode, in which case it will be detected as IE7.
 */
function GetIEVersion()
{
  UserAgent = window.navigator.userAgent;
  MSIE = UserAgent.indexOf("MSIE ");
  if (MSIE > 0) {
    return parseInt(UserAgent.substring(MSIE + 5, UserAgent.indexOf(".", MSIE)));
  } else {
    return null;
  }
}

/**
 * Initializes the JS-based part of the character creation page, should be called directly after page load
 */
function InitializeCharacterCreator(PreselectServerType, PreselectServerLocation, PreselectPvP)
{
  // dynamically generated radio buttons are broken in IE7 and lower, so we use the default
  // static server list
  IEVersion = GetIEVersion();
  if (IEVersion !== null && IEVersion < 7) {
    return;
  }

  // hide the default static server list, the inputs will still be there but
  // it's ok since none of them are selected
  document.getElementById("plain_world_box").style.display = "none";

  // show the JS-based server filters
  if (document.getElementById('filterbox_servertype') != null) {
    document.getElementById("filterbox_servertype").style.display = "";
  }
  document.getElementById("filterbox_location").style.display = "";
  document.getElementById("filterbox_pvp").style.display = "";

  // find the filter options to be activated
  var PreselectPvP = 'optional';
  var PreselectServerType = 'REG';
  if (PreselectWorld.length > 0) {
    var Server = GetServerByName(PreselectWorld);
    if (Server != null) {
      PreselectServerLocation = Server[1];
      PreselectPvP = Server[2];
      if (Server[3] == 0) {
        PreselectServerType = 'REG';
      } else {
        PreselectServerType = 'DEV';
      }
    }
  } else {
    PreselectWorld = undefined;
  }
  // activate filter options
  if (document.getElementById('filterbox_servertype') != null) {
    document.getElementById(GetFilterOptionId('server_type', PreselectServerType)).checked = 'checked';
  }
  document.getElementById(GetFilterOptionId('server_location', PreselectServerLocation)).checked = 'checked';
  document.getElementById(GetFilterOptionId('server_pvp_type', PreselectPvP)).checked = 'checked';

  // generate the full dynamic server list
  UpdateServerList(PreselectWorld);
}

/**
 * Generates the ID for a filter option radio button, calling this function repeatedly with the same parameters will result in the same ID
 */
function GetFilterOptionId(GroupID, Name)
{
  return 'option_' + GroupID + '_' + Name;
}

/**
 * Generates the ID for a server radio button, calling this function repeatedly with the same parameters will result in the same ID
 */
function GetServerOptionId(WorldName)
{
  return 'server_' + WorldName;
}

/**
 * Inserts a filter option(represented by a radio button) at the current position in the document
 */
function CreateFilterOption(GroupID, Value, Label)
{
  OptionID = GetFilterOptionId(GroupID, Value);
  OptionData = new Object();
  OptionData.GroupID = GroupID;
  OptionData.Value = Value;
  Options[OptionID] = OptionData;
  document.write('<div class="OptionContainer"><label for="' + OptionID + '">');
  if (GroupID == 'server_pvp_type') {
    document.write('<img class="PVPTypeIcon" src="' + JS_DIR_IMAGES + 'account/' + OptionID + '.gif" alt="Server PVP Type" /><br/>');
    // } else if (GroupID == 'server_location' && Name != 'all') {
    // document.write('<img class="WorldLocationIcon" src="' + JS_DIR_IMAGES + 'global/content/flag_' + Name + '.gif" alt="World Location" /><br/>');
  }
  document.write('<input type="radio" name="' + GroupID + '" id="' + OptionID + '" onClick="UpdateServerList()" />' + Label + '</label></div>');
}

/**
 * Returns the name of the currently selected filter option from the specified group
 */
function GetActiveFilterOption(GroupID)
{
  for ( var key in Options) {
    if (Options[key].GroupID == GroupID && document.getElementById(key).checked) {
      return Options[key].Value;
    }
  }
  return '';
}

/**
 * Selects the world with the specified name, if it is in the current server list
 */
function SelectWorld(World)
{
  var Option = document.getElementById(GetServerOptionId(World));
  if (Option != null) {
    Option.checked = 'checked';
    if (document.getElementById('suggested_world_div') != null) {
      var SuggestedWorldDiv = document.getElementById('suggested_world_div');
      SuggestedWorldDiv.innerHTML = World;
    }
  }
}

/**
 * Randomly selects one of the worlds that match the currently active filter criteria
 * 
 * @return
 */
function SelectRandomWorld()
{
  var AvailableServers = GetSelectableServers();
  var RandomServerIndex = Math.floor(Math.random() * (AvailableServers.length));
  if (RandomServerIndex < 0 || RandomServerIndex > AvailableServers.length)
    RandomServerIndex = 0; // just to be sure...
  SelectWorld(AvailableServers[RandomServerIndex]);
}

/**
 * Removes all servers from the list
 */
function ClearServerList()
{
  WorldsBox = document.getElementById("world_list_tr");

  while (WorldsBox.firstChild != null) {
    WorldsBox.removeChild(WorldsBox.firstChild);
  }
}

/**
 * Returns an array with the names of all servers that match the currently active filter criteria
 */
function GetSelectableServers()
{
  var ServerTypeButton = 'REG';
  if (document.getElementById('filterbox_servertype') != null) {
    ServerTypeButton = GetActiveFilterOption("server_type");
  }
  var LocationButton = GetActiveFilterOption("server_location");
  var PvpTypeButton = GetActiveFilterOption("server_pvp_type");

  // compile the list of servers matching the criteria
  MatchedServers = new Array();
  for ( var key in ServerList) {
    if (ServerTypeButton == 'REG' && ServerList[key][3] == 0) {
      if ((LocationButton == ServerList[key][1] || LocationButton == 'all') && (PvpTypeButton == ServerList[key][2] || PvpTypeButton == 'all')) {
        MatchedServers.push(ServerList[key][0]);
      }
    } else if (ServerTypeButton == 'DEV' && ServerList[key][3] > 0) {
      if ((LocationButton == ServerList[key][1] || LocationButton == 'all')) {
        MatchedServers.push(ServerList[key][0]);
      }
    }
  }
  return MatchedServers;
}

/**
 * Returns the string describing the PvP type of the specified server
 */
function GetServerByName(ServerName)
{
  for ( var Index in ServerList) {
    if (ServerList[Index][0] == ServerName) {
      return ServerList[Index];
    }
  }
  return null;
}

/**
 * Populates server list with the servers matching filter criteria the list will be automatically split in several columns for better readability
 */
function UpdateServerList(PreselectWorld)
{
  ClearServerList();

  var MatchedServers = GetSelectableServers();
  if (MatchedServers.length > 0) {
    WorldsBox.disabled = '';
  }

  var MAX_NUM_COLUMNS = 4;
  var MAX_ONE_COLUMN_LENGTH = 5;
  var NumServers = MatchedServers.length;
  var NumColumns;
  var NumRows;

  // how many columns do we need?
  if (Math.floor(NumServers / MAX_ONE_COLUMN_LENGTH) <= MAX_NUM_COLUMNS) {
    NumColumns = Math.ceil(NumServers / MAX_ONE_COLUMN_LENGTH);
    NumRows = MAX_ONE_COLUMN_LENGTH;
  } else {
    NumColumns = MAX_NUM_COLUMNS;
    NumRows = Math.ceil(NumServers / NumColumns);
  }

  for (var Col = 0; Col < NumColumns; ++Col) {
    // create columns
    TableCell = document.createElement('td');
    TableCell.setAttribute('style', 'border-style: none');
    TableCell.align = 'center';
    WorldsBox.appendChild(TableCell);
    // create one radio button for each server
    for (var Row = 0; Row < NumRows; ++Row) {
      var ServerIndex = Row + Col * NumRows;
      if (ServerIndex < NumServers) {
        var Radio = '<input type="radio" name="world" id="' + GetServerOptionId(MatchedServers[ServerIndex]) + '" value="' + GetServerOptionId(MatchedServers[ServerIndex]) + '" /> ';// <label for="' + OptionID + '">' + Label + '</label></div>';
        var Label = '<label for="' + GetServerOptionId(MatchedServers[ServerIndex]) + '" >' + MatchedServers[ServerIndex] + '</label>';
        var AdditionalInfo = '';
        var Additional = GetServerByName(MatchedServers[ServerIndex]);
        var l_AdditionalInfoDiv = '';
        if (Additional[3] > 0) {
          var l_AdditionalInfoImage = '<img style="border:0px;" src="' + JS_DIR_IMAGES + 'global/content/info.gif" alt="special offer" />';
          var l_AdditionalInfoHeadline = '<b>Preview game world:</b>';
          l_AdditionalInfoText += '<p>';
          var l_AdditionalInfoText = 'Preview phase active: ';
          if (Additional[3] == 1) {
            l_AdditionalInfoText += '<b>No</b>';
          } else if (Additional[3] == 2) {
            l_AdditionalInfoText += '<b>Yes</b><br/>';
            l_AdditionalInfoText += '(' + decodeURI(Additional[4]) + ')';
          }
          l_AdditionalInfoText += '</p>';
          l_AdditionalInfoDiv = '<div style="position:relative;float:right;top:0px;" >' + BuildHelperDivLink('dummy', l_AdditionalInfoImage, l_AdditionalInfoHeadline, l_AdditionalInfoText, 'previewserver');
          +'</div>';
        }
        var RadioDiv = '<div style="width: 10em; position: relative; text-align: left;" >' + Radio + Label + l_AdditionalInfoDiv + '</div>';
        TableCell.innerHTML += RadioDiv;
      } else {
        // fill up the empty space in the last column with invisible placeholders
        TableCell.innerHTML += "\u00A0" + '<br />';
      }
    }
  }

  if (PreselectWorld != undefined) {
    SelectWorld(PreselectWorld);
  } else {
    SelectRandomWorld();
  }

  // hide pvp type option for develepment servers
  if (document.getElementById('filterbox_servertype') != null) {
    if (document.getElementById('option_server_type_DEV').checked == true) {
      document.getElementById('filterbox_pvp').style.display = 'none';
      document.getElementById('development_server_warning').style.display = 'block';
    } else {
      document.getElementById('filterbox_pvp').style.display = 'block';
      document.getElementById('development_server_warning').style.display = 'none';
    }
  }
}

function OpenSuggestNameWindow()
{
  // window.name = "CreateNewAccountSource";
  // alert(window.name);
  window.open(JS_DIR_ACCOUNT + "content/newaccount/suggestname.php?subtopic=subscription", "SuggestName", "width=580px, height=480px, scrollbars=yes");

}