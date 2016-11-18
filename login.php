<? php
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
    ?>