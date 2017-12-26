<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Add Sub Account</title>
    <link href="/assets/stylesheets/agent/Agent.css?20150422" rel="stylesheet" type="text/css" />
    <link href="/assets/stylesheets/agent/Popup.css?20150422" rel="stylesheet" type="text/css" />
    <link href="/assets/stylesheets/agent/MenuPopup_Control.css?20150422" rel="stylesheet" type="text/css" />
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
        <table align="left" width="100%" class="tblPop" cellspacing="1" cellpadding="0" border="0" onkeydown="age.DoEnter(event, 'UpdateAddSubAcc()')">
            <tr class="bg_eb2">
                <td width="30%" class="r b">Username</td>
                <td class="l"><?php echo $admin->Username ?>Sub
                    <select name="number1" id="number1">
                        <option selected="selected" value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                    <select name="number2" id="number2">
                        <option selected="selected" value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="0">0</option>
                    </select>
                </td>
            </tr>
            <tr class="bg_eb2">
                <td class="r b">Password</td>
                <td id="td_pass" class="l">
                    <input name="txtPwd" id="txtPwd" type="password" onkeyup="return CheckPass(this,'spnPwdIcon');" /><span id="spnPwdIcon">&nbsp;</span><span id="spnInfoIco" class="infoIco" title="Password must be at least 8 characters without white-space and contain at least 3 of the following:

  • Uppercase letter [A-Z] 
  • Lowercase letter [a-z] 
  • Numeric [0-9] 
  • Special character (!,@,#,etc..)

For example: 59D7!4$h, 493abcDE
Notes: your password is cAsE sEnSiTiVe" style="left: 296px;line-height: 19px;position: absolute;z-index: 999;">&nbsp;</span></td>
            </tr>
            <tr class="bg_eb2">
                <td class="r b">First Name</td>
                <td id="td_fname" class="l">
                    <input name="txtFirstName" id="txtFirstName" type="text" />
                </td>
            </tr>
            <tr class="bg_eb2">
                <td class="r b">Last Name</td>
                <td id="td_lname" class="l">
                    <input name="txtLastName" id="txtLastName" type="text" />
                </td>
            </tr>
            <tr class="bg_eb2">
                <td colspan="2" class="l b">* Account Permission</td>
            </tr>
            <tr class="bg_eb2">
                <td colspan="2" class="c" valign="middle">
                    <table class="tblRpt" width="100%" cellspacing="1" cellpadding="0" border="0">
                        <tr bgcolor="#F1E8D2">
                            <td width="110">Member information</td>
                            <td width="110">Total Bets/Forecast</td>
                            <td width="70">Reports</td>
                            <td width="70">Transfer</td>
                            <td width="70">View Log</td>
                        </tr>
                        <tr align="center" bgcolor="#faf9ee">
                            <td>
                                <div id="mi_CustId" onclick="OpenBoxMemberInfoAddNew(this)" class="pMemInfo" AccPermission="">None</div>
                                <div style="display:none">
                                    <input type="checkbox" id="chkCreateAcc" name="chkCreateAcc" />
                                    <input type="checkbox" id="chkUpdateAcc" name="chkUpdateAcc" />
                                    <input type="checkbox" id="chkMemberInfo" name="chkMemberInfo" />
                                </div>
                            </td>
                            <td>
                                <input type="checkbox" id="chkTotalBets" name="chkTotalBets" />
                            </td>
                            <td>
                                <input type="checkbox" id="chkReports" name="chkReports" />
                            </td>
                            <td>
                                <input type="checkbox" id="chkTransfer" name="chkTransfer" />
                            </td>
                            <td>
                                <input type="checkbox" id="chkViewLog" name="chkViewLog" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="bg_eb2">
                <td class="c" colspan="2">
                    <input type="button" id="btnAdd" onclick="UpdateAddSubAcc()" name="btnAdd" value=" Add " class="btn" />
                </td>
            </tr>
        </table>
        <div id="Popup" class="divMenuPopup">
            <div>
                <input type="radio" name="rdPermission" id="pNone" checked="checked">
                <label class="rdLabel" for="pNone">None</label>
            </div>
            <div>
                <input type="radio" name="rdPermission" id="pView">
                <label class="rdLabel" for="pView">View</label>
            </div>
            <div>
                <input type="radio" name="rdPermission" id="pUpdateView">
                <label class="rdLabel" for="pUpdateView">Update</label>
            </div>
            <div>
                <input type="radio" name="rdPermission" id="pFullControl">
                <label class="rdLabel" for="pFullControl">Full Control</label>
            </div>
        </div>
    </div>
</body>
<script src="/assets/js/bet/Core.js?20150422" type="text/javascript"></script>
<script src="/assets/js/bet/SubAcc.js?<?php echo time(); ?>" type="text/javascript"></script>

</html>
<script type="text/javascript">
    var _page = {
        'errMsgEmpty': 'Sorry, password cannot be empty!!!',
        'errMsgRequire': 'Password must be at least 8 characters without white-space and contain at least 3 of the following:\r\n\r\n  • Uppercase letter [A-Z] \r\n  • Lowercase letter [a-z] \r\n  • Numeric [0-9] \r\n  • Special character (!,@,#,etc..)\r\n\r\nFor example: 59D7!4$h, 493abcDE\r\nNotes: your password is cAsE sEnSiTiVe',
        'CallBack': 'parent.OnPopupComplete(true)',
        'checkBoxes': ['chkTotalBets', 'chkReports', 'chkCreateAcc', 'chkUpdateAcc', 'chkMemberInfo', 'chkTransfer', 'chkViewLog'],
        'FullControlPM': 'Full Control',
        'UpdateViewPM': 'Update',
        'ViewPM': 'View',
        'NonePM': 'None',
        'errWrongPwd': 'Mật khẩu phải có ít nhất 8 ký tự, không có khoảng trắng và chứa ít nhất 1 chữ viết HOA',
        'errMsgRequire': 'Password must be at least 8 characters without white-space and contain at least 3 of the following:\r\n\r\n  • Uppercase letter [A-Z] \r\n  • Lowercase letter [a-z] \r\n  • Numeric [0-9] \r\n  • Special character (!,@,#,etc..)\r\n\r\nFor example: 59D7!4$h, 493abcDE\r\nNotes: your password is cAsE sEnSiTiVe'
    };
</script>