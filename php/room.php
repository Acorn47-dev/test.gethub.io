
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/homestyle.css">
    <title>Document</title>
    <style>
            body{
        background-color:#19181A;
        margin: 0;
padding: 0;
    }
    .uppanel{

      position: relative;
      left: 0%;
      top: 0%;
      float: top;
      background: #3F3D41;
     margin: 0;
      width: 75%;
      height: 2.8vw;
    }
    .toptext{
  font-family: Calibri;
  font-size: 1.1vw;
  color: #fff;
  margin-right: 0.5vw;


}

.uppanelitem{
  position: absolute;
  float: left;
  display: flex;
  align-items: center;
        top: 50%;
        transform: translate(0,-50%);
}
#usercontainer1{
  
  width: 100%;
  height: 40vw;
  overflow: hidden;
}

#usercontainer2{
  display: flex;
  flex-direction: column;
width: 100%;
  height: 95%;
  overflow-y: scroll;
  padding-right: 20px;
}
#userborder{
  display: none;
	justify-self: center;
	align-self: center;
}
#parentclon{
  display: none;
}
.userbordermain {
          width: auto;
          height: auto;
          padding: 1vw;
          margin-top: 0.5vw;
          display: none;
  border-style: solid;
   border-color: #324AB2;
        border-radius: 5px;
      }

      .result{
        display:inline-block;
        position:relative;
        width: 0vw;
	z-index: 10px;
  left:50%;
	transform: translateX(-50%);
	border: 0.5vw solid transparent;
	border-top: 1vw solid #425DD8;

      }
      .box{
        margin-top:0.5vw;
        left:0;
        border: 0.1vw solid #404A78;
overflow: hidden;

        position:relative;
      }
      .roulete {
        position:relative;
  width: max-content;
  height: auto;
  left: 100%;
}



.item {
  position: relative;
  left: 0;
  width: auto;
  height: auto;
  font-family: Calibri;
  margin: 0 0.5vw;
  color: #fff;
  padding: 1vw;
  float: left;
  font-size: 2vw;
  text-align: center;
  line-height: auto;
}


.logoroom{
margin: 0.2vw;
height: 2.1vw;
width: 2.1vw;
}

.backgrounduser
{
	height: auto;
  position: relative;
  width: 100%;
  border-style: solid; /* Стиль границы */
  margin-top: 0.5vw;
  background: #3F3D40;
  background-color: #3F3D40;
  border: none;
}
.borderuser
{ 
  position: relative;
	height: auto;
  padding: 0.5vw;
  vertical-align: middle;
  margin-right: 0.5vw;
	display: inline-table ;
  background: #59585A;
  background-color: #59585A;
  border: none;
	width:max-content;
}

#margin{
  margin-top: 15%;
}

    </style>
</head>
<body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<?php
if(!isset($_COOKIE['id'])){
  Header("Location: /php/enter.php");
  exit();
}
?>
<script>
  var url = new URL(document.URL);
var params = url.searchParams;

var id=params.get("id");
var you=params.get("you")

function exitspectator(){
  window.location.replace('/php/home.php');
}
$(document).ready( function() {
  $('#box').css('display','none');
  if(you!=="spectator"){
    $('#exitspectator').css('display','none');
  }
  if(you==="spectator"){
    $('#exitbuttonroom').css('display','none');
  }else{
    $('#exitbuttonroom').css('display','block');
  }

  if(you !=="spectator" && you !=="player"){
    window.location.replace('/php/home.php');
  }

 
  $('#balance').css('background', '#266997');
  $('#chancewin').css('background', '#147411');
  $('#chancelose').css('background', '#742211');
  var needupdate=false;
  function update(){
    $.ajax({
type: 'POST',
      url: '/php/getdataroom.php',
      data: {id: id},
      cache: false,
      success: function(result) {
        var values = new Array();
              values = JSON.parse(result);
              aler(values)

            //  if(values[0].length==values[3]){
            //  все присоединились
            //  }
             
      },
  });

  }
  setTimeout(update, 100);
  var iduser;
    var login;
  function aler(values){
    $(usercontainer2).empty()
     iduser=values[0];
     login=values[1];
     balance=values[4];
     var myid=<?php echo $_COOKIE['id']?>;
     if(you==="player"){
      if (iduser.indexOf(myid.toString()) == -1) {
  
  window.location.replace('/php/home.php');
}
     }


 
    var myDiv = document.getElementById("userborder");
    var logintext = document.getElementById("textlogin");
     var idtext = document.getElementById("textid");
     var userbordermain = document.getElementById("userbordermain");
     var logintextmain = document.getElementById("textloginmain");
     var idtextmain = document.getElementById("textidmain");
     var chance= document.getElementById("chancetext");
     var chancelosetext= document.getElementById("chancelosetext");
     
     var waittext = document.getElementById("waittext");
     var waittextdiscribe = document.getElementById("waittextdiscribe");
     var balancetext = document.getElementById("balancetext");
     balancetext.innerHTML="БАЛАНС: "+balance+" руб"
     
     document.getElementById("limitationtext").innerHTML="участников ("+iduser.length+"/"+values[3]+")";
     document.getElementById("roomid").innerHTML="id комнаты: "+values[2];

     var exitbuttonroom = document.getElementById("exitbuttonroom").value=values[2];

     chance.innerHTML="ШАНС ВЫИГРЫША: "+(100/values[3])+"%";
    var i = (100)-(100/values[3]);
     chancelosetext.innerHTML="ШАНС ПРОИГРЫША: "+i+"%";
     
   
          for (var i = 0; i< iduser.length ; i++) { // выведет 0, затем 1, затем 2
          var divClone = myDiv.cloneNode(true); // the true is for deep cloning

            myDiv.style.display="inline-table";

          idtext.innerHTML="id: "+iduser[i];
          logintext.innerHTML="login: "+login[i]+"<br />";
          
          
          document.getElementById("usercontainer2").append(divClone);
          }
          setTimeout(update, 100);
          function starttimer(result){
            if(result!=null){


              var time=10;
                  function timer(){
                    time=time-1;
                    waittext.innerHTML="Игра начнется через:"+"<br />";;
                    waittextdiscribe.innerHTML=time;
                    waittextdiscribe.style.fontSize="2vw";
                    if(time==0){
                      waittextdiscribe.style.fontSize="1vw";
                      waittextdiscribe.style.color="#fff";
                    }
                   
                    if(time>0){
                  setTimeout(timer, 1000);
                }else{
                  $('#box').css('display','');
                  waittext.innerHTML="Выбираем победителя "+"<br />";;
                    waittextdiscribe.innerHTML="Победитель будет выбран случайным образом";
                  var r = $('.roulete');
                  var left = $('#roulete').offset().left;
                
r.animate({
  left: $('.roulete').parent().width()/2 - $('.roulete').width()/2
},{duration: Math.pow(10000, 1), 
  complete: function () {
          $(".item-active").css("background-color", "#7A8DEC")

          function showwinner(){
            confetti({
  spread: 180
});

                  if(you==="spectator"){
    $('#exitbuttonroom').css('display','none');
  }else{
    $('#exitbuttonroom').css('display','block');
  }
                  userbordermain.style.display='inline-table';
                waittext.innerHTML="Победитель выбран!" +"<br />";;
                logintextmain.innerHTML="id: "+result[0]+"<br />";
                idtextmain.innerHTML="login: "+result[1]+"<br />";
                waittextdiscribe.innerHTML="Победитель данной игры на ваших экранах";
          }
          setTimeout(showwinner, 1000);   
        
        }
})

                }
                  }
                setTimeout(timer, 1000);   
            }
          }
         
        if(iduser.length<values[3]){
        
        }else{
         
          if(!needupdate){
            document.getElementById('exitbuttonroom').style.display = 'none';

            function randomNumber(min, max){
    const r = Math.random()*(max-min) + min
    return Math.floor(r)
}


            $.ajax({
              type: 'POST',
              url: '/php/choosewinner.php',
              data: {id: id},
              cache: false,
              success: function(result) {
                var winner = new Array();
                winner = JSON.parse(result);
              
                  if(result!=null){
                  needupdate=true;
                  var random;
                  var colors=["#4C2177", "#692177","#772155","#213E77","#467721"]
               
                  for(var i=1; i<31; i++){
                    randomcolor=randomNumber(0, 4);
                  random=randomNumber(0, iduser.length);
                  var id="item"+i;
                  document.getElementById(id.toString()).innerHTML="Login: "+login[random]+"<br />"+"id: "+ iduser[random];
                  document.getElementById(id.toString()).style.background = 'linear-gradient(#19181A, '+colors[randomcolor+1]+')';
                  if(i==30){
                    document.getElementById("itemwin").innerHTML= "Login: "+winner[1]+"<br />"+"id: "+ winner[0];
                    document.getElementById("itemwin").style.background = 'linear-gradient(#19181A, #AF9E02)';
                  
                  starttimer(winner);
                  }
                  }
               
                
                }
               
               
 
            //  if(values[0].length==values[3]){
            //  все присоединились
            //  }
             },
            });
          }
          
         
        }
        
}
});

</script>

<div class="uppanel">
  <div class="uppanelitem">
  <img src="/images/logo.png" class="logoroom">
<div class="betroomdiscription" align="center" id="haha"><font class="toptext" id="roomid">комната. id: 0 </font></div>
            <div class="betroomdiscription" align="center" id="haha"><font class="toptext">тип комнаты: обычная</font></div>
  </div>

</div>

        <div class="roombackground">
         
            <div ><div class="backgroundmaininfo" id="balance"><font class="historytext" id="balancetext">БАЛАНС:  руб.</font></div>

            <div class="backgroundmaininfo" id="chancewin"><font class="historytext" id="chancetext" >ШАНС ВЫИГРЫША: 10%</font></div>
            <div class="backgroundmaininfo" id="chancelose"><font class="historytext" id="chancelosetext" >ШАНС ПРОИГРЫША: 10%</font></div>
            <center>
                <div ><div id="margin"><font class="maintext" id="waittext">ожидаем всех игроков...</font>
                    <font class="waittextdiscribe" id="waittextdiscribe"><br />игра начнется после того, как все присоединяться</font>
                </div>

                </div>

                <div class="userbordermain" id="userbordermain"><font class="historytext" id="textloginmain">Вася Пупкин<br /></font>
                    <font class="historytext" id="textidmain">id: 34353</font></div>
                </div>
              
            </center>
            <div class="box" id="box">
            <div class="result"></div>
            <div class="roulete" id="roulete">
          
          <div class="item" id="item1">1</div>
          <div class="item" id="item2">1</div>
          <div class="item" id="item3">1</div>
          <div class="item" id="item4">1</div>
          <div class="item" id="item5">1</div>
          <div class="item" id="item6">1</div>
          <div class="item" id="item7">1</div>
          <div class="item" id="item8">1</div>
          <div class="item" id="item9">1</div>
          <div class="item" id="item10">1</div>
          <div class="item" id="item11">1</div>
          <div class="item" id="item12">1</div>
          <div class="item" id="item13">1</div>
          <div class="item" id="item14">1</div>
          <div class="item" id="item15">1</div>
          <div class="item item-active" id="itemwin">6</div>
          <div class="item" id="item16">1</div>
          <div class="item" id="item17">1</div>
          <div class="item" id="item18">1</div>
          <div class="item" id="item19">1</div>
          <div class="item" id="item20">1</div>
          <div class="item" id="item21">1</div>
          <div class="item" id="item22">1</div>
          <div class="item" id="item23">1</div>
          <div class="item" id="item24">1</div>
          <div class="item" id="item25">1</div>
          <div class="item" id="item26">1</div>
          <div class="item" id="item27">1</div>
          <div class="item" id="item28">1</div>
          <div class="item" id="item29">1</div>
          <div class="item" id="item30">1</div>
        </div>
        
            </div>
           

            <div id="parentclon">
            <div class="backgrounduser" id="userborder">
              <div class="borderuser">
              <font class="historytext" id="textlogin">Вася Пупкин<br /></font>
              </div>
              <div class="borderuser">
              <font class="historytext" id="textid">id: 34353</font></div>
              </div>
                    
                </div>
            </div>
            <button class="exitbuttonroom"  id="exitspectator" name="exitspectator" value="exitspectator" onclick="exitspectator()"><font class="exitfont">выйти</font></button>
            <form action="/php/exitroom.php" method="post">
                <button class="exitbuttonroom"  id="exitbuttonroom" name="exitbuttonroom" value="exitbuttonroom"><font class="exitfont">выйти</font></button>
                </form>
               
        </div>
        </div>
        <div class="usersbackground">
        <center>
        <p><font class="historytext" id="limitationtext" onclick="">участники (1/10)</font></p>  
            <div id="usercontainer1">

          <div id="usercontainer2">
         


           
          </div>
          </div>
            </center>


         
           
        </div>
     

  
</body>
</html>