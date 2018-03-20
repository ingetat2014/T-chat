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
     <body>
    <input type="hidden" id="sessionId" value="<?php if(isset($_SESSION['id'])) echo $_SESSION['id'];else echo ""; ?>"/>
    <div id="container">
         
        <div class="row">
            <div  style="height:220px; border:1px solid #ACD8F0;" class="col-xs-12 col-sm-12 col-md-2 col-lg-2"> 
                   <div class="row bg-info">Connected List : </div>
                   <div id="userOnline">...</div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1 col-lg-5 col-md-offset-1">
               <div class="row"> 
                    <p class="welcome col-xs-6 col-sm-6 col-md-6 col-lg-6">Bienvenue, <?php if(isset($_SESSION['id'])) echo $_SESSION['id'];else echo "Anonyme"; ?><b></b>
                    </p>
                    <?php  if(isset($_SESSION['id']) && !empty($_SESSION['id'])){?>
                        <div class="col-xs-3 col-xs-offset-3 col-sm-3 col-sm-offset-3 col-md-2 col-md-offset-4 col-lg-3 col-lg-offset-3">
                            <form name="message" action="entryPoint.php" method="post">
                                 <button type="submit" name="exit" class="btn-default" value="exit">Exit</button>
                            </form>
                        </div>
                        <?php } ?>
                </div>
                <div class="row"> 
                    <div id="chatBloc" style="height:320px; border:1px solid #ACD8F0; overflow:auto;text-align: left" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> ...
                    </div>
                </div>
                <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input id="usermsg" name="usermsg" class="col-xs-8 col-sm-8 col-md-7 col-lg-7 btn-default" type="text" required="required" />
                    <input name="submitmsg" class="btn-default btn-primary col-xs-3 col-xs-offset-1 col-sm-3 col-sm-offset-1 col-md-2 col-lg-2  col-lg-offset-2"  type="submit" id="Send"   value="Send" />
            </div>
        </div>
            
            </div>
            
             <?php
            if(!isset($_SESSION['id']) || empty($_SESSION['id'])){?>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <?php  if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur'])){
                ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php
                    echo $_SESSION['erreur']; ?>
                    </div>
                </div>
            
            <?php } else $_SESSION['erreur']="";?>
             <div class="row">
                <fieldset >
                    <legend>login</legend>
                    <form action="entryPoint.php" method="post">
                    <div class="row">
                    <label class="col-xs-6 col-sm-6 col-md-6 col-lg-6" for="name">Name</label>
                    <input type="text" class="btn-default col-xs-6 col-sm-6 col-md-6 col-lg-6" name="name" required="required" />
                    </div>
                    <div class="row">
                    <label class="col-xs-6 col-sm-6 col-md-6 col-lg-6" for="password">Password</label>
                    <input type="password" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 btn-default" name="password"  required="required" />
                    </div>
                    <p>
                    <input type="submit" class="btn-default btn-primary  col-xs-3 col-xs-offset-9 col-sm-3 col-sm-offset-9 col-md-2 col-md-offset-10 col-lg-2 col-lg-offset-10" name="Login" id="loginSubmit"  value="Login"/>
                     </p>
                    </form>
                </fieldset>
                <fieldset id="inscription">
                    <legend>Inscription</legend>
                    <form action="entryPoint.php" method="post">
                    <div class="row">
                    <label class="col-xs-6 col-sm-6 col-md-6 col-lg-6" for="name">Name</label>
                    <input type="text" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 btn-default" name="name" id="name" required="required" />
                     </div>
                    <div class="row">
                    <label class="col-xs-6 col-sm-6 col-md-6 col-lg-6" for="password">Password</label>
                    <input type="password" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 btn-default" name="password" id="password" required="required" />
                    </div>
                    <input type="submit" class="btn-default btn-primary xs-3 col-xs-offset-9 col-sm-3 col-sm-offset-9 col-md-2 col-md-offset-10 col-lg-3 col-lg-offset-9" name="Subscribe" id="loginSubscribe" value="Subscribe" />
                </form>
                </fieldset>
                 </div>
    </div>
            <?php } ?>
            
        </div>

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
        
        
        
        var refreashChat = function(){
            if($("#sessionId").val()!==""){
            $.get("http://localhost/Tchat/entryPoint.php", {id_per: $("#sessionId").val()}, function(result){
            $("#chatBloc").html(result);
             $("#chatBloc").scrollTop($("#chatBloc").get(0).scrollHeight);
           // console.log(result);
        });
        }
        };
        
        setInterval(refreashChat, periode);
        
        var getUserConnected = function(){
           if($("#sessionId").val()!=""){ 
            $.get("http://localhost/Tchat/entryPoint.php", {id_person: $("#sessionId").val()}, function(result){
            $("p.welcome").html("Bienvenue, "+result);
        });
        }
        };
        getUserConnected();
        var getUsersOnline = function(){
            $.get("http://localhost/Tchat/entryPoint.php", {online: true}, function(result){
            $("#userOnline").html(result);
            console.log(result);
        });
        };
        setInterval(getUsersOnline, periode-1);
       
        var addChat = function(){
            if($("#usermsg").val()!=""){ 
            $.post("http://localhost/Tchat/entryPoint.php", {usermsg: $("#usermsg").val(),submitmsg:true}, function(result){
            $("#usermsg").val("");
        });
        }
        };
         $("#Send").click(function(){
            addChat();
        });

        refreashChat


     console.log(" Site de mon inpiration css est celui https://code.tutsplus.com/tutorials/how-to-create-a-simple-web-based-chat-application--net-5931 ");
    });
    </script>
    </body>
    </html>