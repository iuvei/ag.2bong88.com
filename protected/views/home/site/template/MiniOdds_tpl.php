
<div>
<script id="minioddstmpl" type="text/x-jquery-tmpl">
<ul>
{{each(i,Sport) data}}
      <li><a id="miniodds_${Sport.SportID}" title="${Sport.SportName}" class="navon">${Sport.SportName}</a> 
        <!-- Begin -- Open Mini Odds Content -->
        <div class="miniContent">
  {{each(j,Match) Sport.matchs}}          
          <table width="100%" cellspacing="0" cellpadding="0" border="0" class="oddsTable">
            <tbody>
              <tr>
                <td class="tabtitle" colspan="2">{{if Match.Bettype==1}}FT. HDP{{else}}Moneyline{{/if}}</td>
              </tr>
                <tr>
                <td class="miniLeague" colspan="2"><div class="text-ellipsis" title="${Match.League}">${Match.League}</div></td>
              </tr>

              <tr class="{{if Match.IsLive==1}}liveligh{{else}}bgcpe{{/if}}">
                <td colspan="2" class="miniTeamClass" >
                   <table width="100%" cellspacing="0" cellpadding="0" border="0">
                     <tr>
                      <td width="33%"><div name="teamName" style="height:35px;width:50px"><span class="{{if Match.Fav=='h'}}FavTeamClass{{else}}UdrDogTeamClass{{/if}}" style="text-overflow: ellipsis" title="${Match.HName}" >${Match.HName}</span></div></td>                      
                      {{if Match.IsLive==1}}           
                          {{if Sport.SportID ==1 || Sport.SportID ==8 || Sport.SportID ==2 || Sport.SportID ==6 || Sport.SportID ==3 || Sport.SportID ==4 ||Sport.SportID ==9 || Sport.SportID ==5 || Sport.SportID ==28 || Sport.SportID ==26 || Sport.SportID ==7 || Sport.SportID ==27}}
                               {{if Sport.SportID ==2 || Sport.SportID ==6}}
                                    <td class="liveodds" width="33%">
                                    {{if Match.TSuspend==1}}                         
                                        <div class="HalfTime">T.Out</div>                                    
                                    {{/if}}     
                                   <div class="{{if Match.IsHT}}HalfTime{{else}}FavTeamClass{{/if}}">{{html Match.Time}}</div></td>
                               {{/if}}
                               
                               {{if Sport.SportID ==3 || Sport.SportID ==4 || Sport.SportID ==28 || Sport.SportID ==26 || Sport.SportID ==27}}
                                    
                                    {{if Match.TSuspend==1}}               
                                        <td class="liveodds" width="33%">          
                                        <div class="HalfTime">T.Out</div>   
                                    {{else}}              
                                        <td class="liveodds{{if Match['Scorechg']}} Odds_Upd{{/if}}" width="33%">               
                                        <div> ${Match.ScoreH}-${Match.ScoreA}</div>                                                      
                                    {{/if}}     
                                   <div class="{{if Match.IsHT}}HalfTime{{else}}FavTeamClass{{/if}}">{{html Match.Time}}</div></td>
                               {{/if}}     
                               
                               {{if Sport.SportID ==9 || Sport.SportID ==5}}
                                    <td class="liveodds" width="33%">
                                    {{if Match.TSuspend==1}}                         
                                        <span class="iconInfo rain"></span>                                                                           
                                    {{/if}}     
                                   <div class="{{if Match.IsHT}}HalfTime{{else}}FavTeamClass{{/if}}">{{html Match.Time}}</div></td>
                               {{/if}}                                                           
                               {{if Sport.SportID ==1}}
                                    <td class="liveodds{{if Match['Scorechg']}} Odds_Upd{{/if}}" width="33%">
                                    <div> ${Match.ScoreH}-${Match.ScoreA}</div>
                                    {{if Match.TSuspend==1}}                         
                                        <div class="IsLive" title="In Running">IR</div>   
                                    {{else}}                             
                                        <div class="{{if Match.IsHT}}HalfTime{{else}}FavTeamClass{{/if}}">{{html Match.Time}}</div></td>                                                      
                                    {{/if}}     
                                                                  
                               {{/if}}
                               {{if Sport.SportID ==8}}
                                    <td class="liveodds{{if Match['Scorechg']}} Odds_Upd{{/if}}" width="33%">
                                    {{if Match.TSuspend==1}}                         
                                        <span class="iconInfo rain"></span>  
                                    {{/if}}                             
                                    <div> ${Match.ScoreH}-${Match.ScoreA}</div>
                               {{/if}}
                                
                                {{if Sport.SportID ==7}}
                                    <td class="liveodds{{if Match['Scorechg']}} Odds_Upd{{/if}}" width="33%">
                                    {{if Match.TSuspend==1}}                         
                                        <span class="iconInfo break"></span>  
                                    {{/if}}
									<div class="{{if Match.IsHT}}HalfTime{{else}}FavTeamClass{{/if}}">{{html Match.Time}}</div></td>
                               {{/if}}

                          {{else}}                          
                              
                              {{if Sport.HideScore==0}}
                                 <td class="liveodds{{if Match['Scorechg']}} Odds_Upd{{/if}}" width="33%">
                                 <div> ${Match.ScoreH}-${Match.ScoreA}</div>
                              {{else}}
                                 <td class="liveodds" width="33%">    
                              {{/if}}
                              <div class="{{if Match.IsHT}}HalfTime{{else}}FavTeamClass{{/if}}">{{html Match.Time}}</div></td>
                          {{/if}}                         
                          
                      {{else}}
                      <td class="liveodds" width="33%"> 
                        {{html Match.Time}}
                        
                      {{/if}}                     
                      </td>                        
                      <td width="33%"><div name="teamName" style="height:35px;width:50px"><span class="{{if Match.Fav=='a'}}FavTeamClass{{else}}UdrDogTeamClass{{/if}}"  style="text-overflow: ellipsis" title="${Match.AName}">${Match.AName}</span></div></td>
                    </tr>
                  </table></td>
              </tr>
            </tbody>
            <tbody>
              <tr align="center">
                <th width="50%" nowrap="nowrap" class="even{{if Match['Hdpchg']}} Odds_Upd{{/if}}">{{if Match.Fav=='h'}}-{{/if}}{{if Match.Fav=='a'}}+{{/if}}${Match.Hdp}</th>
                <th width="50%" nowrap="nowrap" class="even{{if Match['Hdpchg']}} Odds_Upd{{/if}}">{{if Match.Fav=='a'}}-{{/if}}{{if Match.Fav=='h'}}+{{/if}}${Match.Hdp}</th>
              </tr>
              <tr align="center" class="{{if Match.IsLive==1}}liveligh{{else}}bgcpe{{/if}}" >
                <td {{if Match.OddsH!=""}}onClick="javascript:fFrame.topFrame.miniOddsObj.clickOdds('${Match.Oddsid}','h','${Match.OddsH}')" style="cursor: pointer;"{{/if}} onmouseover="this.style.backgroundColor='#f5eeb8';" onmouseout="this.style.backgroundColor='';" class="nbsp{{if Match.Ischg}} Odds_Upd{{/if}}" ><span class="{{if parseFloat(Match.OddsH) <0}}FavOddsClass{{else}}UdrDogOddsClass{{/if}}">${Match.OddsH}</span></td>
                <td {{if Match.OddsA!=""}}onClick="javascript:fFrame.topFrame.miniOddsObj.clickOdds('${Match.Oddsid}','a','${Match.OddsA}')" style="cursor: pointer;"{{/if}} onmouseover="this.style.backgroundColor='#f5eeb8';" onmouseout="this.style.backgroundColor='';" class="nbsp{{if Match.Ischg}} Odds_Upd{{/if}}" ><span class="{{if parseFloat(Match.OddsA) <0}}FavOddsClass{{else}}UdrDogOddsClass{{/if}}">${Match.OddsA}</span></td>
              </tr>
            </tbody>
          </table>
{{/each}}
        </div>
        <!-- End -- Open Mini Odds Content --> 
      </li>
{{/each}}      
{{if data.length ==0}}
   <li>There are no games available at the moment.</li>
{{/if}}

    </ul>

</script>

<script id="minioddsDiv" type="text/x-jquery-tmpl">
<div class="sidebar">
  
  <div class="title">
  	<span title="News & Gaming"><div class="icon-arrow"></div>News & Gaming</span>
  </div>
  <div class="gaming container">
      <ul>
        <!-- if no news set class=disable  Otherwise class=tip-new-->
        <li title="More Info" class="tip-new"><div class="icon new"></div><span>News</span></li>
        <li title="More Info" onclick="javascript:checkiconClass();"><div class="icon bingo"></div><span>Bingo</span></li>
        <li title="More Info" onclick="javascript:checkiconClass();"><div class="icon casino"></div><span>Casino</span></li>
        <li title="More Info" onclick="javascript:checkiconClass();"><div class="icon liveCasino"></div><span>Live Casino</span></li>
        <li title="More Info" onclick="javascript:checkiconClass();"><div class="icon numberGame"></div><span>Number Game</span></li>
        <li title="More Info" onclick="javascript:checkiconClass();"><div class="icon miniGame"></div><span>Mini Game</span></li>
      </ul>
   </div>
	  <div class="promotion-banner">
		<a href="#" class="close" title="Close">X</a>
		<span class="arrow"></span>
		<ul>
			<li>
				<ul class="banner-content">
					<!--<li><span class='corner-ribbon sportsbook'></span><a href='#'><img src='template/sportsbook/en/images/product/ad_LiveChart.jpg'></a></li>-->
<li><span class='corner-ribbon sportsbook'></span><a href='#'><img src='/images/ad_TennisNewBetTypes.jpg'></a></li>
<li><span class='corner-ribbon sportsbook'></span><a href='#'><img src='/images/ad_E-Sports.jpg?v=20140917002'></a></li>
<!--<li><span class='corner-ribbon sportsbook'></span><a href='#'><img src='template/sportsbook/en'></a></li>-->
                
				</ul>
			</li>
			<li>
				<div class="gaming-content bingo">
					<dl>
						<dt class="title"></dt>
						<dt class="text01"></dt>
						<dt class="text02"></dt>
						<dt class="text03"></dt>
						<dt class="btn"><a href="javascript:parent.topFrame.openCasinoBingoFromMini();">Play Now</a></dt>
					</dl> 
				</div>
			</li>
			<li>
				<div class="gaming-content casino">
					<dl>
						<dt class="title"></dt>
						<dt class="text01"></dt>
						<dd class="text02"></dd>
						<dd class="text03"></dd>
						<dd class="text04"></dd>
						<dt class="text05"></dt>
						<dt class="btn"><a href="javascript:parent.topFrame.OpenCasino();">Play Now</a></dt>
					</dl>
				</div>
			</li>
			<li>
				<div class="gaming-content liveCasino">
					<dl>
						<dt class="title"></dt>
						<dt class="text01"></dt>
						<dd class="text02"></dd>
						<dd class="text03"></dd>
						<dt class="text04"></dt>
						<dd class="text05"></dd>
						<dt class="btn"><a href="javascript:parent.topFrame.OpenLiveCasinoWindowFromMini();">Play Now</a></dt>
					</dl>
				</div>
			</li>
			<li>
				<div class="gaming-content numberGame">
					<dl>
						<dt class="title"></dt>
						<dt class="text01"></dt>
						<dt class="text02"></dt>
						<dt class="text03"></dt>
						<dt class="text04"></dt>
						<dt class="btn"><a href="javascript:parent.topFrame.openNumberGmeFromMini();">Play Now</a></dt>
					</dl>
				</div>
			</li>
			<li>
				<div class="gaming-content miniGame">
					<dl>
						<dt class="title"></dt>
						<dt class="text01"></dt>
						<dd class="text02"></dd>
						<dd class="text03"></dd>
						<dt class="text04"></dt>
						<dt class="btn"><a href="javascript:parent.leftFrame.OpenMiniGame();">Play Now</a></dt>
					</dl>
				</div>
			</li>
		</ul>
  </div>
  
  <div class="title">
    <span title="Mini Odds">
      <div class="icon-arrow"></div>
      Mini Odds
      <a id="btnMiniOddsRefresh" class="btnIcon right" title="Refresh" onclick="fFrame.topFrame.miniOddsObj.Refresh();">
         <span class="icon-refresh"></span>
      </a>
    </span>
  </div>
  <div id="minioddCcontainer" class="miniodds container">    
  </div>
</div>
</script>

</div>