<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Chi tiết thắng thua của Super</title>
    <link href="/assets/stylesheets/agent/Agent.css?20141215" rel="stylesheet" type="text/css" />
    <link href="/assets/stylesheets/agent/Reports.css?20141215" rel="stylesheet" type="text/css" />
</head>

<body>
    <form id="frmmain" method="POST" action="/azkv.php?r=site/detailWinLost&type=<?php echo $type ?>">
        <div id="page_main">
            <div id="header_main">Chi tiết thắng thua <?php echo ($type=="ProSuperMaster")?"Super Master":(($type=="superMaster")?"Master":("Agent")) ?></div>
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div id="box_header">
                            <table style="width: 100%">
                                <tr>
                                    <td>
                                        <link href="/assets/stylesheets/agent/DateRangeSelect.css?20141215" rel="stylesheet" type="text/css" />
                                        <script src="/assets/js/bet/DateRangeSelect.js?20141215" type="text/javascript"></script>
                                        <script type="text/javascript">
                                            var max_server_date = '<?php echo date("m/d/Y"); ?>';
                                        </script>
                                        <div id="spDateTimeSearch">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr style="height: 32px;">
                                                    <td id="tdfdatetext" style="padding-left: 6px;" class="l"><span id="spfdatetext">Từ:</span>
                                                    </td>
                                                    <td id="tdFromDateCal" class="l"><span id="spFromDateCal">
													<link href="/assets/stylesheets/agent/jscal2.css?20141215" rel="stylesheet" type="text/css" />
													<link href="/assets/stylesheets/agent/steel.css?20141215" rel="stylesheet" type="text/css" />
													<script src="/assets/js/bet/jscal2.js?20141215" type="text/javascript"></script>
													<script src="/assets/js/bet/en.js?20141215" type="text/javascript"></script>
													<table cellpading="0" cellspacing="0" border="0"><tr><td><input id="fdate" class="date_no" value="<?php echo $fday ?>" type="text" size="13"name="fdate" readonly="readonly" /></td><td><input type="image" alt="" src="/assets/_GlobalResources/Images/cal.gif" id="fdate_trigger" title="Date selector"style="margin: 0px; cursor: pointer" onclick="javascript:return false;" /><!-- <img alt="" src="https://mb.b88ag.com/_GlobalResources/Images/cal.gif" id="fdate_trigger" title="Date selector"style="margin: 0px; cursor: pointer" /> --></td></tr></table><script type="text/javascript">function CalendarOnSelect() {if($("ddlSelectDate"))$("ddlSelectDate").value = 8;}var fdate = Calendar.setup({animation:false,trigger: "fdate_trigger",inputField: "fdate",min: 20140901,max: <?php echo time(); ?>,dateFormat: "%m/%d/%Y",weekNumbers:true,onSelect: function() {CalendarOnSelect();this.hide();}});</script></span>
                                                    </td>
                                                    <td id="tdtdatetext" class="l">&nbsp;&nbsp; <span id="sptdatetext">đến:</span>
                                                    </td>
                                                    <td id="tdToDateCal" class="l"><span id="spToDateCal"><table cellpading="0" cellspacing="0" border="0"><tr><td><input id="tdate" class="date_no" value="<?php echo $tday; ?>" type="text" size="13"name="tdate" readonly="readonly" /></td><td><input type="image" alt="" src="/assets/_GlobalResources/Images/cal.gif" id="tdate_trigger" title="Date selector"style="margin: 0px; cursor: pointer" onclick="javascript:return false;" /><!-- <img alt="" src="/_GlobalResources/Images/cal.gif" id="tdate_trigger" title="Date selector"style="margin: 0px; cursor: pointer" /> --></td></tr></table><script type="text/javascript">function CalendarOnSelect() {if($("ddlSelectDate"))$("ddlSelectDate").value = 8;}var tdate = Calendar.setup({animation:false,trigger: "tdate_trigger",inputField: "tdate",min: 20140901,max: 99991231,dateFormat: "%m/%d/%Y",weekNumbers:true,onSelect: function() {CalendarOnSelect();this.hide();}});</script></span>
                                                    </td>
                                                    <td class="l">&nbsp;&nbsp;
                                                        <input type="button" class="btn" style="width: 55px" id="dSubmit" value="Xác nhận" onclick="DisableButton(); Winloss_SearchByDate(null, null, null, null);" />&nbsp;
                                                        <input type="button" id="dToday" class="btn" style="width: 80px" value="<?php echo $fday ?>" onclick="DisableButton(); Winloss_SearchOneDay(this);" />&nbsp;
                                                        <input type="button" id="dYesterday" class="btn" style="width: 80px" value="<?php echo $tday ?>" onclick="DisableButton(); Winloss_SearchOneDay(this);" />
                                                    </td>
                                                    <td valign="top">
                                                        <div id="loading" class="" style="float: left;"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td align="right">
                                        <input type="checkbox" id="chk_rpt_bold" onclick="boldTable(this.checked);" />
                                        <label for="chk_rpt_bold" style="color: #999; text-transform: none;font-weight:bold;line-height:18px;">Bold</label>&nbsp;
                                        <input alt="Xuất sang Excel" src="/assets/_GlobalResources/Images/excel.gif" type="image" id="exporttoexcel" name="exporttoexcel" nofocus="true" title="Xuất sang Excel" class="hand" />
                                    </td>
                                </tr>
                            </table>
                            <div id="reportFilter">
                                <input type="checkbox" id="chk_all" name="chk_all" onclick="CheckAll()" checked/>
                                <label for="chk_all">Tất cả</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="chk_showsb" name="chk_showsb" onclick="IsCheck()" checked/>
                                <label for="chk_showsb">SB</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="chk_showcasino" name="chk_showcasino" onclick="IsCheck()" checked/>
                                <label for="chk_showcasino">Casino</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="chk_showrb" name="chk_showrb" onclick="IsCheck()" checked/>
                                <label for="chk_showrb">Racing</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="chk_showng" name="chk_showng" onclick="IsCheck()" checked/>
                                <label for="chk_showng">Number Game</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="chk_showbi" name="chk_showbi" onclick="IsCheck()" checked/>
                                <label for="chk_showbi">Bingo</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="chk_showp2p" name="chk_showp2p" onclick="IsCheck()" checked/>
                                <label for="chk_showp2p">Poker</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="chk_showlivecasino" name="chk_showlivecasino" onclick="IsCheck()" checked/>
                                <label for="chk_showlivecasino">Live Casino</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="chk_showvs" name="chk_showvs" onclick="IsCheck()" checked/>
                                <label for="chk_showvs">Virtual Sports</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" id="chk_showkeno" name="chk_showkeno" onclick="IsCheck()" checked/>
                                <label for="chk_showkeno">Keno</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="hidden" name="FilterPostback" id="FilterPostback" value="postback" />
                            </div>
                            <div id="dvMsg" class="warning l" style="margin-bottom: 5px; margin-top: 10px; padding:0 2px;">
                                <ul>
                                    <li><span id="spMsg">Bạn có thể tra cứu dữ liệu báo cáo từ ngày 09/01/2014.Nếu muốn tìm kiếm những dữ liệu cũ hơn Bấm <a href ='#' onclick='ViewHistory();'>Xem báo cáo trước đó</a></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="tbl-container">
                            <div id="boderRight">
                                <table class="tblRpt " width="100%" style="min-width:800px; display:none" border="0" cellpadding="0" cellspacing="1" id="tbl-rpt">
                                    <tr id="rowTitle" class="RptTitle">
                                        <td id="content_title" colspan="11">Chi tiết thắng thua của Member <span id='spSumaryDate'><?php echo $fday ?>--&gt;<?php echo $tday ?></span>
                                        </td>
                                    </tr>
                                    <tr class="RptHeader">
                                        <td rowspan="2" columnname="username">Tài khoản</td>
                                        <td rowspan="2" columnname="noofticket">Số trận cược</td>
                                        <td rowspan="2" columnname="turnover">Tiền Cược</td>
                                        <td rowspan="2" columnname="grosscomm">Hoa Hồng</td>
                                        <td colspan="3">Member</td>
                                        <td colspan="3">Agent</td>
                                        <td rowspan="2" columnname="company">Company</td>
                                    </tr>
                                    <tr class="RptHeader02">
                                        <td columnname="memberwinlost">Thắng / Thua</td>
                                        <td columnname="playercomm">Hoa hồng</td>
                                        <td columnname="membertotal">Tổng cộng</td>
                                        <td columnname="agwinlost">Thắng / Thua</td>
                                        <td columnname="agcomm">Hoa hồng</td>
                                        <td columnname="agtotal">Tổng cộng</td>
                                    </tr>
									
									<?php 
									$totalMarket = 0;
									$TotalBPstake = 0;
									$totalMemBerWinLost = 0;
									$totalCompany = 0;
									$totalGross = 0;
									$totalEarn = 0;
									foreach($data as $user)
									{ 
										$userCom = 0;
										$userEarn = 0;
										
									?>
									<?php 

											$ffDate = strtotime($fday." 00:00:00");
											$ttDate = strtotime($tday." 23:59:59");
											$criteria = new CDbCriteria();
											if($type=="ProSuperMaster")
											{
												$criteria->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2 AND username IN (SELECT username FROM tbl_user WHERE parentUser in(SELECT Id From table_admin WHERE `role` = 'agent' AND parentUser IN (SELECT Id From table_admin WHERE `role` = 'master' AND parentUser = :userId)))";
												$criteria->params = array(":start"=>$ffDate,':end'=>$ttDate,':status'=>'running',":userId"=>$user->Id,":status2"=>"waiting");
											}
											elseif($type=="superMaster")
											{
												
												$criteria->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2 AND username IN (SELECT username FROM tbl_user WHERE parentUser in(SELECT Id From table_admin WHERE `role` = 'agent' AND parentUser = :userId))";
												$criteria->params = array(":start"=>$ffDate,':end'=>$ttDate,':status'=>'running',":userId"=>$user->Id,":status2"=>"waiting");
												
											}
											elseif($type=="master")
											{
												$criteria->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND lbloddsStatus != :status2 AND username IN (SELECT username FROM tbl_user WHERE parentUser = :userId)";
												$criteria->params = array(":start"=>$ffDate,':end'=>$ttDate,':status'=>'running',":userId"=>$user->Id,":status2"=>"waiting");
											}
											
											//$criteria->condition = "timeUpdate >= :start AND timeUpdate <= :end AND lbloddsStatus != :status AND username IN (SELECT username FROM tbl_user WHERE parentUser in(SELECT Id From table_admin WHERE `role` = 'agent' AND parentUser IN (SELECT Id From table_admin WHERE `role` = 'master' AND parentUser = :userId)))";
											$criteria->limit = 1000;
											$criteria->select = array("winLost","BPstake","com");
											$criteria->order = "Id DESC";
											//$criteria->params = array(":start"=>$ffDate,':end'=>$ttDate,':userId'=>$user->Id,':status'=>'running');
											$winlost = betData::model()->findAll($criteria);
											$dataAll = 0;
											$totalBet = 0;
											$totalMarket += count($winlost);
											foreach($winlost as $wl)
											{
											
												$dataAll += $wl->winLost;
												$totalBet += $wl->BPstake;
												if($wl->winLost!=0)
												{
													$userCom += $wl->com;
												}
												
												
											
											}
											$TotalBPstake += $totalBet;
											$totalMemBerWinLost += $dataAll;
											$totalGross += $userCom;
											//$totalEarn = $totalEarn+$totalGross + $dataAll;
											$userEarn = $dataAll + $userCom;
											$totalEarn += $userEarn;

										?>
									<?php if($totalBet>0){ ?>
										<tr bgcolor="#F6F8F9" onmouseover="this.style.backgroundColor='#f8ff8d'" onmouseout="this.style.backgroundColor='#F6F8F9'">
											<td class="left_normal"><span onclick="ViewDownlineWLReport('<?php echo $fday ?>','<?php echo $tday ?>','15695963','/azkv.php?r=site/DetailWinLost&type=<?php echo $user->role; ?>&username=<?php echo $user->Id ?>','<?php echo $user->Username ?>');" class="downline_link"><?php echo $user->Username ?></span>
											</td>
											
											<td><?php echo count($winlost) ?></td>
											<td><?php echo $totalBet ?></td>
											<td><?php echo number_format($userCom,2) ?></td>
											<td><?php echo $dataAll ?></td>
											<td><?php echo number_format($userCom,2) ?></td>
											<td class="b"><?php echo number_format(($userEarn),2) ?></td>
											<td class="altercol">0.00</td>
											<td class="altercol">0.00</td>
											<td class="altercol_bold">0.00</td>
											<td><?php echo number_format(-($userEarn),2) ?></td>
										</tr>
										<?php }?>
									<?php }?>
								   <tr class="RptFooter">
                                        <td class="l">Tổng cộng</td>
                                        <td><?php echo  $totalMarket ?></td>
                                        <td><?php echo number_format($TotalBPstake,2) ?></td>
                                        <td><?php echo number_format($totalGross,2) ?></td>
                                        <td><?php echo number_format($totalMemBerWinLost,2) ?></td>
                                        <td><?php echo number_format($totalGross,2) ?></td>
                                        <td><?php echo number_format($totalEarn,2) ?></td>
                                        <td class="altercol_master">0.00</td>
                                        <td class="altercol_master">0.00</td>
                                        <td class="altercol_master">0.00</td>
                                        <td><?php echo number_format(-$totalEarn,2) ?></td>
                                    </tr>
                                </table>
                                <link href="/assets/stylesheets/agent/Paging.css?20141215" rel="stylesheet" type="text/css" />
                                <script src="/assets/js/bet/Paging.js?20141215" type="text/javascript"></script>
                                <div id="WinlossDetailSuper_Paging" class="pagingHiden" pagesize="1000" currentindex="1" rowcount="11" pagecount="1">
                                    <input disabled id="btnFirstWinlossDetailSuper_Paging" type="button" onclick="WinlossDetailSuper_Paging.First()" class="icon pagingFirst" />
                                    <input disabled id="btnPrevWinlossDetailSuper_Paging" type="button" onclick="WinlossDetailSuper_Paging.Move(-1)" class="icon pagingPrev" /><span class="pagingSeperator"></span>Trang
                                    <input id="txtWinlossDetailSuper_Paging" type="text" class="pagingCurrent" maxlength="4" size="2" value="1" onkeydown="WinlossDetailSuper_Paging.DoEnter(event, 'WinlossDetailSuper_Paging.Go()')" />of 1<span class="pagingSeperator"></span>
                                    <input disabled id="btnNextWinlossDetailSuper_Paging" type="button" onclick="WinlossDetailSuper_Paging.Move(1)" class="icon pagingNext" />
                                    <input disabled id="btnLastWinlossDetailSuper_Paging" type="button" onclick="WinlossDetailSuper_Paging.Last()" class="icon pagingLast" />
                                    <select id="selWinlossDetailSuper_Paging" name="selWinlossDetailSuper_Paging" onchange="WinlossDetailSuper_Paging.SetPageSize(this.value)">
                                        <option value="1000" selected>1000</option>
                                        <option value="2000">2000</option>
                                        <option value="3000">3000</option>
                                        <option value="4000">4000</option>
                                        <option value="5000">5000</option>
                                    </select>
                                </div>
                                <script type="text/javascript">
                                    var WinlossDetailSuper_Paging = new Paging('WinlossDetailSuper_Paging');
                                </script>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <input type="hidden" name="CustId" id="CustId" value="<?php echo Yii::app()->user->getId(); ?>" />
        <input type="hidden" name="IsHistoryReport" id="IsHistoryReport" value="0" />
        <input type="hidden" name="IsSwitch" id="IsSwitch" value="0" />
        <input type="hidden" name="OldView" id="OldView" value="" />
        <input type="hidden" name="UserName" id="UserName" value="<?php echo $username ?>" />
        <input type="hidden" name="Type" id="Type" value="WLByDate" />
		<input type="hidden" name="type" id="type" value="<?php echo $type ?>" />
        <input type="hidden" name="WorkOnOldBetList" id="WorkOnOldBetList" value="1" />
		
    </form>
</body>
<script src="/assets/js/bet/Core.js?20141215" type="text/javascript"></script>
<script src="/assets/js/bet/Reports.js?20141215" type="text/javascript"></script>

</html>
<script type="text/javascript">
    var _page = {
        'FilterCollection': ['chk_all', 'chk_showsb', 'chk_showcasino', 'chk_showrb', 'chk_showng', 'chk_showbi', 'chk_showp2p', 'chk_showlivecasino', 'chk_showvs', 'chk_showkeno'],
        'FilterStatusCollection': ['on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on'],
        'CustId': <?php echo Yii::app()->user->getId(); ?>,
        'ReportRowCount': 11,
        'SortingColumn': '',
        'SortingUp': true,
        'SortingEnabled': true,
        '_date': '<?php echo date('m/d/Y') ?>',
        'RoleId': 2
    };
</script>