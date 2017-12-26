<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Change Password</title>
    <link href="/assets/stylesheets/agent/Agent.css?20150422" rel="stylesheet" type="text/css" />
    <link href="/assets/stylesheets/agent/Popup.css?20150422" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="page_popup">
        <link href="/assets/stylesheets/agent/ErrorMsg.css?20150422" rel="stylesheet" type="text/css" />
        <script src="/assets/js/bet/ErrorMsg.js?20150422" type="text/javascript"></script>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="diverrmsg" style="display: none;">
            <tr>
                <td id="msg_1_1" class="emsg_1_1">&nbsp;</td>
                <td id="msg_1_2" class="emsg_1_2">&nbsp;</td>
                <td id="msg_1_3" class="emsg_1_3">&nbsp;</td>
            </tr>
            <tr>
                <td id="msg_2_1" valign="top" class="emsg_2_1">&nbsp;</td>
                <td valign="top" id="spmsgerr" class="msgerr"></td>
                <td id="msg_2_2" class="emsg_2_2">&nbsp;</td>
            </tr>
            <tr>
                <td id="msg_3_1" class="emsg_3_1">&nbsp;</td>
                <td id="msg_3_2" class="emsg_3_2">&nbsp;</td>
                <td id="msg_3_3" class="emsg_3_3">&nbsp;</td>
            </tr>
        </table>
        <table align="left" width="100%" class="tblPop" cellspacing="1" cellpadding="0" border="0" onkeydown="age.DoEnter(event, 'UpdateResetSubAccPwd()')">
            <tr class="bg_eb2">
                <td class="r b" width="40%">Password</td>
                <td class="l">
                    <input id="txtNewPwd" onkeyup="return CheckPass(this,'spnNewPwdIcon');" type="password" name="txtNewPwd" /><span id="spnNewPwdIcon">&nbsp;</span><span id="spnInfoIco" class="infoIco" title="Password must be at least 8 characters without white-space and contain at least 3 of the following:

  • Uppercase letter [A-Z] 
  • Lowercase letter [a-z] 
  • Numeric [0-9] 
  • Special character (!,@,#,etc..)

For example: 59D7!4$h, 493abcDE
Notes: your password is cAsE sEnSiTiVe" style="left: 296px;line-height: 19px;position: absolute;z-index: 999;">&nbsp;</span></td>
            </tr>
            <tr class="bg_eb2">
                <td class="r b">Confirm Password</td>
                <td class="l">
                    <input id="txtConfirmPwd" onkeyup="return CheckPass(this,'spnConfirmPwdIcon');" type="password" name="txtConfirmPwd" /><span id="spnConfirmPwdIcon">&nbsp;</span></td>
            </tr>
            <tr class="bg_eb2">
                <td class="c" colspan="2">
                    <input type="button" id="btnEdit" onclick="UpdateResetSubAccPwd()" name="btnEdit" value=" Update " class="btn" />
                </td>
            </tr>
        </table>
    </div>
</body>
<script src="/assets/js/bet/Core.js?20150422" type="text/javascript"></script>
<script src="/assets/js/bet/SubAcc.js?<?php echo time(); ?>" type="text/javascript"></script>

</html>
<script type="text/javascript">
    var _page = {
        'errMsgEmpty': 'Sorry, password cannot be empty!!!',
        'errMsgRequire': 'Password must be at least 8 characters without white-space and contain at least 3 of the following:\r\n\r\n  • Uppercase letter [A-Z] \r\n  • Lowercase letter [a-z] \r\n  • Numeric [0-9] \r\n  • Special character (!,@,#,etc..)\r\n\r\nFor example: 59D7!4$h, 493abcDE\r\nNotes: your password is cAsE sEnSiTiVe',
        'errWrongPwd': 'Your password does not meet the minimum security requirement.',
        'errMsgConfirm': 'The password was not correctly confirmed.',
        'SubAccId': '<?php echo $subId ?>',
        'CallBack': 'parent.OnPopupComplete(false)'
    };
</script>