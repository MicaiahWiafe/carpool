<? php
if(isset($_REQUEST['regname']) && $_REQUEST['regname']!=""){
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