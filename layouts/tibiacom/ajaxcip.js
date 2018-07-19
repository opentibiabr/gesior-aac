/*!
 * AJAX library of CipSoft GmbH
 * http://www.cipsoft.com
 *
 * requires jQuery library
 * http://jquery.com/
 */

$(document).ready(function(){
//  MyAjaxCipHistory = new AjaxCipHistory();
  
  $('body').live('mouseover', function(event){
    g_Event = event.originalEvent;
  });
  
  jQuery.ajaxSetup({
    beforeSend: function(a_XHR) {
      //Override the getResponseHeader function to get the same value in different Browsers
//      a_XHR.oldGetResponseHeader = a_XHR.getResponseHeader;
//      a_XHR.getResponseHeader = MyGetResponseHeader;
    },
    cache: false
  });
  
  //Get config parameters (either global config if available or otherwise default config)
  var l_DefaultConfig = {
    Target: null,
    Error: null
  };
  if (window.g_AjaxConfig === undefined) {
    g_AjaxConfig = l_DefaultConfig;
  } else {
    for(var l_Index in l_DefaultConfig)
    {
      if (g_AjaxConfig[l_Index] === undefined) {
        g_AjaxConfig[l_Index] = l_DefaultConfig[l_Index];
      }
    }
  }
  if (window.g_AjaxDefaultTarget === undefined) {
    g_AjaxDefaultTarget = null;
  }
  if (window.g_UseAjaxAttributes  === undefined) {
    g_UseAjaxAttributes = false;
  }
  
//  if (g_UseAjaxAttributes === true) {
    $('[ajaxcip=true]').live('click.AjaxCip', function(event){
      var l_Request = new AjaxCipRequest(event.currentTarget);
      l_Request.send();
      event.preventDefault();
    });
    
    //When opening a link with the middle mouse button, than append the ajax history (hash)
    $('a[ajaxcip=true]').live('mousedown.AjaxCip', function(event){
      if (event.which == 2) {
        event.target.href += location.hash;
      }
    });
//  }
  
  g_LastHash = location.hash;
  setInterval(function() {
    if (location.hash != g_LastHash) {
      g_LastHash = location.hash;
//      MyAjaxCipHistory.handleHistory();
    }
  }, 1000);
  
//  MyAjaxCipHistory.handleHistory();
});


/**
 * JavaScript Ajax Interface
 */
function SendAjaxCip(a_Parameters, a_Options)
{
  var l_Target = document;
  if (l_Target.attributes === null) {
    l_Target = document.body;
  }
  try {
    l_Target = g_Event.target;
  } catch(e){}
  var l_Request = new AjaxCipRequest(l_Target, a_Parameters, a_Options);
  l_Request.send();
  
  return l_Request;
}


AjaxCipParameters = function() {};


AjaxCipParameters.prototype = {
  initializeParameters: function() {
    this.m_Parameters = {};
    this.m_Parameters.DataType = null;
    this.m_Parameters.Target = null;
    this.m_Parameters.UpdateType = 0;
    this.m_Parameters.CreateHistoryEntry = null;
    
    this.m_Parameters.Template = null;
  },
  
  /**
   * Set the possible parameters
   */
  setParameters: function(a_Parameters) {
    if (a_Parameters !== undefined) {
      if (typeof(a_Parameters) == 'object') {
        for(var l_Index in a_Parameters)
        {
          if (typeof(a_Parameters[l_Index]) == 'string'
             || typeof(a_Parameters[l_Index]) == 'number'
             || typeof(a_Parameters[l_Index]) == 'boolean') {
            switch(l_Index) {
              case 'DataType':
              case 'Target':
              case 'UpdateType':
              case 'CreateHistoryEntry':
              case 'Template': 
              case 'Errors':
                this.m_Parameters[l_Index] = a_Parameters[l_Index];
                break;
            }
          }
        }
//      } else if (typeof(a_Options) == 'string') {
        
      }
    }
  }
};


/**
 * Ajax Request
 * @param string Url
 * @param string/map Parameter
 */
AjaxCipRequest = function(a_Element, a_Parameters, a_Options)
{
  //Variables
  this.m_AttributeLabels = {
    Parameters: {
      'ajaxcip_datatype': 'DataType',
      'ajaxcip_target': 'Target',
      'ajaxcip_updatetype': 'UpdateType',
      'ajaxcip_createhistoryentry': 'CreateHistoryEntry'
    },
    Options: {
      'ajaxcip_link': 'Link',
      'ajaxcip_method': 'Method',
      'ajaxcip_href': 'Href',
      'ajaxcip_postdata': 'PostData',
      'ajaxcip_error': 'Error',
        
      // Events
      'ajaxcip_beforesend': 'BeforeSend',
      'ajaxcip_aftersend': 'AfterSend',
      'ajaxcip_beforesuccess': 'BeforeSuccess',
      'ajaxcip_aftersuccess': 'AfterSuccess',
      'ajaxcip_beforehandle': 'BeforeHandle',
      'ajaxcip_afterhandle': 'AfterHandle',
      'ajaxcip_beforecomplete': 'BeforeComplete',
      'ajaxcip_aftercomplete': 'AfterComplete'
    }
  };
  this.m_Options = {};
  this.m_Element = a_Element;
  
  this.initializeOptions();
  this.m_Options.Href = $(this.m_Element).attr('href');
  if ($(this.m_Element).attr('type') == 'submit') {
    this.initializeByForm();
  }
  this.initializeParameters();
  this.setOptions({Error: g_AjaxConfig.Error}); //Set the defaults
  this.setOptions(this.getAttributeOptions());
  this.setOptions(a_Options);
  this.setParameters({Target: g_AjaxConfig.Target}); //Set defaults
  this.setParameters(this.getAttributeParameters()); //First parameters from attributes
  if (a_Parameters !== undefined) {
    this.setParameters(a_Parameters); //Second parameters from function (if it was called)
  }
  this.prepareEvents();
  this.m_Response = {};
  
  //Set the parent to handle event bubbling correctly
  this.parentNode = this.m_Element;
};

//Define the member
AjaxCipRequest.prototype = {
  initializeOptions: function() {
    this.m_Options.Link = null;
    this.m_Options.Method = 'GET';
    this.m_Options.Href = '';
    this.m_Options.PostData = '';
    
    // Events
    this.m_Options.BeforeSend = '';
    this.m_Options.AfterSend = '';
    this.m_Options.BeforeSuccess = '';
    this.m_Options.AfterSuccess = '';
    this.m_Options.BeforeHandle = '';
    this.m_Options.AfterHandle = '';
    this.m_Options.BeforeComplete = '';
    this.m_Options.AfterComplete = '';
  },
  
  prepareEvents: function() {
    var l_EventHandler = function(a_Event, a_Handler, a_Data) {
      try {
        if (typeof(a_Handler) == 'function') {
          var l_Params = [];
          for (var i in a_Data)
          {
            l_Params.push('a_Data[' + i + ']');
          }
          return eval('a_Handler(a_Event, ' + l_Params.join(',') + ');');
        }
        else if (typeof(a_Handler) == 'string') {
          return eval(a_Handler);
        }
      } catch(e) {
        
      }
    };
    
    if (this.m_Options.BeforeSend !== '') {
      $(this).bind('AjaxCipBeforeSend', l_EventHandler);
    }
    if (this.m_Options.AfterSend !== '') {
      $(this).bind('AjaxCipAfterSend', l_EventHandler);
    }
    if (this.m_Options.BeforeSuccess !== '') {
      $(this).bind('AjaxCipBeforeSuccess', l_EventHandler);
    }
    if (this.m_Options.AfterSuccess !== '') {
      $(this).bind('AjaxCipAfterSuccess', l_EventHandler);
    }
    if (this.m_Options.BeforeHandle !== '') {
      $(this).bind('AjaxCipBeforeHandle', l_EventHandler);
    }
    if (this.m_Options.AfterHandle !== '') {
      $(this).bind('AjaxCipAfterHandle', l_EventHandler);
    }
    if (this.m_Options.BeforeComplete !== '') {
      $(this).bind('AjaxCipBeforeComplete', l_EventHandler);
    }
    if (this.m_Options.AfterComplete !== '') {
      $(this).bind('AjaxCipAfterComplete', l_EventHandler);
    }
  },
  
  /**
   * Initialize the options by the form which surrounds the element
   */
  initializeByForm: function() {
    if (this.m_Element.form) {
      this.m_Form = this.m_Element.form;
    } else if ($(this.m_Element).parents('form').length > 0) {
      this.m_Form = $(this.m_Element).parents('form')[0];
    } else {
      return false;
    }
    this.setOptions({
      Method: this.m_Form.method.toUpperCase()
//      PostData: $(this.m_Form).serialize()
    });
    if (this.m_Options.Href == '' || typeof this.m_Options.Href == 'undefined') {
      this.setOptions({
        Href: $(this.m_Form).attr('action')
      });
    }
    
    if (this.m_Options.Method.toUpperCase() == 'GET') {
      var l_HrefParts = this.m_Options.Href.split('#');
      l_HrefParts[0] += '&amp;' + $(this.m_Form).serialize();
      this.m_Options.Href = l_HrefParts.join('#');
    } else if(this.m_Options.Method.toUpperCase() == 'POST') {
      this.m_Options.PostData = $(this.m_Form).serialize();
    }
  },
  
  /**
   * Returns an object with the parameters defined by attributes
   */
  getAttributeParameters: function() {
    var l_Parameters = {};
    for(var l_Index in this.m_AttributeLabels.Parameters)
    {
      var l_Value = $(this.m_Element).attr(l_Index);
      if (l_Value !== undefined) {
        l_Parameters[this.m_AttributeLabels.Parameters[l_Index]] = l_Value;
      }
    }
    
    return l_Parameters;
  },
  
  /**
   * Returns an object with the parameters defined by attributes
   */
  getAttributeOptions: function() {
    var l_Options = {};
    for(var l_Index in this.m_AttributeLabels.Options)
    {
      var l_Value = $(this.m_Element).attr(l_Index);
      if (l_Value !== undefined) {
        l_Options[this.m_AttributeLabels.Options[l_Index]] = l_Value;
      }
    }
    
    return l_Options;
  },
  
  /**
   * Set the possible options
   */
  setOptions: function(a_Options) {
    if (a_Options !== undefined) {
      if (typeof(a_Options) == 'object') {
        for(var l_Index in a_Options)
        {
          switch(l_Index) {
            case 'Link':
            case 'Method':
            case 'Href':
            case 'Error':
              if (typeof(a_Options[l_Index]) == 'string'
                || typeof(a_Options[l_Index]) == 'number'
                || typeof(a_Options[l_Index]) == 'boolean') {
                this.m_Options[l_Index] = a_Options[l_Index];
              }
              break;
            case 'BeforeSend':
            case 'AfterSend':
            case 'BeforeSuccess':
            case 'AfterSuccess':
            case 'BeforeHandle':
            case 'AfterHandle':
            case 'BeforeComplete':
            case 'AfterComplete':
              if (typeof(a_Options[l_Index]) == 'string'
                || typeof(a_Options[l_Index]) == 'function') {
                this.m_Options[l_Index] = a_Options[l_Index];
              }
              break;
            case 'PostData':
              if (typeof(a_Options[l_Index]) == 'string') {
                if (this.m_Options[l_Index] == '') {
                  this.m_Options[l_Index] = a_Options[l_Index];
                } else {
                  this.m_Options[l_Index] += '&' + a_Options[l_Index];
                }
              }
              break;
          }
        }
//      } else if (typeof(a_Options) == 'string') {
        
      }
    }
  },
  
  /**
   * Send the Ajax-Request
   */
  send: function() {
    $(this).trigger('AjaxCipBeforeSend', [this.m_Options.BeforeSend, [this]]);
    //jQuery ajax options
    var l_AjaxOptions = {
      url: this.m_Options.Href,
      success: function(a_Data, a_Status, a_XHR) {
        $(this).trigger('AjaxCipBeforeSuccess', [this.m_Options.BeforeSuccess, [a_Data, a_Status, a_XHR, this]]);
        
        this.m_Response = new AjaxCipResponse(this, a_XHR, a_Status);
        this.m_Response.handleResponse();
        AjaxCipBrowserHistory.createHistoryEntry(this);
        
        $(this).trigger('AjaxCipAfterSuccess', [this.m_Options.AfterSuccess, [a_Data, a_Status, a_XHR, this]]);
      },
      beforeSend: function(a_XHR) {
//        $(this).trigger('AjaxCipBeforeSend', [this.m_Options.BeforeSend, [a_XHR, this]]);

//        this.m_Options.Href = this.url;
        
        $(this).trigger('AjaxCipAfterSend', [this.m_Options.AfterSend, [a_XHR, this]]);
      },
      error: function(a_XHR, a_Status, a_Error) {
        if (typeof(this.m_Options.Error) == 'string' && typeof(window[this.m_Options.Error]) == 'function') {
          window[this.m_Options.Error](a_XHR, a_Status, [a_Error]);
        }
      },
      complete: function(a_XHR, a_Status) {
        $(this).trigger('AjaxCipBeforeComplete', [this.m_Options.BeforeComplete, [a_XHR, a_Status, this]]);
        //Perhaps, sometimes here will stay some code
        $(this).trigger('AjaxCipAfterComplete', [this.m_Options.AfterComplete, [a_XHR, a_Status, this]]);
      },
      dataFilter: function(data, type) {
        return data;
      },
      //dataType: "text",
      currentRequest: this,
      context: this,
      type: this.m_Options.Method
    };
    if (this.m_Options.Method.toUpperCase() == 'POST') {
      l_AjaxOptions.data = this.m_Options.PostData;
    }
    jQuery.ajax(l_AjaxOptions);
  }
};

//Extend
Extend(AjaxCipRequest, AjaxCipParameters);

/****************
 * Ajax Response
 ***************/
AjaxCipResponse = function(a_Request, a_XHR, a_TextStatus)
{
  this.m_Request = a_Request;
  this.m_XHR = a_XHR;
  this.m_TextStatus = a_TextStatus;
  //Set/Get headers
  this.m_ResponseType = this.getResponseType();//this.getResponseHeader('X-Ajax-Cip-Response-Type');
  var l_TempRequests = this.getResponseHeader('X-Ajax-Cip-Requests');
  this.m_Requests = (l_TempRequests !== null) ? l_TempRequests.split('#') : null;
  this.m_Data = this.m_XHR.responseText;
  
  this.initializeParameters();
  
  this.setParameters(this.m_Request.m_Parameters); //First use the parameters of the request
  
  //Set the parent to handle event bubbling correctly
  this.parentNode = this.m_Request;
};


AjaxCipResponse.prototype = {
  /**
   * Try to get the ResponseType
   */
  getResponseType: function() {
    var l_ResponseType = this.getResponseHeader('X-Ajax-Cip-Response-Type');
    if (l_ResponseType === null) {
      if (this.getResponseHeader('Content-Type') == 'application/json'      //Check ContentType
        || jQuery.trim(this.m_XHR.responseText).search(/^[{\[]/) !== -1) {  //Else check if it could be a json object
        try {
          var l_Object = jQuery.parseJSON(this.m_XHR.responseText);
          if (l_Object.AjaxObjects) {
            l_ResponseType = 'Container';
          } else {
            l_ResponseType = 'Single';
          }
        } catch (e) {}
      } else {
        l_ResponseType = 'Raw';
      }
    }
    
    return l_ResponseType;
  },
  
  /**
   * Try to get Requests
   */
  getRequests: function() {
    var l_Requests = this.getResponseHeader('X-Ajax-Cip-Requests');
    if (l_Requests === null && (this.m_RequestType == 'Single' || this.m_RequestType == 'Container')) {
      var l_Object = jQuery.parseJSON(this.m_XHR.responseText);
      if (l_Object.Requests) {
        l_Requests = l_Object.Requests;
      }
    }
    
    return l_Requests;
  },
  
  /**
   * Handles the Response by replacing data in the DOM or/and executing scripts
   */
  handleResponse: function() {
    $(this).trigger('AjaxCipBeforeHandle', [this.m_Request.m_Options.BeforeHandle, [this]]);
    
    if (this.m_Requests !== null && this.m_Requests.length > 0) {
      for (var i = 0; i < this.m_Requests.length; i++)
      {
        SendAjaxCip({}, {
          'Href': this.m_Requests[i]
        });
      }
    }
    //When ResponseType = Raw get the further parameters from the header
    if (this.m_ResponseType == 'Raw' || this.m_ResponseType === null) {
      this.setParameters({
        DataType:           this.getResponseHeader('X-Ajax-Cip-Data-Type'),
        Target:             this.getResponseHeader('X-Ajax-Cip-Target'),
        UpdateType:         this.getResponseHeader('X-Ajax-Cip-Update-Type'),
        CreateHistoryEntry: this.getResponseHeader('X-Ajax-Cip-Create-HistoryEntry')
      });
    } else if (this.m_ResponseType == 'Single') { //Else get the parameters from the object(s)
      var l_AjaxObject = {};
      if (typeof(this.m_Data) == 'string') {
        l_AjaxObject = jQuery.parseJSON(this.m_Data);
      } else {
        l_AjaxObject = this.m_Data;
      }
      this.setParameters(l_AjaxObject);
      this.m_Data = l_AjaxObject.Data;
      if(l_AjaxObject.Errors) {
        this.handleErrors(l_AjaxObject.Errors);
      }
    } else if (this.m_ResponseType == 'Container') {
      this.m_Container = jQuery.parseJSON(this.m_Data);
      if(this.m_Container.Errors) {
        this.handleErrors(this.m_Container.Errors);
      }
    }
    
    //When Container and it is the first call to this function,
    //than iterate over all contained objects and handle them
    if (this.m_ResponseType == 'Container') {
      for(var i in this.m_Container.AjaxObjects)
      {
        var l_Response = new AjaxCipResponse(this.m_Request, this.m_XHR, this.m_TextStatus);
        l_Response.m_Requests = null;
        l_Response.m_ResponseType = 'Single';
        l_Response.m_Data = this.m_Container.AjaxObjects[i];
        l_Response.handleResponse();
      }
    } else { //Handle a single object
      if (this.m_Data !== null) {
        switch(this.m_Parameters.DataType) {
          case 'HTML':
          case null:
            if (this.m_Parameters.Target !== null) {
              if (this.m_Parameters.CreateHistoryEntry === 'true' || this.m_Parameters.CreateHistoryEntry === true) {
                AjaxCipComponentHistoryContainer.add($(this.m_Parameters.Target));
                AjaxCipBrowserHistory.registerRequestElement(this.m_Request, $(this.m_Parameters.Target));
              }
              this.handleHTML();
            } else {
              //Nothing will be insert
            }
            break;
          case 'Attributes':
            if (this.m_Parameters.Target !== null) {
              if (this.m_Parameters.CreateHistoryEntry === 'true' || this.m_Parameters.CreateHistoryEntry === true) {
                AjaxCipComponentHistoryContainer.add($(this.m_Parameters.Target));
                AjaxCipBrowserHistory.registerRequestElement(this.m_Request, $(this.m_Parameters.Target));
              }
              this.handleAttributes();
            } else {
              //Nothing will be changed
            }
            break;
          case 'CSS':
            this.handleCSS();
            break;
          case 'JavaScript':
            try {
              this.handleJavaScript();
            } catch (e) {}
            break;
          case 'Template':
            if (this.m_Parameters.Target !== null && this.m_Parameters.Template !== null) {
              if (this.m_Parameters.CreateHistoryEntry === 'true' || this.m_Parameters.CreateHistoryEntry === true) {
                AjaxCipComponentHistoryContainer.add($(this.m_Parameters.Target));
                AjaxCipBrowserHistory.registerRequestElement(this.m_Request, $(this.m_Parameters.Target));
              }
              this.handleTemplate();
            } else {
              //Nothing will be insert
            }
            break;
        }
      }
    }
    
    $(this).trigger('AjaxCipAfterHandle', [this.m_Request.m_Options.AfterHandle, [this]]);
  },
  
  handleErrors: function(a_Errors) {
    window[this.m_Request.m_Options.Error](this.m_XHR, 'AjaxCipErrors', a_Errors);
  },
  
  /**
   * Get a specific response header. When not set, return null in all browsers.
   */
  getResponseHeader: function(a_Header) {
    var l_AllResponseHeaders = this.m_XHR.getAllResponseHeaders();
    if (l_AllResponseHeaders.search(new RegExp(a_Header)) === -1) {
      return null;
    }
    var l_HeaderValue = this.m_XHR.getResponseHeader(a_Header);
    return l_HeaderValue;
  }
};

//Extend
Extend(AjaxCipResponse, AjaxCipParameters);
//Extend(AjaxCipResponse, CipContentHandler);


/**
 * Override the getResponseHeader function to get the same value in different browsers.
 * The IE would return an empty string, when a header is not set instead of null.
 */
function MyGetResponseHeader(a_Header) {
  var l_AllResponseHeaders = this.getAllResponseHeaders();
  if (l_AllResponseHeaders.search(new RegExp(a_Header)) === -1) {
    return null;
  }
  var l_HeaderValue = this.oldGetResponseHeader(a_Header);
  return l_HeaderValue;
}


/**************
 * Ajax History
 *************/

/**
 * The Ajax History is splitted in two or rather three parts.
 * - Component history
 *   - AjaxCipHistoryComponent handles the history for a single component
 *   - AjaxCipComponentHistoryContainer handles the history for all registered components
 * - Browser History
 *   - Will handle the components history for the browser,
 *     to register changes to this history in the browser history
 */

/**
 * Handles the history of a component
 * The component have to be unique by an id
 */
AjaxCipHistoryComponent = function(a_TargetId, a_MaxEntries) {
  if (!a_TargetId || typeof(a_TargetId) != 'string' || this.exists()) {
    throw 'ParameterError';
  }
  this.m_TargetId = a_TargetId;
  this.m_Target = $('#' + a_TargetId);
  this.m_Entries = [];
  if(typeof(a_MaxEntries) != 'undefined' && isNaN(a_MaxEntries)) {
    this.setMaxEntries(a_MaxEntries);
  } else {
    this.m_MaxEntries = 10;
  }
  //Points to the entry which is currently viewed;
  //(!) when a new entry is added the current view is not in the list,
  //and the pointer points to an entry which do not exists
  this.m_CurrentIndex = 0;
  
  //Set the parent to handle event bubbling correctly
  this.parentNode = this.m_Target[0];
};

AjaxCipHistoryComponent.prototype = {
  exists: function(a_TargetId) {
    var l_TargetId = '';
    if (this.m_TargetId) {
      l_TargetId = this.m_TargetId;
    } else {
      l_TargetId = a_TargetId;
    }
    if($('#' + l_TargetId).length === 0) {
      return false;
    } else {
      return true;
    }
  },
  
  add: function() {
    $(this).trigger('BeforeAddHistoryComponentEntry');
    
    if(!this.exists()) {
      throw 'ElementNotExistsError';
    }
    this.m_Target = $('#' + this.m_TargetId);
    if ((this.m_Entries.length) === this.m_MaxEntries) {
      this.m_Entries.splice(0, 1);
    } else {
      ++this.m_CurrentIndex;
    }
    //clear the forward list
    var l_Factor = 0;
    if (this.m_Entries[this.m_CurrentIndex]) {
      this.m_Entries.splice(this.m_CurrentIndex, this.m_Entries.length - this.m_CurrentIndex);
      for (var i in this.m_Entries)
      {
        $(this.m_Entries[i]).remove();
        delete this.m_Entries[i];
      }
      l_Factor = -1;
    }
    this.m_Entries[this.m_Entries.length + l_Factor] = this.m_Target.realClone(true);
    $.cleanCache();
    
    $(this).trigger('AfterAddHistoryComponentEntry');
  },
  
  back: function() {
    $(this).trigger('BeforeBackHistoryComponentEntry');
    
    if(!this.exists()) {
      throw 'ElementNotExistsError';
    }
    this.m_Target = $('#' + this.m_TargetId);
    if (!this.m_Entries[this.m_CurrentIndex - 1]) {
      return false;
    }
    $(this.m_Entries[this.m_CurrentIndex]).remove();
    this.m_Entries[this.m_CurrentIndex] = this.m_Target.realClone(true);
    --this.m_CurrentIndex;
    var l_NewTarget = $(this.m_Entries[this.m_CurrentIndex]).realClone(true);
    this.m_Target.replaceWith(l_NewTarget);
    $.cleanCache();
    
    $(this).trigger('AfterBackHistoryComponentEntry');
  },
  
  forward: function() {
    $(this).trigger('BeforeForwardHistoryComponentEntry');
    
    if(!this.exists()) {
      throw 'ElementNotExistsError';
    }
    this.m_Target = $('#' + this.m_TargetId);
    if (this.m_Entries[this.m_CurrentIndex + 1] === undefined) {
      return false;
    }
    $(this.m_Entries[this.m_CurrentIndex]).remove();
    this.m_Entries[this.m_CurrentIndex] = this.m_Target.realClone(true);
    ++this.m_CurrentIndex;
    var l_NewTarget = $(this.m_Entries[this.m_CurrentIndex]).realClone(true);
    this.m_Target.replaceWith(l_NewTarget);
    $.cleanCache();
    
    $(this).trigger('AfterForwardHistoryComponentEntry');
  },
  
  jump: function(a_Index) {
    $(this).trigger('BeforeJumpHistoryComponentEntry');
    
    if(!this.exists()) {
      throw 'ElementNotExistsError';
    }
    this.m_Target = $('#' + this.m_TargetId);
    if (this.m_Entries[a_Index] === undefined) {
      return false;
    }
    $(this.m_Entries[this.m_CurrentIndex]).remove();
    this.m_Entries[this.m_CurrentIndex] = this.m_Target.realClone(true);
    this.m_CurrentIndex = a_Index;
    var l_NewTarget = $(this.m_Entries[this.m_CurrentIndex]).realClone(true);
    this.m_Target.replaceWith(l_NewTarget);
    $.cleanCache();
    
    $(this).trigger('AfterJumpHistoryComponentEntry');
  },
  
  clear: function() {
    $(this).trigger('BeforeClearHistoryComponentEntry');
    
    this.m_CurrentIndex = 0;
    for (var i in this.m_Entries)
    {
      $(this.m_Entries[i]).remove();
    }
    this.m_Entries = [];
    
    $(this).trigger('AfterClearHistoryComponentEntry');
  },
  
  setMaxEntries: function(a_MaxEntries) {
    if (typeof(a_MaxEntries) == 'number') {
      this.m_MaxEntries = a_MaxEntries;
      //Remove the oldest elements which are to much
      if (this.m_Entries.length > this.m_MaxEntries) {
        this.m_Entries.splice(0, this.m_Entries.length - this.m_MaxEntries);
      }
    }
  }
};

/**
 * Static Component History Container
 * It handles all components that are registered to be handled
 * The components to be handled have to be unique by an id
 */
AjaxCipComponentHistoryContainer = new (function() {
  this.m_MaxComponentEntries = 10;
  this.m_MaxEntries = 10;
  this.m_CurrentIndex = -1;
  this.m_GlobalHistory = [];
  this.m_Components = {};
  
  //Set the owner document to handle event bubbling correctly
  this.ownerDocument = document;
  
  this.add = function(a_ElementOrId) {
    try {
      var l_TargetId = this.getId(a_ElementOrId);
      this.addContainerEntry(l_TargetId, 'add');
      if (!this.m_Components[l_TargetId]) {
        this.m_Components[l_TargetId] = new AjaxCipHistoryComponent(l_TargetId, this.m_MaxComponentEntries);
        this.setMaxEntries(this.m_MaxComponentEntries);
      }
      this.m_Components[l_TargetId].add();
    } catch (e) {
      switch(e) {
        case 'NoId':
          break;
      }
      if(typeof(g_Error) == 'undefined'){g_Error = [];}
      g_Error.push(e);
    }
  };
  
  this.back = function(a_ElementOrId) {
    try {
      var l_TargetId = this.getId(a_ElementOrId);
      this.addContainerEntry(l_TargetId, 'back');
      if (!this.m_Components[l_TargetId]) {
        throw 'NoComponentHistory';
      }
      this.m_Components[l_TargetId].back();
    } catch (e) {
      switch(e) {
        case 'NoId':
          break;
        case 'NoComponentHistory':
          break;
      }
      if(typeof(g_Error) == 'undefined'){g_Error = [];}
      g_Error.push(e);
    }
  };
  
  this.forward = function(a_ElementOrId) {
    try {
      var l_TargetId = this.getId(a_ElementOrId);
      this.addContainerEntry(l_TargetId, 'forward');
      if (!this.m_Components[l_TargetId]) {
        throw 'NoComponentHistory';
      }
      this.m_Components[l_TargetId].forward();
    } catch (e) {
      switch(e) {
        case 'NoId':
          break;
        case 'NoComponentHistory':
          break;
      }
      if(typeof(g_Error) == 'undefined'){g_Error = [];}
      g_Error.push(e);
    }
  };
  
  this.jump = function(a_ElementOrId, a_Index) {
    try {
      var l_TargetId = this.getId(a_ElementOrId);
      this.addContainerEntry(l_TargetId, 'jump', this.m_Components[l_TargetId].m_CurrentIndex, a_Index);
      if (!this.m_Components[l_TargetId]) {
        throw 'NoComponentHistory';
      }
      this.m_Components[l_TargetId].jump(a_Index);
    } catch (e) {
      switch(e) {
        case 'NoId':
          break;
        case 'NoComponentHistory':
          break;
      }
    }
  };
  
  this.clear = function(a_ElementOrId) {
    try {
      var l_TargetId = this.getId(a_ElementOrId);
      if (!this.m_Components[l_TargetId]) {
        throw 'NoComponentHistory';
      }
      this.m_Components[l_TargetId].clear();
      for(var i = 0; i < this.m_GlobalHistory.length; i++) {
        if (this.m_GlobalHistory[i].TargetId == l_TargetId) {
          this.m_GlobalHistory.splice(i, 1);
          --i;
          if (i < this.m_CurrentIndex) {

            --this.m_CurrentIndex;
          }
        }
      }
    } catch (e) {
      switch(e) {
        case 'NoId':
          break;
        case 'NoComponentHistory':
          break;
      }
    }
  };
  
  this.addContainerEntry = function(a_TargetId, a_Operation, a_IndexFrom, a_IndexTo) {
    $(this).trigger('BeforeAddComponentHistoryContainerEntry');
    
    if ((this.m_GlobalHistory.length + 1) === this.m_MaxEntries) {
      this.m_GlobalHistory.splice(0, 1);
    } else {
      ++this.m_CurrentIndex;
    }
    
    if (a_Operation == 'add' || a_Operation == 'back' || a_Operation == 'forward') {
      this.m_GlobalHistory.push({
        'TargetId': a_TargetId,
        'Operation': a_Operation
      });
    } else if (a_Operation == 'jump') {
      this.m_GlobalHistory.push({
        'TargetId': a_TargetId,
        'Operation': a_Operation,
        'IndexFrom': a_IndexFrom,
        'IndexTo': a_IndexTo
      });
    }
    
    //clear the forward list
    if (this.m_GlobalHistory[this.m_CurrentIndex + 1]) {
      this.m_GlobalHistory.splice(this.m_CurrentIndex + 1, this.m_GlobalHistory.length - this.m_CurrentIndex + 1);
    }
    
    $(this).trigger('AfterAddComponentHistoryContainerEntry');
  };
  
  this.backContainer = function() {
    $(this).trigger('BeforeBackComponentHistoryContainerEntry');
    
    if (!this.m_GlobalHistory[this.m_CurrentIndex]) {
      return false;
    }
    
    var l_OperationObj = this.m_GlobalHistory[this.m_CurrentIndex];
    try {
      switch(l_OperationObj.Operation) {
        case 'add':
        case 'forward':
          this.m_Components[l_OperationObj.TargetId].back();
          break;
        case 'back':
          this.m_Components[l_OperationObj.TargetId].forward();
          break;
        case 'jump':
          this.m_Components[l_OperationObj.TargetId].jump(l_OperationObj.IndexFrom);
          break;
      }
      --this.m_CurrentIndex;
    } catch (e) {
      if(typeof(g_Error) == 'undefined'){g_Error = [];}
      g_Error.push(e);
      this.m_GlobalHistory.splice(this.m_CurrentIndex, 1);
      if (this.m_GlobalHistory.length > 0) {
        this.backContainer();
      } else {
        return false;
      }
    }
    
    $(this).trigger('AfterAddComponentHistoryContainerEntry');
  };
  
  this.forwardContainer = function() {
    $(this).trigger('BeforeForwardComponentHistoryContainerEntry');
    
    if (!this.m_GlobalHistory[this.m_CurrentIndex + 1]) {
      return false;
    }
    ++this.m_CurrentIndex;
    var l_OperationObj = this.m_GlobalHistory[this.m_CurrentIndex];
    try {
      switch(l_OperationObj.Operation) {
        case 'add':
        case 'forward':
          this.m_Components[l_OperationObj.TargetId].forward();
          break;
        case 'back':
          this.m_Components[l_OperationObj.TargetId].back();
          break;
        case 'jump':
          this.m_Components[l_OperationObj.TargetId].jump(l_OperationObj.IndexTo);
          break;
      }
    } catch (e) {
      this.m_GlobalHistory.splice(this.m_CurrentIndex, 1);
      if (this.m_GlobalHistory.length > this.m_CurrentIndex) {
        this.forwardContainer();
      } else {
        return false;
      }
    }
    
    $(this).trigger('AfterAddComponentHistoryContainerEntry');
  };
  
  this.getId = function(a_ElementOrId) {
    if (typeof(a_ElementOrId) == 'string') {
      var l_Matches = /(^#?(\w+|-)+)/.exec(a_ElementOrId);
      var l_Id = '';
      if (l_Matches && l_Matches[1]) {
        return l_Matches[1];
      } else {
        throw 'NoId';
      }
    } else if (typeof(a_ElementOrId) == 'object' && $(a_ElementOrId).attr('id').length > 0) {
      return $(a_ElementOrId).attr('id');
    } else {
      throw 'NoId';
    }
  };
  
  this.setMaxEntries = function(a_MaxEntries) {
    this.m_MaxComponentEntries = a_MaxEntries;
    var l_ComponentCount = 0;
    for(var i in this.m_Components)
    {
      ++l_ComponentCount;
    }
    this.m_MaxEntries = l_ComponentCount * a_MaxEntries;
    
    if (typeof(a_MaxEntries) == 'number') {
      for (var i in this.m_Components)
      {
        this.m_Components[i].setMaxEntries(a_MaxEntries);
      }
    }
  };
})();
//For Eclipse to show the class correct in the class tree
AjaxCipComponentHistoryContainer.prototype={};
delete AjaxCipComponentHistoryContainer.prototype;


/**
 * Static Browser History
 * It handles the browser history.
 * It recovers the website states when using the browser history buttons.
 * It recovers the states of bookmarkable addresses
 */
AjaxCipBrowserHistory = new (function() {
  //Dummies
  this.registerRequestElement = function(a_Request, a_Element) {};
  this.createHistoryEntry = function(a_Request) {};
})();
//For Eclipse to show the class correct in the class tree
AjaxCipBrowserHistory.prototype={};
delete AjaxCipBrowserHistory.prototype;


var CipContentHandler = function(a_Data, a_Parameters) {
  this.m_Data = null;
  if (a_Data && a_Parameters) {
    this.init(a_Data, a_Parameters);
  }
  else if (a_Data) {
    this.init(a_Data);
  }
};

CipContentHandler.prototype = {
  init: function(a_Data, a_Parameters) {
    if (a_Data) {
      this.m_Data = a_Data;
    }
    if (a_Parameters) {
      this.setParameters(a_Parameters);
    }
  },
  
  /**
   * Handles HTML Data (the way to insert it)
   */
  handleHTML: function() {
    switch(parseInt(this.m_Parameters.UpdateType)) {
      case 0: //Replace the inner content of the target
      case null:
        $(this.m_Parameters.Target).html(this.m_Data);
        break;
      case 1: //Replace the target
        $(this.m_Parameters.Target).replaceWith(this.m_Data);
        break;
      case 2: //Append to the inner content of the target
        $(this.m_Parameters.Target).append(this.m_Data);
        break;
      case 3: //Append to the target
        $(this.m_Parameters.Target).after(this.m_Data);
        break;
      case 4: //Prepend to the inner content of the target
        $(this.m_Parameters.Target).prepend(this.m_Data);
        break;
      case 5: //Prepend to the target
        $(this.m_Parameters.Target).before(this.m_Data);
        break;
    }
  },
  
  /**
   * Handle attributes (set Attributes)
   */
  handleAttributes: function() {
    var l_Attributes = {};
    if (typeof(this.m_Data) == 'object') {
      l_Attributes = this.m_Data;
    } else if (typeof(this.m_Data) == 'string') {
      var l_AttributesArr = decodeURIComponent(this.m_Data).split('&');
      for(var i in l_AttributesArr)
      {
        var l_AttributeKeyValuePair = l_AttributesArr[i].split('=');
        l_Attributes[l_AttributeKeyValuePair[0]] = l_AttributeKeyValuePair[1];
      }
    }
    $(this.m_Parameters.Target).attr(l_Attributes);
  },
  
  /**
   * Insert CSS statements in global context
   */
  handleCSS: function() {
    $('head').append(
      '<style type="text/css" media="screen" rel="stylesheet" title="AjaxCipStyle_' + (new Date()).getTime() + '">' +
      this.m_Data +
      '</style>'
    );
  },
  
  /**
   * Execute JavaScript in global context
   */
  handleJavaScript: function() {
    jQuery.globalEval(this.m_Data);
  },
  
  handleTemplate: function() {
    var l_TemplateEngine = new TemplateEngine(this.m_Parameters.Template);
    this.m_Data = l_TemplateEngine.fillTemplate(this.m_Data);
    this.handleHTML();
  }
};

//Extend
Extend(CipContentHandler, AjaxCipParameters);
Extend(AjaxCipResponse, CipContentHandler);


function Extend(a_TargetClass, a_SourceClass)
{
  var l_SourceClass = {};
  if (a_SourceClass.prototype) {
    l_SourceClass = new a_SourceClass();
  } else {
    l_SourceClass = a_SourceClass;
  }
  for(var i in l_SourceClass) {
    try {
      if (a_TargetClass.prototype) {
        a_TargetClass.prototype[i] = l_SourceClass[i];
      } else {
        a_TargetClass[i] = l_SourceClass[i];
      }
    }
    catch(e) {
      var err = e;
    }
  }
}


(function($,window){
  $.cleanCache = function() {
    for(var i in $.cache) {
      if ($.isEmptyObject($.cache[i])) {
        delete $.cache[i];
      }
    }
  };
})(jQuery,this);

/**
 * Real Clone of a node (there are bugs in the node.cloneNode() function of JS)
 */
(function( $ ){
  $.fn.realClone = function(a_WithEvents) {
    if (a_WithEvents !== true) {
      a_WithEvents = false;
    }
    var l_Clone = this.clone(a_WithEvents);
    
    var l_ClonedSelects = l_Clone.find('select');
    var l_OriginalSelects = this.find('select');
    for (var i in l_OriginalSelects)
    {
      l_ClonedSelects[i].selectedIndex = l_OriginalSelects[i].selectedIndex;
    }
    
    var l_ClonedTextareas = l_Clone.find('textarea');
    var l_OriginalTextareas = this.find('textarea');
    for (var i in l_OriginalTextareas)
    {
      l_ClonedTextareas[i].value = l_OriginalTextareas[i].value;
    }
    
    return l_Clone;
  };
})( jQuery );

/**
 * History Buttons Plugin
 */
(function( $ ){
  $.fn.historyButtons = function(a_Id) {
    this.data('historyButtons', $.fn.historyButtons.DefaultSettings);
    
    if (typeof(a_Id) === 'undefined') {
      return this.each(function() {
        var $this = $(this);
        var l_Settings = $this.data('historyButtons');
        
        var updateButtons = function() {
          if(AjaxCipComponentHistoryContainer.m_CurrentIndex === -1) {
            $this.find('.' + l_Settings.Classes.ContainerBack).css('visibility', 'hidden');
          } else {
            $this.find('.' + l_Settings.Classes.ContainerBack).css('visibility', 'visible');
          }
          if(AjaxCipComponentHistoryContainer.m_CurrentIndex === AjaxCipComponentHistoryContainer.m_GlobalHistory.length - 1
            || AjaxCipComponentHistoryContainer.m_GlobalHistory.length === 0) {
            $this.find('.' + l_Settings.Classes.ContainerForward).css('visibility', 'hidden');
          } else {
            $this.find('.' + l_Settings.Classes.ContainerForward).css('visibility', 'visible');
          }
        };
        
        updateButtons();
        $(document).bind('AfterAddComponentHistoryContainerEntry AfterBackComponentHistoryContainerEntry AfterForwardComponentHistoryContainerEntry', updateButtons);
        
        $this.find('.HistoryContainerBack').bind('click.historyButtons', function(a_Event) {
          AjaxCipComponentHistoryContainer.backContainer();
          updateButtons();
        });
        $this.find('.HistoryContainerForward').bind('click.historyButtons', function(a_Event) {
          AjaxCipComponentHistoryContainer.forwardContainer();
          updateButtons();
        });
      });
    } else if (typeof(a_Id) === 'string') {
      return this.each(function() {
        var $this = $(this);
        var l_Settings = $this.data('historyButtons');
        if(!AjaxCipComponentHistoryContainer.m_Components[a_Id]) {
          AjaxCipComponentHistoryContainer.m_Components[a_Id] = new AjaxCipHistoryComponent(a_Id);
        }
        var l_Component = AjaxCipComponentHistoryContainer.m_Components[a_Id];
        
        var updateButtons = function() {
          if(l_Component.m_CurrentIndex === 0) {
            $this.find('.' + l_Settings.Classes.ComponentBack).css('visibility', 'hidden');
          } else {
            $this.find('.' + l_Settings.Classes.ComponentBack).css('visibility', 'visible');
          }
          if(l_Component.m_CurrentIndex >= l_Component.m_Entries.length - 1
            || l_Component.m_Entries.length === 0) {
            $this.find('.' + l_Settings.Classes.ComponentForward).css('visibility', 'hidden');
          } else {
            $this.find('.' + l_Settings.Classes.ComponentForward).css('visibility', 'visible');
          }
        };
        
        updateButtons();
        $(l_Component).bind('AfterAddHistoryComponentEntry AfterBackHistoryComponentEntry AfterForwardHistoryComponentEntry AfterJumpHistoryComponentEntry AfterClearHistoryComponentEntry', updateButtons);
        
        $this.find('.HistoryComponentBack').bind('click.historyButtons', function(a_Event) {
          AjaxCipComponentHistoryContainer.back(a_Id);
          updateButtons();
        });
        $this.find('.HistoryComponentForward').bind('click.historyButtons', function(a_Event) {
          AjaxCipComponentHistoryContainer.forward(a_Id);
          updateButtons();
        });
      });
    } else {
      $.error( 'The argument have to be a string but it was ' + typeof(a_Id));
    }    
  
  };
  
  $.fn.historyButtons.DefaultSettings = {
    Classes: {
      ContainerBack: 'HistoryContainerBack',
      ContainerForward: 'HistoryContainerForward',
      ComponentBack: 'HistoryComponentBack',
      ComponentForward: 'HistoryComponentForward'
    }
  };

})( jQuery );