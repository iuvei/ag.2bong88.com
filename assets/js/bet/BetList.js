﻿function ShowResultWithPicture(showpic) {
    var url = location.href;
    location.href = SetParameterValue("showpic", showpic, url);
}

function ViewBingoDetail(userId) {
    var url = age.GetBaseUrl() + '_BetList/BingoResultDetail.aspx';
    url = SetParameterValue("userbetid", userId, url);
    if (parent.ageWnd) {
        parent.ageWnd.open(url, '', 50, 30, 550, 660);
    } else {
        ageWnd.open(url, '', 50, 30, 550, 660);
    }
}

function ViewBallNo(id) {
    // Hide others
    for (var i = 0; i < 100; i++) {
        if ('ballNo' + i == id) {
            continue;
        }

        if (document.getElementById('ballNo' + i)) {
            document.getElementById('ballNo' + i).style.display = 'none';
        } else {
            break;
        }
    }

    var display = document.getElementById(id).style.display == 'none';
    document.getElementById(id).style.left = '190px';
    document.getElementById(id).style.display = display ? 'block' : 'none';
}

function ViewHandHistory(custid, ibcrefno, currency, tableId, tableName, tournamentId, tournamentName, gameType, betType, date) {
    var url = '../P2P/HandHistory.aspx?custid=' + custid + '&ibcrefno=' + ibcrefno + '&currency=' + currency + '&tableid=' + tableId + '&tablename=' + tableName + '&tournamentid=' + tournamentId + '&tournamentname=' + tournamentName + '&gametype=' + gameType + '&bettype=' + betType + '&Date=' + date;
    window.location.href = url;
}

function ViewHandHistoryDetail(custid, handNo, handType, currency) {
    var url = '../P2P/HandHistoryDetail.aspx?custid=' + custid + '&handno=' + handNo + '&handtype=' + handType + '&currency=' + currency;
    window.location.href = url;
}

function ViewCommissionDetail(ibcrefno, currency, tableId, tableName, tournamentId, tournamentName, gameType, betType) {
    var url = '../P2P/CommissionDetail.aspx?ibcrefno=' + ibcrefno + '&currency=' + currency + '&tableid=' + tableId + '&tablename=' + tableName + '&tournamentid=' + tournamentId + '&tournamentname=' + tournamentName + '&gametype=' + gameType + '&bettype=' + betType;
    window.location.href = url;
}

function ViewBetSlip(transid, winlostdate, isrunning, league) {
    var width = 660;
    var height = 190;
    var url = '_BetList/BetSlip.aspx?TransID=' + transid + '&winlostdate=' + winlostdate + '&IsRunning=' + isrunning + '&league=' + league;
    if (parent.ageWnd) {
        parent.ageWnd.open(age.GetBaseUrl() + url, '', 50, 100, width, height);
    }
    else {
        ageWnd.open(age.GetBaseUrl() + url, '', 50, 100, width, height);
    }
}

function ViewResult(matchid, race, bettype, sporttype, refno, username, winlostdate, refno_mixparlay, league, is_outright, betid) {
	if (bettype == 71 || bettype == 72) { // Casino Games & Casino Progressive Bonus
        ViewCasinoResult(refno, bettype, username);
    } else if (bettype == 73) {
        ViewBingoResult(refno, username);
    } else if (bettype == 9 || bettype == 29) {//view mix parlay & combination mix parlay
        ViewMixParlayResult(refno_mixparlay, winlostdate, bettype);
    } else if (bettype == 1000 || bettype == 1001 || bettype == 1002) {  // P2P Game
        ViewP2PResult(refno, bettype, username);
    } else {
        ViewSportBookResult(matchid, bettype, race, sporttype, league, is_outright, refno, betid);
    }
}

function ViewMixParlayResult(refno, winlostdate, bettype) {
    //var width = 730;
    //var height = 450;

    var width = 800;
    var height = 500;
    var params = '?refnum=' + refno + '&wldate=' + winlostdate + "&bettype=" + bettype + '&matchid=1';
    if (ageWnd.loaded) {
        ageWnd.close();
    }
    ageWnd.open(age.GetBaseUrl() + 'Report/Result/GetResult' + params, '', 50, 100, width, height);
}

function ViewSportBookResult(matchid, bettype, race, sporttype, league, is_outright, refNo, betid) {
    var width = 730;
    var height = 250;
    var params = '&matchid=' + matchid + '&bettype=' + bettype + '&race=' + race + '&sportId=' + sporttype + '&leagueId=' + league + '&isOutright=' + is_outright + '&refnum=' + refNo + '&betid=' + betid;

    if (parent.ageWnd) {
        parent.ageWnd.open(age.GetBaseUrl() + 'azkv.php?r=betData/result' + params, '', 50, 100, width, height);
    }
    else {
        ageWnd.open(age.GetBaseUrl() + 'Report/Result/GetResult' + params, '', 50, 100, width, height);
    }
}

function ViewP2PResult(refno, bettype, uname) {
    var params = '?typegame=p2pgame&ibcrefno=' + refno + '&bettype=' + bettype + '&uname=' + uname;
    params = SetParameterValue('custid', _page.CustId, params);
    params = SetParameterValue('fdate', _page.fdate, params);
    params = SetParameterValue('tdate', _page.tdate, params);

    var url = age.GetBaseUrl() + '_BetList/P2P/TableSession.aspx' + params;
    window.location.href = url;
}

function ViewCasinoResult(refno, bettype, uname) {
    var params = '?typegame=casinogame&ibcrefno=' + refno + '&bettype=' + 'Casino' + '&uname=' + uname;

    if (_page.type != null) {
        var arrayStatusItem = _page.FilterStatusCollection;

        params = SetParameterValue('type', _page.type, params);
        params = SetParameterValue('custid', _page.CustId, params);

        if (arrayStatusItem != null) {
            params = SetParameterValue('showSB', arrayStatusItem[1] == "on" ? "1" : "0", params);
            params = SetParameterValue('showCasino', arrayStatusItem[2] == "on" ? "1" : "0", params);
            params = SetParameterValue('showRB', arrayStatusItem[3] == "on" ? "1" : "0", params);
        }
        params = SetParameterValue('fdate', _page.fdate, params);
        params = SetParameterValue('tdate', _page.tdate, params);
        params = SetParameterValue('isHistoryReport', _page.isHistoryReport, params);
    }
    // var url = age.GetBaseUrl() + 'BetList/ViewCasinoResult.aspx' + params;
    var url = age.GetBaseUrl() + 'RnGCasino/HandHistory' + params;
    window.location.href = url;
}

function ViewBingoResult(refno, uname) {
    var params = '?ibcrefno=' + refno + '&uname=' + uname;
    //include hidden fields for returning back
    if ($('_type') != null) {
        var arrayStatusItem = _page.FilterStatusCollection;

        params = SetParameterValue('type', _page.type, params);
        params = SetParameterValue('custid', _page.CustId, params);

        if (arrayStatusItem != null) {
            params = SetParameterValue('showSB', arrayStatusItem[1] == "on" ? "1" : "0", params);
            params = SetParameterValue('showCasino', arrayStatusItem[2] == "on" ? "1" : "0", params);
            params = SetParameterValue('showRB', arrayStatusItem[3] == "on" ? "1" : "0", params);
        }
        params = SetParameterValue('fdate', _page.fdate, params);
        params = SetParameterValue('tdate', _page.tdate, params);
        params = SetParameterValue('isHistoryReport', _page.isHistoryReport, params);
    }

    var url = age.GetBaseUrl() + '_BetList/BingoResult.aspx' + params;
    window.location.href = url;
}

function showMP(transid) {
    var divEvent = $('divEvent_' + transid);
    if (divEvent.style.display == 'none') {
        if (divEvent.innerHTML == "") {
            ajax.Request(age.GetBaseUrl() + "_BetList/MixParlay/MixParlay.aspx", { method: 'get', parameters: 'transid=' + transid,
                onComplete: function (data) {
                    divEvent.innerHTML = data.responseText;
                    divEvent.style.display = '';
                }
            })
        }
        else {
            divEvent.style.display = '';
        }
    }
    else {
        divEvent.style.display = 'none';
    }
}

function showCombMP(transid, orderID) {
    var divEvent = $('divEvent_' + transid + orderID);
    if (divEvent.style.display == 'none') {
        if (divEvent.innerHTML == "") {
            ajax.Request(age.GetBaseUrl() + "_BetList/MixParlay/CombinationMixParlay.aspx", { method: 'get', parameters: 'transid=' + transid,
                onComplete: function (data) {
                    divEvent.innerHTML = data.responseText;
                    divEvent.style.display = '';
                }
            })
        }
        else {
            divEvent.style.display = '';
        }
    }
    else {
        divEvent.style.display = 'none';
    }
}

function showCombMPDetail(refno, winlostdate, transid, betid, custid) {
    var width = 750;
    var height = 350;
    var params = '?refno=\'' + refno + '\'&wldate=' + winlostdate + '&transid=' + transid + '&betid=' + betid + '&custid=' + custid;

    if (parent.ageWnd) {
        parent.ageWnd.open(age.GetBaseUrl() + '_BetList/MixParlay/CombinationMixParlayDetail.aspx' + params, '', 50, 100, width, height);
    }
    else {
        ageWnd.open(age.GetBaseUrl() + '_BetList/MixParlay/CombinationMixParlayDetail.aspx' + params, '', 50, 100, width, height);
    }
}

function InitExcelFunction() {
    var exportExcelImg = $("exporttoexcel");
    if (exportExcelImg) {
        function exportExcelImg_OnClick(ev) {
            var url = location.href;
            url = SetParameterValue('exporttoexcel.x', 4, url);
            url = SetParameterValue('exporttoexcel.y', 8, url);
            location.href = url;

            if (IE) {
                window.event.cancelBubble = true;
                window.event.returnValue = false;
            } else {
                ev.preventDefault();
                ev.stopPropagation();
            }
        }

        age.addEvent(exportExcelImg, 'click', exportExcelImg_OnClick);

        exportExcelImg.onblur = function () {
            $("exporttoexcel").focused = false;
        }
        exportExcelImg.onfocus = function () {
            $("exporttoexcel").focused = true;
        }
    }
}

function InitBetList() {
    var ageWnd = parent.ageWnd;
    if (typeof ageWnd != 'undefined' && ageWnd.loaded) {
        ageWnd.setRect(ageWnd.left, 50, 900, 350);  // to fix the popup when click "Bet List" link
        $("exportExcelDiv").style.visibility = "hidden";
    }

    InitExcelFunction();
}

function OpenIPInfo(ip) {
    ageWnd.open(age.GetBaseUrl() + '_IPInfo/IpInfo.aspx?ip=' + ip, '', 300, 100, 400, 170);
}

function OpenScoreMap(matchIds, bettype, liveindicator) {
    var wnd = parent.ageWnd ? parent.ageWnd : ageWnd;
    if (liveindicator == 1)
        wnd.open(age.GetBaseUrl() + "_Forecast/ScoreMap.aspx?leagueId=-1&matchIds=" + matchIds + "&bettypes_live=" + bettype + "&bettypes_dead=-1", '', 50, 20, 1008, 480);
    else
        wnd.open(age.GetBaseUrl() + "_Forecast/ScoreMap.aspx?leagueId=-1&matchIds=" + matchIds + "&bettypes_live=-1&bettypes_dead=" + bettype, '', 50, 20, 1008, 480);
}

RegisterStartUp(InitBetList);