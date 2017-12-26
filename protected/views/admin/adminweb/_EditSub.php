<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Edit Sub Account</title>
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
        <table align="left" width="100%" class="tblPop" cellspacing="1" cellpadding="0" border="0" onkeydown="age.DoEnter(event, 'UpdateEditSubAcc(_page.SubAccId)')">
            <tr class="bg_eb2">
                <td class="r b">Username</td>
                <td><?php echo $username ?></td>
            </tr>
            <tr class="bg_eb2">
                <td class="r b">First Name</td>
                <td class="l">
                    <input name="txtFirstName" id="txtFirstName" type="text" value="" />
                </td>
            </tr>
            <tr class="bg_eb2">
                <td class="r b">Last Name</td>
                <td class="l">
                    <input name="txtLastName" id="txtLastName" type="text" value="" />
                </td>
            </tr>
            <tr class="bg_eb2">
                <td class="r b">Status-Closed</td>
                <td class="l">
                    <input name="chkStatus" id="chkStatus" <?php echo $sub->status==2?"checked":"" ?> type="checkbox" />
                </td>
            </tr>
            <tr class="bg_eb2">
                <td class="c" colspan="2">
                    <input type="button" id="btnEdit" onclick="UpdateEditSubAcc(_page.SubAccId)" name="btnEdit" value=" Update " class="btn" />
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
        'CallBack': 'parent.OnPopupComplete(true)',
        'SubAccId': '<?php echo $subId ?>'
    };
</script>