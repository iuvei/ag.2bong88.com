﻿/*
* Created 20100109@Lee - Common functions for sub-account
* Revision ?@? - ...
*
*/

var objActiveMemInfo;

function SubAccLoad() {
    var txtPwd = $('txtPwd');
    if (txtPwd) {
        txtPwd.maxLength = 16;
    }

    var txtNewPwd = $('txtNewPwd');
    if (txtNewPwd) {
        txtNewPwd.maxLength = 16;
    }

    var txtConfirmPwd = $('txtConfirmPwd');
    if (txtConfirmPwd) {
        txtConfirmPwd.maxLength = 16;
    }
}

RegisterStartUp(SubAccLoad);

// Init params
function InitParams() {
    var parStr = '';
    var option1 = $('number1');
    var option2 = $('number2');
    var par = new Array();

    par.push('number1=' + option1.options[option1.selectedIndex].value);
    par.push('number2=' + option2.options[option2.selectedIndex].value);
    par.push('txtPwd=' + $('txtPwd').value);
    par.push('txtFirstName=' + $('txtFirstName').value);
    par.push('txtLastName=' + $('txtLastName').value);

    for (var i = 0; i < _page.checkBoxes.length; i++) {
        par.push(_page.checkBoxes[i] + "=" + $(_page.checkBoxes[i]).checked);
    }
    parStr = par.join('&');

    return parStr;
}

// Check pass call in keyup event
function CheckPass(pwdElement, iconElementId) {
    var isPwd = IsPassword(pwdElement.value);
    var iconElement = $(iconElementId);

    if (!iconElement) return false;

    if (isPwd) {
        iconElement.className = 'PwdSuccess';
    }
    else {
        iconElement.className = 'PwdError';
    }

    return isPwd;
}

function ValidatePassword(str) {
    if (str.length == 0) return _page.errMsgEmpty;
    else if (!IsPassword(str)) return _page.errWrongPwd;

    return null;
}

// Call handler to update for AddSubAcc popup
function UpdateAddSubAcc() {
    // Validate password
    var txtPwd = $('txtPwd');
    var errMsg = ValidatePassword(txtPwd.value);

    if (null != errMsg) {
        ageMsg.Show(errMsg);
        AddPopupHeight(50);
        txtPwd.focus();
        return;
    }

    function OnComplete(result) {
        age.UnLock();
        var errCode = result.errCode;
        if (errCode == 0) {
            ageMsg.Hide();
            if (_page.CallBack) {
                eval(_page.CallBack);
            }
        }
        else {
            ageMsg.Show(result.errMsg);
            AddPopupHeight(50);
        }
    }

    // Post with return result in JSON format
    age.Lock(false);
    ajax.PostJSON(
        '/azkv.php?r=adminweb/addSubAccHandle',
        InitParams(),
        OnComplete
    );
}

// Call handler to update for EditSubAcc popup
function UpdateEditSubAcc(id) {
    var params = ajax.CreateParams('txtFirstName', 'txtLastName', 'chkStatus');
    params += '&SubAccId=' + id;

    function OnComplete(result) {
        age.UnLock();
        var errCode = result.errCode;
        if (errCode == 0) {
            ageMsg.Hide();
            if (_page.CallBack) {
                eval(_page.CallBack);
            }
        }
        else {
            ageMsg.Show(result.errMsg);
            AddPopupHeight(50);
        }
    }

    // Post with return result in JSON format
    age.Lock(false);
    ajax.PostJSON(
        '/azkv.php?r=adminweb/EditSub',
        params,
        OnComplete
    );
}

// Call handler to reset sub-account password for SubAccPwd popup
function UpdateResetSubAccPwd() {
    // Validate password
    var txtNewPwd = $('txtNewPwd');
    var txtConfirmPwd = $('txtConfirmPwd');

    var errMsg = null;
    if (txtNewPwd.value != txtConfirmPwd.value) {
        errMsg = _page.errMsgConfirm;
    }
    else {
        errMsg = ValidatePassword(txtNewPwd.value);
    }

    if (null != errMsg) {
        ageMsg.Show(errMsg);
        AddPopupHeight(50);
        txtNewPwd.focus();
        return;
    }

    var newPwd = txtNewPwd.value;
    var confirmNewPwd = txtConfirmPwd.value;

    txtNewPwd.value = txtNewPwd.value;
    txtConfirmPwd.value = txtConfirmPwd.value;

    var params = ajax.CreateParams('txtNewPwd', 'txtConfirmPwd');
    params += '&SubAccId=' + _page.SubAccId;

    txtNewPwd.value = newPwd;
    txtConfirmPwd.value = confirmNewPwd;

    function OnComplete(result) {
        age.UnLock();
        var errCode = result.errCode;
        if (errCode == 0) {
            ageMsg.Hide();
            if (_page.CallBack) {
                eval(_page.CallBack);
            }
        }
        else {
            ageMsg.Show(result.errMsg);
            AddPopupHeight(50);
        }
    }

    // Post with return result in JSON format
    age.Lock(false);
    ajax.PostJSON(
        '/azkv.php?r=adminweb/ResetSubPass',
        params,
        OnComplete
    );
}

// SubAccList.aspx
// When popup return, it call this: parent.OnPopupComplete
function OnPopupComplete(reload) {
    ageWnd.close(); // Close popup
    if (reload) age.DelayReloadPage(); // Reload page after 2s
}

// Update page access when user click on checkboxes
function UpdatePageAccess(el, id, value, callback) {
    var errCode = -1;
    function OnComplete(result) {
        errCode = result.errCode;
        if (errCode == 0) {
            ageMsg.Hide();

            // Set value
            if (el != window) {
                el.checked = !el.checked;
            }
        }

        if (typeof callback == 'function') {
            callback(errCode);
        }
    }

    if (typeof value == 'undefined') {
        value = $("mi_" + id).getAttribute('AccPermission');
    }

    if ($("chk" + id + "[D]").checked) value += "[D]";
    if ($("chk" + id + "[E]").checked) value += "[E]";
    if ($("chk" + id + "[C]").checked) value += "[C]";
    if ($("chk" + id + "[G]").checked) value += "[G]";

    var params = 'SubAccId=' + id + '&updPageAccess=' + value;

    // Recover first
    if (errCode != 0 && el != window) {
        el.checked = !el.checked;
    }

    // Post with return result in JSON format
    ajax.PostJSON(
        'Handlers/UpdatePageAccess.ashx',
        params,
        OnComplete,
        false
    );

    return errCode;
}

// Add sub account
function AddSubAccPopup() {
    var url = "/azkv.php?r=adminweb/addSub";
    url += "&CallBack=parent.OnPopupComplete(true)";
    var popH = 300, popW = 480;

    ageMsg.Hide();

    ageWnd.open(url, '', 50, document.body.scrollTop + 20, popW, popH);
}

// Edit selected sub account
function EditSubAccPopup(id, name) {
    var url = "/azkv.php?r=adminweb/EditSub&";
    url += "SubAccId=" + id;
    url += "&User=" + name;
    url += "&CallBack=parent.OnPopupComplete(true)";

    var popH = 170, popW = 380;

    ageMsg.Hide();

    ageWnd.open(url, '', 500, document.body.scrollTop + 50, popW, popH);
}

// Edit selected sub account
function ResetSubAccPwdPopup(id, name) {
    var url = "/azkv.php?r=adminweb/ResetSubPass&";
    url += "SubAccId=" + id;
    url += "&User=" + name;
    url += "&CallBack=parent.OnPopupComplete(false)";

    var popH = 120, popW = 380;

    ageMsg.Hide();

    ageWnd.open(url, '', 500, document.body.scrollTop + 50, popW, popH);
}

// Edit selected sub account
function ResetSubAccSCPopup(subAccId, username) {
    var secCodeLink = !_page.isNewSC
        ? age.GetBaseUrl() + '_MemberInfo/SecurityCode/ChangeSecurityCode.aspx?subaccid=' + subAccId + '&username=' + username
        : age.GetBaseUrl() + 'Security/SecurityCode/ResetSecurityCode?subaccid=' + subAccId + '&username=' + username;
    ageWnd.open(
	    secCodeLink,
        '',
        70,
        100,
        700,
        480
    );
}

/**********************************************************/
function GetPosition(element) {
    var left = 0;
    var top = 0;
    if (element.offsetParent) {
        while (element) {
            left += element.offsetLeft;
            top += element.offsetTop;
            element = element.offsetParent;
        }
    }
    return {
        offsetLeft: left,
        offsetTop: top
    };
}
function ShowPopup(el, div) {
    el.style.position = 'relative';
    var pos = GetPosition(el);
    div.style.top = (pos.offsetTop) + 'px';
    div.style.left = (pos.offsetLeft + 85) + 'px';
    div.style.display = 'block';

    div.timerID = 0;
    div.timerID = setTimeout(function () { HidePopupStatus('Popup'); }, 2000);
    age.addEvent(div, "mouseover", function () {
        clearTimeout(div.timerID);
        div.timerID = 0;
    }, true);

    age.addEvent(div, "mouseout", function () {
        clearTimeout(div.timerID);
        div.timerID = 0;
        div.timerID = setTimeout(function () { HidePopupStatus('Popup'); }, 100);
    }, true);
}

// Render Popup Status
function OpenBoxMemberInfo(el, custId) {
    var div = $('Popup');

    // For case fast access / fast click
    if (objActiveMemInfo != null && objActiveMemInfo != undefined) {
        clearTimeout(div.timerID);
        div.timerID = 0;
        objActiveMemInfo.className = 'pMemInfo';
        HidePopupStatus('Popup');
    }

    objActiveMemInfo = $("mi_" + custId);
    objActiveMemInfo.className = 'pMemInfoActive';
    ShowPopup(el, div);

    // Set option
    var lblPermission = objActiveMemInfo.getAttribute('AccPermission');
    if (lblPermission == "[A][B][H]") $("pFullControl").checked = true;
    else if (lblPermission == "[B][H]") $("pUpdateView").checked = true;
    else if (lblPermission == "[H]") $("pView").checked = true;
    else $("pNone").checked = true;

    age.addEvent($('pNone'), "click", function () {
        setValueMemberInfo(custId, _page.NonePM, "");
    }, true);

    age.addEvent($('pView'), "click", function () {
        setValueMemberInfo(custId, _page.ViewPM, "[H]");
    }, true);

    age.addEvent($('pUpdateView'), "click", function () {
        setValueMemberInfo(custId, _page.UpdateViewPM, "[B][H]");
    }, true);

    age.addEvent($('pFullControl'), "click", function () {
        setValueMemberInfo(custId, _page.FullControlPM, "[A][B][H]");
    }, true);
}
function setValueMemberInfo(custId, PermissionName, value) {
    if (value != objActiveMemInfo.getAttribute('AccPermission')) {
        function onComplete(errCode) {
            if (errCode == 0) {
                objActiveMemInfo.innerHTML = PermissionName;
                objActiveMemInfo.setAttribute('AccPermission', value);
            }
        }
        UpdatePageAccess(this, custId, value, onComplete);
    }
    HidePopupStatus('Popup');
}

function OpenBoxMemberInfoAddNew(el) {
    var div = $('Popup');
    ShowPopup(el, div);

    age.addEvent($('pNone'), "click", function () {
        setValueMemberInfoAddNew(_page.NonePM, false, false, false, "");
    }, true);

    age.addEvent($('pView'), "click", function () {
        setValueMemberInfoAddNew(_page.ViewPM, false, false, true, "[H]");
    }, true);

    age.addEvent($('pUpdateView'), "click", function () {
        setValueMemberInfoAddNew(_page.UpdateViewPM, false, true, true, "[B][H]");
    }, true);

    age.addEvent($('pFullControl'), "click", function () {
        setValueMemberInfoAddNew(_page.FullControlPM, true, true, true, "[A][B][H]");
    }, true);
}

function setValueMemberInfoAddNew(PermissionName, bolCreate, bolUpdate, bolView, strVaLue) {
    $("chkCreateAcc").checked = bolCreate;
    $("chkUpdateAcc").checked = bolUpdate;
    $("chkMemberInfo").checked = bolView;
    HidePopupStatus('Popup');
    $("mi_CustId").innerHTML = PermissionName;
    $("mi_CustId").setAttribute('AccPermission', strVaLue);
}

function HidePopupStatus(divID) {
    var div = $(divID);
    if (!div) return false;
    div.style.display = 'none';

    if (objActiveMemInfo != null && objActiveMemInfo != undefined) objActiveMemInfo.className = 'pMemInfo';
}