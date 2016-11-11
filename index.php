<?php
    if(isset($_REQUEST['name']) && $_REQUEST['name']!=""){
      //connect to database
      $db=new mysqli("localhost","root","","my_pool");
      
      if($db->connect_errno!=0){

        echo "error authenticating-connection {$db->connect_error}";
        exit();
      }
      
      $name=$_REQUEST['name'];
      $pass=$_REQUEST['pass'];

      //select user from database
      $str_query="select userid,username from user WHERE username='$name' and password='$pass' ";
      $result=$db->query($str_query);
      if(!$result){
        echo "error authenticating";
        exit();
      }
      
      $row=$result->fetch_assoc();
      if(!$row){
        //username or password must be wrong
        echo "<script type='text/javascript'>alert('Invalid username or password');</script>";
      }else{
      
        session_start();
        $_SESSION['userid']=$row['userid'];
        header("location: page1.html");
        
      }
    }
    //Register new user
    else if(isset($_REQUEST['regname']) && $_REQUEST['regname']!=""){
      $db=new mysqli("localhost","root","","my_pool");

      if($db->connect_errno!=0){
        echo "error authenticating-connection {$db->connect_error}";
        exit();
      }

      $name=$_REQUEST['regname'];
      $pass=$_REQUEST['regpass'];
      $repass=$_REQUEST['reregpass'];
      $phone=$_REQUEST['phone'];


      //if the passwords are the same, check if user already exists in database
      if($pass==$repass){

        //check database for new username being added
        $str_query="select username from user WHERE username='$name' and password='$pass' ";
        $result=$db->query($str_query);

        if(!$result){
          echo "error authenticating";
          exit();
        }
        $row=$result->fetch_assoc();
        if($row){
          //username or password must be wrong
          echo "<script type='text/javascript'>alert('User already exists');</script>";
        }
        else{
          $str_query="INSERT INTO `user` (`username`, `password`,`phone`) VALUES
('$name', '$pass', '$phone') ";
          $result=$db->query($str_query);
            if(!$result){
              echo "error authenticating";
              exit();
            }
            else{
              session_start();
              $_SESSION['username']=$name;
              header("location: page1.html");
            }
        }
        
      }
      //alert user about password mismatch
      else{
        echo "<script type='text/javascript'>alert('Mismatching passwords');</script>";
      }
    }
?>
<html >
  <head>
    <meta charset="UTF-8">
     <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Ashesi Carpool App</title>
    
    
    
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,latin-ext'>

        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>

    <div class="materialContainer">

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <div class="box">

      <div class="title">LOGIN</div>

      <div class="input">
         <label for="name">Username</label>
         <input type="text" name="name" id="name">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="pass">Password</label>
         <input type="password" name="pass" id="pass">
         <span class="spin"></span>
      </div>

      <div class="button login" type="submit">
         <button><span>GO</span> <i class="fa fa-check"></i></button>
      </div>


   </div>

   <div class="overbox">
      <div class="material-button alt-2"><span class="shape"></span></div>

      <div class="title">REGISTER</div>

      <div class="input">
         <label for="regname">Username</label>
         <input type="text" name="regname" id="regname">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="regpass">Password</label>
         <input type="password" name="regpass" id="regpass">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="reregpass">Repeat Password</label>
         <input type="password" name="reregpass" id="reregpass">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="number">Phone</label>
         <input type="text" name="number" id="number">
         <span class="spin"></span>
      </div>

      <div class="button" type="submit">
         <button><span>NEXT</span></button>
      </div>
</form>

   </div>

</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>
         <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

    
    
    
  </body>
</html>
