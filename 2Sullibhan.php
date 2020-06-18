<?php
session_start ();
function loginForm() {
	echo '
    <div id="loginform">
    <form action="2Sullibhan.php" method="post">
        <p>Please enter your name to continue:</p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" />
        <input type="submit" name="enter" id="enter" value="Enter" />
    </form>
    </div>
    ';
}

if (isset ( $_POST ['enter'] )) {
	if ($_POST ['name'] != "") {
		$_SESSION ['name'] = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
		$fp = fopen ( "Log5.html", 'a' );
		fwrite ( $fp, "<div class='msgln'><i>User<b> " . $_SESSION ['name'] . " </b>has joined the chat session.</i><br></div>" );
		fclose ( $fp );
	} 
}

if (isset ( $_GET ['logout'] )) {
	
	// Simple exit message
	$fp = fopen ( "Log5.html", 'a' );
	fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has left the chat session.</i><br></div>" );
	fclose ( $fp );
	
	session_destroy ();
	header ( "Location: 2Sullibhan.php" ); // Redirect the user
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon"
   href="https://www.freefavicon.com/freefavicons/icons/love-chat-icon-bw-152-308328.png">
   <link rel="stylesheet" type="text/css" href="Style.css">
   <title>2 Sullibhan Chat</title>
 </head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
 <script
 src="scripts.js">-
  </script>
  <body>
 <?php
    if (! isset ( $_SESSION ['name'] )) {
        loginForm ();
    } else {
        ?>

        <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="2Sullibhan.php">Main Chat</a>
  <a href="2Feely.php">2 Feely</a>
  <a href="2Gara.php">2 Gara</a>
  <a href="2NiFhearga.php">2 Ni Fhearga</a>
  <a href="2Sullibhan.php">2 Sullibhan</a>
 </div>
   <div id="chatbox">
           <div class="header" id="myHeader">
          <h1>2 Sullibhan Chat 
            <span id="main" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
          </h1>
       </div>
        <hr>
        <div class="content" id="content">
         <?php
		if (file_exists ( "Log5.html" ) && filesize ( "Log5.html" ) > 0) {
			$handle = fopen ( "Log5.html", "r" );
			$contents = fread ( $handle, filesize ( "Log5.html" ) );
			fclose ( $handle );
			
			echo $contents;
		}
		?></div>
   </div>
   <footer>
    <form action="2Sullibhan.php" autocomplete="off" method="post">
        <p>Please enter your message:</p>
        <label for="message">Message:</label>
        <input type="text" name="message" id="message" />
        <input type="submit" name="enter" id="enter" value="Enter" onclick="refreshBlock()"/>
    </form>
        <form>
        <input type="submit" href="logout.php"  name="logout" id ="enter" value="logout"/> 

    </footer>
    <?php
    if (isset ( $_POST ['enter'] )) {
	if ($_POST ['logout'] != "") {
		$_SESSION ['logout'] = stripslashes ( htmlspecialchars ( $_POST ['logout'] ) );
		$fp = fopen ( "Log5.html", 'a' );
		fwrite ( $fp, "<div class='msgln'><i>User<b> " . $_SESSION ['name'] . " </b>has left the chat session.</i><br></div>" );
		fclose ( $fp );
	} 
 }
 ?>
  <?php
    if (isset ( $_POST ['enter'] )) {
	if ($_POST ['message'] != "") {
		$_SESSION ['message'] = stripslashes ( htmlspecialchars ( $_POST ['message'] ) );
		$fp = fopen ( "Log5.html", 'a' );
		fwrite ( $fp, "<div class='msgln'><i><b> " . $_SESSION ['name'] . ":</b>" . $_SESSION ['message'] . "</i><br></div>" );
		fclose ( $fp );
	} 
 }
 ?>
 <script type="text/javascript">
  window.onload = setupRefresh; 
    function setupRefresh()
    {
        setInterval("refreshBlock();",3000);
    }
    function refreshBlock()
    {
       $('#chatbox').load("2Sullibhan.php");
    }
    function setUpLoad()
    {
        setInterval("setLoad();",4000);
    }
    
    function setLoad()
    {
window.scrollTo(0, document.body.scrollHeight || document.documentElement.scrollHeight);
}
</script>
  <?php
    }
  ?>
  </body>
</html>