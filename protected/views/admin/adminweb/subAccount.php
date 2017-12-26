<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Sub-Account List</title>
    <link href="/assets/stylesheets/agent/Agent.css?20150422" rel="stylesheet" type="text/css" />
    <link href="/assets/stylesheets/agent/MenuPopup_Control.css?20150422" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="page_main">
        <div class="divHeader">Sub Account &nbsp;
            <input type="button" onclick="AddSubAccPopup();" value="Add Sub Account" class="btn" />
        </div>
        <div style="width: 1050px">
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
        </div>
        <table class="tblRpt" width="100%" cellspacing="1" cellpadding="0" border="0">
            <tr class="RptHeader">
                <td>#</td>
                <td>Username</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Created Date</td>
                <td width="110">Member information</td>
                <td width="110">Total Bets/Forecast</td>
                <td width="70">Reports</td>
                <td width="70">Transfer</td>
                <td width="70">View Log</td>
                <td>Edit</td>
                <td>Password</td>
                <td>Security Code</td>
            </tr>
			<?php $i=1; foreach($listSub as $sub){ ?>
            <tr align="center" bgcolor="<?php echo ($i%2==0)?"#F6F8F9":"#faf9ee" ?>" onmouseover="bgColor='#f8ff8d'" onmouseout="bgColor='<?php echo ($i%2==0)?"#F6F8F9":"#faf9ee" ?>'">
                <td class="w-order"><?php echo $i ?></td>
                <td class="l"><?php echo $sub->Username ?></td>
                <td class="l"></td>
                <td class="l"></td>
                <td class="bl_time"></td>
                <td>
                    <div id="mi_646980" onclick="OpenBoxMemberInfo(this,'<?php echo $sub->Id ?>')" class="pMemInfo" AccPermission="">None</div>
                </td>
                <td>
                    <input type="checkbox" onclick="UpdatePageAccess(this, <?php echo $sub->Id ?>);" id="chk646980[D]" />
                </td>
                <td>
                    <input type="checkbox" onclick="UpdatePageAccess(this, <?php echo $sub->Id ?>);"  id="chk646980[E]" />
                </td>
                <td>
                    <input type="checkbox" onclick="UpdatePageAccess(this, <?php echo $sub->Id ?>);" id="chk646980[C]" />
                </td>
                <td>
                    <input type="checkbox" onclick="UpdatePageAccess(this, <?php echo $sub->Id ?>);"  id="chk646980[G]" />
                </td>
                <td align="center">
                    <input type="button" class="editBtn" onclick="EditSubAccPopup(<?php echo $sub->Id ?>, '<?php echo $sub->Username ?>');" title="Edit" />
                </td>
                <td>
                    <input type="button" class="editBtn" onclick="ResetSubAccPwdPopup(<?php echo $sub->Id ?>,'<?php echo $sub->Username ?>');" title="Edit" />
                </td>
                <td>
                    <input type="button" class="editBtn" onclick="ResetSubAccSCPopup(<?php echo $sub->Id ?>,'<?php echo $sub->Username ?>');" title="Edit" />
                </td>
            </tr>
            <?php $i++; } ?>
			
		
		</table>
        <div id="Popup" class="divMenuPopup">
            <div>
                <input type="radio" name="rdPermission" id="pNone" />
                <label class="rdLabel" for="pNone">None</label>
            </div>
            <div>
                <input type="radio" name="rdPermission" id="pView" />
                <label class="rdLabel" for="pView">View</label>
            </div>
            <div>
                <input type="radio" name="rdPermission" id="pUpdateView" />
                <label class="rdLabel" for="pUpdateView">Update</label>
            </div>
            <div>
                <input type="radio" name="rdPermission" id="pFullControl" />
                <label class="rdLabel" for="pFullControl">Full Control</label>
            </div>
        </div>
    </div>
    <!--end of 'page_main' div-->
</body>
<script src="/assets/js/bet/Core.js?20150422" type="text/javascript"></script>
<script src="/assets/js/bet/AGEWnd.js?20150422" type="text/javascript"></script>
<script src="/assets/js/bet/SubAcc.js?<?php echo time(); ?>" type="text/javascript"></script>

</html>
<script type="text/javascript">
    var _page = {
        'lblconfirmclosesubacc': 'No permission for sub-account.',
        'lblConfirmClosed': 'Your account was closed so you\u0027re forced to logout. Please contact your upline for the assistance.',
        'FullControlPM': 'Full Control',
        'UpdateViewPM': 'Update',
        'ViewPM': 'View',
        'NonePM': 'None',
        'isNewSC': false
    };
</script>