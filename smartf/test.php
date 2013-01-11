
localhost/smartf/input/post?json={power-generated:450,power-consumed:450,power-cost:10,power-light:20, power-heating:50,power-wind:20,power-solar:30,power-wind:10,power-net:100,power-grid:10,ev-charge:40,temp:20}

<div id="button-top" class="btn-group">
  <button id="btn-cost"  class="btn active">cost</button>
  <button id="btn-kw" class="btn">Kwh</button>
  <button id="btn-co" class="btn">CO2</button>
</div>

<a id="powergen" href="#" class="btn btn-large">Power Generated</a>
<a id="powercon" href="#" class="btn btn-large">Power Consumed</a>

<span class="label label-success">Power Saved today: 4€</span><span class="label label-success">Total Power saved this month: 20€</span>

<div id="holder">
<div class="progress progress-danger progress-striped" id="ev-charge" style="height:30px">
  <div class="bar" style="width: 20%"></div></div>E-Vehicle charge : 20% </div>
<div id="holder1">
<div class="progress progress-success progress-striped" id="solar-charge" style="height:30px">
  <div class="bar" style="width:80%"></div></div> Battery level : 80% </div>
  
  
<div class="well alert-info" id="monthlystatus"> Power Saved Today : 6 Euros <br/> Monthly Power Saving : 50 Euros </div>


<object type="text/html" data="http://localhost/smartf/vis/multigraph?apikey=586ac9eca615aebb2099f4a14673ec38&amp;embed=1"
width="250" height="500">
<param name="src" value="http://localhost/smartf/vis/multigraph?apikey=586ac9eca615aebb2099f4a14673ec38&amp;embed=1" />
Alternate content for browsers without object support.
</object>


<table id ="top-appliances" class="table table-bordered">
  <caption>Top Appliances</caption>
  <thead>
    <tr>
      <th>Name</th>
      <th>Consumption</th>
      <th>Cost</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Fridge</td>
      <td>200Kwh</td>
      <td>20&euro;</td>
    </tr>
     <tr>
      <td>Heater</td>
      <td>150Kwh</td>
      <td>15&euro;</td>
    </tr>
     <tr>
      <td>Television</td>
      <td>100Kwh</td>
      <td>10&euro;</td>
    </tr>
    <tr>
      <td>washing machine</td>
      <td>150Kwh</td>
      <td>7&euro;</td>
    </tr>
    <tr>
      <td>Iron</td>
      <td>75Kwh</td>
      <td>5&euro;</td>
    </tr>
  </tbody>
</table>




<div id="1" class="Container-White" style="position: absolute; margin: 0px; top: 40px; left: 20px; width: 1157px; height: 297px;"></div>
<div name="container-bottom" id="2" class="Container-White" style="position: absolute; margin: 0px; top: 360px; left: 20px; width: 1157px; height: 320px;"></div><div id="3" class="heading" style="position: absolute; margin: 0px; top: -20px; left: 500px; width: 180px; height: 60px;">Energy Details</div><div id="4" class="paragraph" style="position: absolute; margin: 0px; top: 0px; left: 1020px; width: 160px; height: 60px;"><div id="button-top" class="btn-group">   <button id="btn-cost" class="btn active">cost </button>   <button id="btn-kw" class="btn">Kwh</button>   <button id="btn-co" class="btn">CO2</button> </div></div><div name="charge-container" id="5" class="Container-Grey" style="position: absolute; margin: 0px; top: 60px; left: 780px; width: 377px; height: 257px;"></div><div type="4" units="Kw" scale="1" max="1000" feed="power-generated" id="6" class="dial" style="position: absolute; margin: 0px; top: 60px; left: 80px; width: 160px; height: 160px;"><canvas height="160" width="160" id="can-6"></canvas></div><div type="2" units="Kw" scale="1" max="1000" feed="power-consumed" id="7" class="dial" style="position: absolute; margin: 0px; top: 60px; left: 360px; width: 220px; height: 160px;"><canvas height="160" width="220" id="can-7"></canvas></div><div id="11" class="paragraph" style="position: absolute; margin: 0px; top: 80px; left: 800px; width: 340px; height: 80px;"><div id="holder"> <div class="progress progress-danger progress-striped" id="ev-charge" style="height:50px">   <div class="bar" style="width: 20%"></div></div>Elecrtic Vehicle charge : 20%</div></div><div id="12" class="paragraph" style="position: absolute; margin: 0px; top: 200px; left: 800px; width: 340px; height: 80px;"><div> <div class="progress progress-danger progress-success" id="solar-charge" style="height:50px">   <div class="bar" style="width:80%"></div></div> Solar charge level : 80%   </div></div><div id="16" class="multigraph" style="position: absolute; margin: 0px; top: 380px; left: 40px; width: 680px; height: 300px;"><iframe style="width: 680px; height: 300px;" marginheight="0" marginwidth="0" src="http://localhost/smartf/vis/multigraph?apikey=586ac9eca615aebb2099f4a14673ec38&amp;embed=1" frameborder="0" scrolling="no"></iframe></div><div id="17" class="paragraph" style="position: absolute; margin: 0px; top: 380px; left: 820px; width: 300px; height: 280px;"><table id="top-appliances" class="table table-bordered">   <caption>Top Appliances</caption>   <thead>     <tr>       <th>Name</th>       <th>Consumption</th>       <th>Cost</th>     </tr>   </thead>   <tbody>     <tr>       <td>Fridge</td>       <td>200Kwh</td>       <td>20</td>     </tr>      <tr>       <td>Heater</td>       <td>150Kwh</td>       <td>15</td>     </tr>      <tr>       <td>Television</td>       <td>100Kwh</td>       <td>10</td>     </tr>   </tbody> </table></div>


<div name="container-top" id="1" class="Container-White" style="position: absolute; margin: 0px; top: 40px; left: 20px; width: 1157px; height: 320px;"></div>
<div name="container-bottom" id="2" class="Container-White" style="position: absolute; margin: 0px; top: 380px; left: 20px; width: 1157px; height: 280px;"></div><div id="3" class="heading" style="position: absolute; margin: 0px; top: -20px; left: 500px; width: 180px; height: 60px;">Energy Details</div><div id="4" class="paragraph" style="position: absolute; margin: 0px; top: 0px; left: 1020px; width: 160px; height: 60px;"><div id="button-top" class="btn-group">   <button id="btn-cost" class="btn active">cost </button>   <button id="btn-kw" class="btn">Kwh</button>   <button id="btn-co" class="btn">CO2</button> </div></div><div name="charge-container" id="5" class="Container-Grey" style="position: absolute; margin: 0px; top: 60px; left: 780px; width: 377px; height: 257px;"></div><div type="4" units="Kw" scale="1" max="1000" feed="power-generated" id="6" class="dial" style="position: absolute; margin: 0px; top: 60px; left: 80px; width: 180px; height: 160px;"><canvas height="160" width="180" id="can-6"></canvas></div><div type="2" units="Kw" scale="1" max="1000" feed="power-consumed" id="7" class="dial" style="position: absolute; margin: 0px; top: 60px; left: 360px; width: 220px; height: 160px;"><canvas height="160" width="220" id="can-7"></canvas></div><div id="11" class="paragraph" style="position: absolute; margin: 0px; top: 80px; left: 800px; width: 340px; height: 80px;"><div id="holder"> <div class="progress progress-danger progress-striped" id="ev-charge" style="height:50px">   <div class="bar" style="width: 20%"></div></div>Elecrtic Vehicle charge : 20%</div></div><div id="12" class="paragraph" style="position: absolute; margin: 0px; top: 200px; left: 800px; width: 340px; height: 80px;"><div> <div class="progress progress-danger progress-success" id="solar-charge" style="height:50px">   <div class="bar" style="width:80%"></div></div> Solar charge level : 80%   </div></div><div id="16" class="multigraph" style="position: absolute; margin: 0px; top: 400px; left: 40px; width: 680px; height: 260px;">
<iframe style="width: 680px; height: 300px;" marginheight="0" marginwidth="0" src="http://localhost/smartf/vis/multigraph?apikey=586ac9eca615aebb2099f4a14673ec38&amp;embed=1" frameborder="0" scrolling="no"></iframe>ss</div><div id="17" class="paragraph" style="position: absolute; margin: 0px; top: 380px; left: 820px; width: 300px; height: 280px;"><table id="top-appliances" class="table table-bordered">   <caption>Top Appliances</caption>   <thead>     <tr>       <th>Name</th>       <th>Consumption</th>       <th>Cost</th>     </tr>   </thead>   <tbody>     <tr>       <td>Fridge</td>       <td>200Kwh</td>       <td>20</td>     </tr>      <tr>       <td>Heater</td>       <td>150Kwh</td>       <td>15</td>     </tr>      <tr>       <td>Television</td>       <td>100Kwh</td>       <td>10</td>     </tr>   </tbody> </table></div>
<div id="18" class="paragraph" style="position: absolute; margin: 0px; top: 200px; left: 80px; width: 180px; height: 40px;"><a id="powergen" href="#" class="btn btn-large">Power Generated</a></div><div id="19" class="paragraph" style="position: absolute; margin: 0px; top: 200px; left: 380px; width: 180px; height: 40px;"><a id="powercon" href="#" class="btn btn-large">Power Consumed</a></div><div id="21" class="paragraph" style="position: absolute; margin: 0px; top: 280px; left: 60px; width: 540px; height: 60px;"><div class="well alert-info" id="saving"> Power Saved Today :6      Monthly Power Saving : 50 </div></div>



 <div id="sidemenu" class="Container-White pull-left" style="height:650px; width:200px;">
    <ul class="nav nav-pills nav-stacked pull-left">
  		<li class="active"><a href="#">Home</a></li>
  		<li><a href="#">Generation</a></li>
  		<li><a href="#">Consumption</a></li>
        <li><a href="#">Consumption</a></li>
	</ul>
    </div>
<strong>Cost Now :</strong>





<div id="6" class="Container-White" style="position: absolute; margin: 0px; top: 0px; left: 0px; width: 1200px; height: 720px;"></div><div name="notifications" type="2" units="Kw" scale="1" max="1000" feed="power-consumed" id="12" class="Container-Grey" style="position: absolute; margin: 0px; top: 20px; left: 880px; width: 300px; height: 680px;"></div><div name="dial-board" id="16" class="Container-Grey" style="position: absolute; margin: 0px; top: 20px; left: 20px; width: 840px; height: 680px;"></div><div type="5" units="Kw" scale="1" max="1000" feed="power-net" id="17" class="dial" style="position: absolute; margin: 0px; top: 260px; left: 280px; width: 360px; height: 300px;"><canvas height="300" width="360" id="can-17"></canvas></div><div type="3" units="Kw" scale="1" max="1000" feed="power-generated" id="20" class="dial" style="position: absolute; margin: 0px; top: 40px; left: 60px; width: 250px; height: 250px;"><canvas height="250" width="250" id="can-20"></canvas></div><div type="2" units="Kw" scale="1" max="1000" feed="power-consumed" id="21" class="dial" style="position: absolute; margin: 0px; top: 40px; left: 600px; width: 250px; height: 250px;"><canvas height="250" width="250" id="can-21"></canvas></div><div units="" scale="0.20" feedname="power-generated" id="22" class="feedvalue" style="position: absolute; margin: 0px; top: 220px; left: 140px; width: 100px; height: 60px;">40</div><div units="" scale="0.30" feedname="power-consumed" id="23" class="feedvalue" style="position: absolute; margin: 0px; top: 220px; left: 680px; width: 100px; height: 80px;">90</div><div units="" scale="0.30" feedname="power-net" id="24" class="feedvalue" style="position: absolute; margin: 0px; top: 480px; left: 400px; width: 120px; height: 60px;">-30</div><div id="28" class="heading-center" style="position: absolute; margin: 0px; top: 260px; left: 60px; width: 260px; height: 60px;">Power Generated</div><div id="29" class="heading-center" style="position: absolute; margin: 0px; top: 260px; left: 600px; width: 260px; height: 60px;">Power Consumed</div><div id="30" class="heading-center" style="position: absolute; margin: 0px; top: 520px; left: 320px; width: 260px; height: 60px;">Net Power</div>
<div id="36" class="paragraph" style="position: absolute; margin: 0px; top: 80px; left: 900px; width: 260px; height: 120px;"><div id="holder"><div class="progress progress-danger progress-striped" id="ev-charge" style="height:40px"><div class="bar" style="width: 20%"></div></div>E-Vehicle charge : 20% </div></div><div id="37" class="paragraph" style="position: absolute; margin: 0px; top: 200px; left: 900px; width: 260px; height: 120px;"><div id="holder1"> <div class="progress progress-success progress-striped" id="solar-charge" style="height:40px"><div class="bar" style="width:80%"></div></div> Battery level : 80% </div> </div><div id="38" class="heading" style="position: absolute; margin: 0px; top: 0px; left: 1000px; width: 100px; height: 60px;">Storage</div><div id="41" class="heading-center" style="position: absolute; margin: 0px; top: 560px; left: 60px; width: 760px; height: 140px;"><div id="hoemnotif" class="well alert-info" id="monthlystatus"> Power Saved Today : 6 Euros <br/> Monthly Power Saving : 50 Euros </div></div>





<div id="netbutton" class="btn-group" ><a  class="btn-large btn-info" href="/smartf/dashboard/view/compare">Power Net</a><a  class="btn-large btn-info" href="/smartf/contorl/view/on">ON Devices</a></div> 

<li><i class="icon-inbox"></i><span class="badge badge-important">6</span></a>
<li- href="javascript:" ><i class="icon-info-sign"></i><span class="badge badge-success">2</span></li>
<div id="homealert" class="alert alert-success">
 Some push messages
</div>



<div id="1" class="Container-Grey" style="position: absolute; margin: 0px; top: 0px; left: 0px; width: 899px; height: 560px;"></div><div id="2" class="Container-Grey" style="position: absolute; margin: 0px; top: 0px; left: 920px; width: 278px; height: 221px;"></div><div id="3" class="Container-Grey" style="position: absolute; margin: 0px; top: 240px; left: 920px; width: 278px; height: 320px;"></div><div id="4" class="dial" style="position: absolute; margin: 0px; top: 0px; left: 20px; width: 280px; height: 300px;" feed="power-generated" max="1000" scale="1" units="W" type="4"><canvas id="can-4" width="280" height="300"></canvas></div><div id="5" class="dial" style="position: absolute; margin: 0px; top: 0px; left: 620px; width: 270px; height: 300px;" feed="power-consumed" max="1000" scale="1" units="W" type="3"><canvas id="can-5" width="270" height="300"></canvas></div><div id="6" class="dial" style="position: absolute; margin: 0px; top: 80px; left: 300px; width: 304px; height: 324px;" feed="power-net" max="1000" scale="1" units="W" type="5"><canvas id="can-6" width="303" height="323"></canvas></div><div id="8" class="heading-center" style="position: absolute; margin: 0px; top: 260px; left: 40px; width: 240px; height: 66px;"><a class="btn-large btn-info" href="/smartf/dashboard/view/generation">Power Generated</a> </div><div id="10" class="heading-center" style="position: absolute; margin: 0px; top: 260px; left: 620px; width: 260px; height: 47px;"><a class="btn-large btn-info" href="/smartf/dashboard/view/consume">Power Consumed</a> </div><div id="11" class="feedvalue" style="position: absolute; margin: 0px; top: 160px; left: 120px; width: 80px; height: 60px; font-size: 22px; color: white;" feedname="power-generated" scale="0.15" units="E">61.5 E</div><div id="12" class="feedvalue" style="position: absolute; margin: 0px; top: 260px; left: 400px; width: 100px; height: 56px; font-size: 22px; color: white;" feedname="power-net" scale="0.20" units="E">20 E</div><div id="13" class="feedvalue" style="position: absolute; margin: 0px; top: 160px; left: 720px; width: 70px; height: 60px; font-size: 22px; color: white;" feedname="power-consumed" scale="0.30" units="E">96 E</div><div id="14" class="heading-center" style="position: absolute; margin: 0px; top: 360px; left: 280px; width: 332px; height: 57px;"><a class="btn-large btn-info" href="/smartf/dashboard/view/compare">Power Net</a><a class="btn-large btn-info" href="/smartf/contorl/view/on">ON Devices</a></div><div id="15" class="heading-center" style="position: absolute; margin: 0px; top: 420px; left: 20px; width: 860px; height: 153px;"><div id="hoemnotif" class="well alert-info"> Power Saved Today : 6 Euros <br> Monthly Power Saving : 50 Euros </div></div><div id="16" class="heading-center" style="position: absolute; margin: 0px; top: -20px; left: 980px; width: 180px; height: 60px;">Power Stored</div><div id="19" class="heading-center" style="position: absolute; margin: 0px; top: 240px; left: 980px; width: 140px; height: 40px;">Notification</div><div id="21" class="paragraph" style="position: absolute; margin: 0px; top: 300px; left: 940px; width: 239px; height: 119px;"><div id="homealert" class="alert alert-success">  Some push messages </div></div><div id="22" class="paragraph" style="position: absolute; margin: 0px; top: 40px; left: 940px; width: 240px; height: 60px;"><div id="holder"> <div class="progress progress-danger progress-striped" id="ev-charge" style="height:30px">   <div class="bar" style="width: 20%"></div></div>E-Vehicle charge : 20% </div> <div id="holder1"> <div class="progress progress-success progress-striped" id="solar-charge" style="height:30px">   <div class="bar" style="width:80%"></div></div> Battery level : 80% </div></div> 







/*user view*/


 <h2><?php echo _('User: '); ?><?php echo $user['username']; ?></h2>
  <?php  
  /*
  * Create combo with available languages
  */
  echo '<form class="well form-inline" action="setlang" method="get">';
  echo '<span class="help-block">'._("Select preferred language").'</span>';  
  echo '<select name="lang">';
  
  if ($user['lang']=='')
    echo '<option selcted="selected" value="">'._("Browser language").'</option>';
  else 
    echo '<option value="">'._("Browser language").'</option>';
    
    
  foreach (get_available_languages() as $entry) 
  {
    if ($entry == $user['lang'])
      echo '<option selcted="selected" value="'.$entry.'">'._($entry).'</option>';
    else
      echo '<option value="'.$entry.'">'._($entry).'</option>';
  }
               
  echo '</select>';   
  echo '<input type="submit" value="'._("Save").'" class="btn"/>';
  echo '</form>';
  
  ?>

  <form class="well" action="../time/set" method="get">
    <h3><?php echo _("Local time"); ?></h3>

    <label><?php echo _("Time offset in hours:"); ?></label>
    <input type="edit" name="offset" value="<?php echo $user['timeoffset']; ?>" />

    <input type="submit" class="btn btn-danger" value="<?php echo _('Set'); ?>" />
  </form>
               
  <form class="well" action="changedetails" method="post">
    <h3><?php echo _('Change details'); ?></h3>

    <label><?php echo _('Username:'); ?></label>
    <input type="username" name="username" value="<?php echo $user['username']; ?>" />

    <label><?php echo _('Email:'); ?></label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" />
    <br/>
    <input type="submit" class="btn btn-danger" value="<?php echo _('Change'); ?>" />
  </form>

  <form class="well" action="changepass" method="post">
    <h3><?php echo _('Change password'); ?></h3>
    <label><?php echo _('Current password:'); ?></label>
    <input type="password" name="oldpass" />
        
    <label><?php echo _('New password:'); ?></label>
    <input type="password" name="newpass"/>
    <br/>
    <input type="submit" class="btn btn-danger" value="<?php echo _('Change'); ?>" />
  </form>
  
<?php

/*
 * Fake code to be detected by POedit to translate languages name
 * Do you know a better way to do that? If not here POedit will delete them in the mo file 
 * Compiler (php interpreter will ignore it)
 */
{
  _('en_EN');
  _('es_ES');
  _('nl_BE');
  _('nl_NL');     
	_('fr_FR');	
}
?>
