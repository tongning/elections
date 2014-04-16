<!--  <!DOCTYPE html>
<head>
<title>SGA Elections 2014</title>
</head>
<body>
<h3>SGA Elections 2014</h3>
<p>Welcome to the online SGA election gateway.  To begin voting, log in with your 6-digit
student ID number and school computer password below.</p>
<h3>To ensure that voting goes smoothly:</h3>
<ul>
<li>Do not use the back and/or forward buttons</li>
<li>Do not close the browser window or leave the site before you receive a confirmation page</li>
<li>Leave the computer logged on for the next voter once you're done.</li>
</ul>

<form name="userlogin" action="voterlogin.php" method="POST">
BILL/BINX Username - (Will be changed to Student ID later):<br><input name="id" type="text"><br>
School password:<br><input name="schoolpass" type="password"></br>
<input type="submit" value="Begin voting">
</form>

</body>
</html>
-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
 <meta author = "Caitlyn Singam">

  <title>The 2014 SGA Election</title>
  <div id = "header">
    	<h1><center><span>Welcome</span> </center> </h1>
    	<h1><center>to the 2014 Spring SGA Election Portal</center></h1>
	</div>
    <div id = "SGA">
    	<h1>SGA</h1>
	</div>
  <!-- styling -->
  <!-- http://colorschemedesigner.com/#2q21Tw0w0w0w0 -->
  <link href="http://fonts.googleapis.com/css?family=Overlock|Lily+Script+One|Oxygen|Questrial" rel="stylesheet" type="text/css">
  <style>
   html { 
      height: 100%; 
    }

   /* Sets the background for the page */
   body {
    /* change this image to change your backgroud*/
    background-image: url("http://www.desktopwallpaperhd.net/wallpapers/6/7/nature-light-background-wallpaper-computers-desktop-60007.jpg");
    background-color: rgb(160, 230, 95);
    background-size: 100% 100%;
    background-position: center;
    background-attachment: scroll;
    background-repeat: no-repeat;
    overflow-x: hidden;
    overflow-y: hidden;
    bottom:9em;
  }
    span{
    font-family: Lily Script One;
    color: red;
    font-size:40pt;
}
    
#image1{
    position: relative;
    bottom: 24em;
    left: 15%;
    width: 6em;
}
#image2{
    border: 2px solid green;
    position: relative;
    bottom: 24em;
    left: 75%;
    width: 11em;
}

#SGA{
    position: relative;
    font-family: Lily Script One;
    color: red;
    bottom: 250px !important;
    right: 90px !important;
    padding: 10px 10px 10px 175px;
    font-size:40px;
}
#header{
   font-family: Oxygen;
   color: green;
   margin: 10px;
   position: relative;
   max-width: 1000px;
   padding: 10px 10px 10px 200px;
}
#instructions{
    font-family:Overlock;
    margin: 5%;
    position: relative;
    max-width: 100%;
    bottom: 20em;
    font-size:20px;
}
#input{
    font-family:Overlock;
    margin: 5%;
    position: relative;
    max-width: 100%;
    bottom: 22em;
    font-size:20px;
}
.css3button {
  font-family: "Questrial";
  color: #294CFF !important;
  font-size: 14px;
  position: relative;
  font-size:20px;
  box-shadow:
		-5px 4px 2px rgba(000,000,000,0),
		inset 2px -4px 8px rgba(010,247,113,0.7);
  text-shadow:
		-1px -1px 0px rgba(000,000,000,0.3),
		1px 1px 1px rgba(255,255,255,0.2);
  padding: 8px 7px;
  -moz-border-radius: 11px;
  -webkit-border-radius: 11px;
  border-radius: 11px;
  border: 2px double #D30068;
  background: #63B8EE;
  background: linear-gradient(top,  #9BEE1F,  #A1E693);
  background: -ms-linear-gradient(top,  #9BEE1F,  #A1E693);
  background: -webkit-gradient(linear, left top, left bottom, from(#9BEE1F), to(#A1E693));
  background: -moz-linear-gradient(top,  #9BEE1F,  #A1E693);
  bottom: 0em;
  left:0em
}
.css3button:hover {
  color: #14396A !important;
  background: #468CCF;
  background: linear-gradient(top,  #32D948,  #44BD4C);
  background: -ms-linear-gradient(top,  #32D948,  #44BD4C);
  background: -webkit-gradient(linear, left top, left bottom, from(#32D948), to(#44BD4C));
  background: -moz-linear-gradient(top,  #32D948,  #44BD4C);
}
  </style>
</head>
<body>
  <img id="image1" src="http://finearts.mbhs.edu/images/blazer_transparent.gif">
  <img id="image2" src="http://nelsoncountygazette.com/wp-content/uploads/2013/11/election_2014.jpg">
  <div id = "instructions">
  <p>Greetings, voters!</p>
  <p>This site will guide you through the process of voting for candidate(s) in the 2014 SGA election. Rest assured that your votes will remain confidential.</p>
  <p>To begin, use the password generator below to create a unique password for yourself.</p>
  <p><strong>Please do not user the back buttons in the browser or try to exit out of the voting process until you see the confirmation page.</strong> However, if you must go back/exit out for some reason, please request assistance.</p>
  </div>
  <div id = "input">
    <form name="passgen" action="voterlogin.php" method="POST">
        Student ID:&nbsp<input type="text" name="id" size="6" maxlength="6" placeholder="Your ID">
        <br> 
        Computer password:*&nbsp<input type="password" name="schoolpass" placeholder = "Your password">
        <br>
        <br>
		<div id = "button">
  <button type="submit" name="" value="" class="css3button">Start voting!
   
</div>
    </form>
</div>

	<link rel='stylesheet' href='style.css'/>
	<link rel='next' href='voterlogin.php'/>
</body>
</html>
