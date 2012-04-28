<?php
session_start();?>

<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<form action="request.php" method="post">
<input id="name" type="text" name="name"/>
<textarea name="message" id="message"></textarea>
<input type="submit" value="send"/>
</form>
<div id="chatMessage"></div>
<script>

$(document).ready(function(){

        <?php if(!isset($_SESSION['user'])):?>
        $("#message").hide();
        <?php else:?>
        $("#name").hide();
        <? endif;?>
        $('form').submit(function(){
                $.post($(this).attr("action"),$(this).serialize(),function(data){
                        if(data.usercreated == "created"){
                                $("#name").hide();
                                $("#message").show();
                        }
                });

        return false;
        });
        var oldData = "";
        setInterval(function(){
                $.getJSON("messages.php",function(data){
                        if(data.message != oldData){
                                oldData = data.message;
                                $("#chatMessage").html($("#chatMessage").html()+"<br/>"+data.message);
                        }
                });
        },1000);

});

</script>