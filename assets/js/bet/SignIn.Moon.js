﻿/*
* Created 20100113@Lee - Sign-in javascript functions
* Revision ?@? - ...
*
*/
var CurrentLanguageId = 0;

var LanguagesId = new Array(0, 1, 2, 3, 4, 5, 6);
var Languages = new Array("en-US", "zh-TW", "ja-JP", "th-TH", "zh-CN", "ko-KR", "vi-VN");
var LanguageMessages = new Array({
    errUserName: "Please input username and password",
    errValidCode: "You must input validation code."
}, {
        errUserName: "請輸入會員名字及密碼",
        errValidCode: "您必须输入正确验证码"
    }, {
        errUserName: "ユーザー名とパスワードを入力してください",
        errValidCode: "You must input validation code."
    }, {
        errUserName: "โปรดใส่ชื่อผู้ใช้และรหัสผ่าน",
        errValidCode: "คุณต้องใส่หมายเลขที่ใช้ในการตรวจสอบ"
    }, {
        errUserName: "请输入账号及密码",
        errValidCode: "您必須輸入正確驗證碼"
    }, {
        errUserName: "사용자명과 비밀번호를 입력해주세요",
        errValidCode: "확인코드를 입력해주세요."
    }, {
        errUserName: "Vui lòng điền Tên đăng nhập và Mật khẩu",
        errValidCode: "Bạn phải nhập mã xác thực."
});

function SelectLanguage(value) {
    var flagBgX = 0;
    var flagWidth = 24
     SetValue(value, 'Tên đăng nhập', 'Mật khẩu', 'Đăng nhập', 'Recommended Browsers', 'Mã xác nhận', "Hiển thị mật khẩu");
     flagBgX = flagWidth * 1;
    $('spnLanguage').style.backgroundPosition = flagBgX + 'px 0px';
    $("errmsg").innerHTML = '';
}

function SetValue(language, username, pwd, login, browser, captcha, pwdHint) {
    $('hidLanguage').value = Languages[language];
    $('spnUserName').innerHTML = username;
    $('spnPassWord').innerHTML = pwd;
    $('btnLogin').value = login;
    $('divBrowser').innerHTML = browser;
    $('selLanguage').value = language;
    $('spnCaptcha').innerHTML = captcha;
    setCookie('LANGUAGE', Languages[language], 30);
    CurrentLanguageId = language;

    $('txtUserName').value = $('spnUserName').innerHTML;
    $('txtPassWord').value = $('spnPassWord').innerHTML;
    $('pass_temp').value = $('spnPassWord').innerHTML;
    $('txtCaptcha').value = $('spnCaptcha').innerHTML;

    $('table_main').firstChild.innerHTML = login;
    $('showPwdLabel').innerHTML = pwdHint;
}

function DoLogin() {
    var errObj = LanguageMessages[CurrentLanguageId];
    if ($('txtUserName').value == "") {
        $("errmsg").innerHTML = errObj.errUserName;
        $('txtUserName').focus();
        return false;
    }
    if ($('txtPassWord').value == "") {
        $("errmsg").innerHTML = errObj.errUserName;
        $('txtPassWord').focus();
        return false;
    }
	/*
    if ($('txtCaptcha').value == "") {
        $("errmsg").innerHTML = errObj.errValidCode;
        $('txtCaptcha').focus();
        return false;
    }
	*/
    $('btnLogin').disabled = true;
    $('btnLogin').className = 'buttondisable';

    //$('txtPassWord').value = $('txtPassWord').value.ec(_page.captcha).hc();
    //$('pass_temp').value = $('pass_temp').value.ec($('txtPassWord').value).hc();

    setCookie("ssl", location.href.indexOf('https://') == 0, 30);
    document.fLogin.submit();

    return true;
}

function GetValidateImage() {
    var objDate = new Date();
    $("imgCode").src = "Handlers/Captcha.ashx?code=" + objDate.getMilliseconds();

    setTimeout(GetValidateImage, 120000);
}

function InitUserNamePwd() {
    $('txtUserName').value = $('spnUserName').innerHTML;
    $('txtPassWord').value = $('spnPassWord').innerHTML;

    $('txtUserName').onfocus = function () {
        if ($('txtUserName').value == $('spnUserName').innerHTML) {
            $('txtUserName').value = '';
        }
    }

    $('txtUserName').onblur = function () {
        if ($('txtUserName').value == '') {
            $('txtUserName').value = $('spnUserName').innerHTML;
        }
    }

    $('txtPassWord').onblur = function () {
        if ($('txtPassWord').value == '') {
            $('div1').style.display = '';
            $('div2').style.display = 'none';

            $('txtPassWord').value = $('spnPassWord').innerHTML;
        }
    }

    $('pass_temp').onfocus = function () {
        if (!$('showPwdChk').checked) {
            $('div1').style.display = 'none';
            $('div2').style.display = '';
            $('txtPassWord').focus();
            $('txtPassWord').value = '';
        }
        else if ($('pass_temp').value == $('spnPassWord').innerHTML) {
            $('pass_temp').value = '';
        }
    }

    $('txtCaptcha').onfocus = function () {
        if ($('txtCaptcha').value == $('spnCaptcha').innerHTML) {
            $('txtCaptcha').value = '';
        }
    }

    $('txtCaptcha').onblur = function () {
        if ($('txtCaptcha').value == '') {
            $('txtCaptcha').value = $('spnCaptcha').innerHTML;
        }
    }

}

function InitLogin() {
    // Do not allow wrapping sign-in page
    if (window.parent != window) {
        window.parent.location = location.href;
    }

    (function () {
        // Insert show password check box
        var td = $('txtPassWord').parentNode;
        var div = document.createElement("DIV");
        var checkbox = document.createElement("INPUT");
        checkbox.setAttribute('type', 'checkbox');
        checkbox.id = 'showPwdChk';
        var label = document.createElement("LABEL");
        label.setAttribute('for', checkbox.id);
        label.id = 'showPwdLabel';

        div.style.paddingTop = '8px';
        div.style.paddingLeft = '8px';
        $('spnPassWord').parentNode.vAlign = 'top';

        div.appendChild(checkbox);
        div.appendChild(label);

        var txtPassWord = $('txtPassWord');
        var pwdMask = $('pass_temp');

        document.fLogin.firstChild.rows[3].cells[0].appendChild(div);
        $('divBrowser').style.display = 'none';

        checkbox.onclick = function () {
            if (!this.checked && $('pass_temp').value == $('spnPassWord').innerHTML) {
                txtPassWord.value = '';
            }
            else if (this.checked && $('pass_temp').value == '') {
                $('pass_temp').value = $('spnPassWord').innerHTML;
            }

            $('div2').style.display = this.checked ? 'none' : 'block';
            $('div1').style.display = !this.checked ? 'none' : 'block';
        }

        txtPassWord.onchange = function () {
            if (this.value == $('spnPassWord').innerHTML) return;
            pwdMask.value = this.value;
        }
        pwdMask.onchange = function () {
            if (this.value == $('spnPassWord').innerHTML) return;
            txtPassWord.value = this.value;
        }

    })();

    var language =  language = _page.language;    
    

    SelectLanguage(GetLanguageIndex(language));

    setTimeout(GetValidateImage, 120000);

    if (typeof _page.errCode != 'undefined' && _page.errCode != 0) {
        $("errmsg").innerHTML = _page.errMsg;
        if (_page.errCode == 101) {
            $('txtCaptcha').focus();
        }
    }

    InitUserNamePwd();
    $('txtPassWord').setAttribute('autocomplete', 'off');
}

var _DoLogin = DoLogin;

DoLogin = function () {

    if ($('txtUserName').value == $('spnUserName').innerHTML) {
        $('txtUserName').value = '';
    } else if ($('txtPassWord').value == $('spnPassWord').innerHTML) {
        $('txtPassWord').value = '';
    } else if ($('txtCaptcha').value == $('spnCaptcha').innerHTML) {
        $('txtCaptcha').value = '';
    }
    _DoLogin();
}

// Register start up
_addEvent(window, "load", InitLogin);

function GetLanguageIndex(languageCode) {
    for (var i = 0; i < Languages.length; i++) {
        if (Languages[i] === languageCode)
            return i;
    }
    return 0;
}