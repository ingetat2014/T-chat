 <?php 
 session_start();
 //session_destroy();die();
 ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>T'chat</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="ismailkomay"/>
        <meta name="author" content="ismailkomay"/>
        <title>T'chat Test Technique : IsmailKomay</title>
        <link rel="icon" type="image/x-icon" href="vue/resources/favicon.ico" />
        <link type="text/css" rel="stylesheet" href="vue/resources/css/main.css" />
        <link rel="stylesheet" href="vue/resources/css/bootstrap.min.css">
        
</head>
 </body>
 <input type="hidden" id="sessionId" value="<?php if(isset($_SESSION['id'])) echo $_SESSION['id'];else echo ""; ?>"/>
<div id="wrapper">
    <div id="menu">
        <p class="welcome">Bienvenue, <?php if(isset($_SESSION['id'])) echo $_SESSION['id'];else echo "Anonyme"; ?><b></b></p>
        <?php  if(isset($_SESSION['id']) && !empty($_SESSION['id'])){?>
        <form name="message" action="entryPoint.php" method="post">
        <p class="logout">
            <button type="submit" name="exit" value="exit">Exit</button>
        </p>
        <div style="clear:both"></div>
        </form>
        <?php } ?>
    </div>
     
    <div id="chatbox">
         <?php  if(true){?>
         <?php }?>
    </div>
     
    <form  action="entryPoint.php" method="post">
        <input name="usermsg" type="text" required="required" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
    <hr>
        <?php  if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']))echo $_SESSION['erreur']; else $_SESSION['erreur']="";?>
        <?php if(!isset($_SESSION['id']) || empty($_SESSION['id'])){?>
    <fieldset id="loginform">
        <legend>login</legend>
        <form action="entryPoint.php" method="post">
        <p>Connectez-vous:</p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required="required" />
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required="required" />
        <input type="submit" name="Login" id="loginSubmit"  value="Login"/>
        </form>
    </fieldset>
    <fieldset id="inscription">
        <legend>Inscription</legend>
        <form action="entryPoint.php" method="post">
        <p>Inscrivez-vous:</p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required="required" />
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required="required" />
        
        <input type="submit" name="Subscribe" id="loginSubscribe" value="Subscribe" />
    </form>
    </fieldset>
        <?php } ?>
</div>
    <script src="vue/resources/js/jquery.min.js"></script>
    <script src="vue/resources/js/bootstrap.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
    var periode = 0.5*1000;//en Mlleseconde
   //Debut : exemple de maquette prevue  faute de temps
    var chats = [{id:1,
        message :{
            id:1,
            text:'texto1',
            sending_date:'2018-03-17 22:00:06'
        },
        person:{
            id:2,
            name:'name1',
            subscribe_date:'2018-03-17 21:00:06'
        }
    },
    {id:2,
        message :{
            id:1,
            text:'texto2 Site de mon Initiation css est celui https://codSite de mon Initiation css est celui https://cod',
            sending_date:'2018-03-17 22:00:06'
        },
        person:{
            id:1,
            name:'name2',
            subscribe_date:'2018-03-17 21:00:06'
        }
    }
        ];
        var eltCHat = '';
        for(var i=0;i<chats.length;i++){
            eltCHat += "<tr id='"+chats[i].id+"'><td class='sending_date'>"+chats[i].message.sending_date+"</td> <td class='person_name'>"+chats[i].person.name+" : </td> <td class='message_text'> "+chats[i].message.text+"</td></tr>";
            console.log(eltCHat);
        }
         //$("#chatbox").html("<table>"+eltCHat+"</table>");
         eltCHat = '';
         //$("#wrapper").hide();
//Fin : exemple de maquette prevue  faute de temps
    
    
    
    var refreash = function(){
        if($("#sessionId").val()!==""){
        $.get("http://localhost/Tchat/entryPoint.php", {id_per: $("#sessionId").val()}, function(result){
        $("#chatbox").html(result);
        //console.log(result);
    });
    }
    };
    
    setInterval(refreash, periode);
    
    var getUserConnected = function(){
       if($("#sessionId").val()!=""){ 
        $.get("http://localhost/Tchat/entryPoint.php", {id_person: $("#sessionId").val()}, function(result){
        $("p.welcome").html("Bienvenue, "+result);
        //console.log(result);
    });
    }
    };
    getUserConnected();


 console.log(" Site de mon inpiration css est celui https://code.tutsplus.com/tutorials/how-to-create-a-simple-web-based-chat-application--net-5931 ");
});
</script>
</body>
</html>