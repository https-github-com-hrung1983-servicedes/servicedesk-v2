<? 
session_start();  
//header("Content-Type: text/html; charset=tis-620"); 
require("connection.php");    
$username=$_REQUEST["username"];
$password=$_REQUEST["password"];
$table="tbl_user_login";
 	$sql = "select * from $table where user_name='$username' and password='$password' and active = 'y'";
        $result = mysqli_query($conn,$sql);
		$c=mysqli_fetch_array($result);       
        if(mysqli_num_rows($result)>0){
		$_SESSION["Uid"] = $c["user_bss_id"];
		$_SESSION["Uname"] = $c["name"];
		$_SESSION["Usname"] = $c["sname"];
		$_SESSION["Username"] = $c["user_name"];
		$_SESSION["Upassword"] = $password;
		$_SESSION["Ustate"] = $c["state"];

           //     echo $_SESSION["Ustate"];exit;

	   // $Uid=$c["user_bss_id"];
	   // $Uname=$c["name"];
           // $Usname=$c["sname"];
           // $Username=$c["user_name"];
           // $Upassword=$password;
	   // $Ustate=$c["state"];
       	  //  session_register("Uid","Uname","Usname","Username","Upassword","Ustate");			
	    header("Location:Index1.php");  
            } else {
        echo Message(35,"red","ข้อความเตือน","คุณกรอกชื่อหรือรหัสผ่านไม่ถูกต้อง","<a href='javascript:history.back(1)'> กลับไปแก้ไข </a>");
        exit;
    } 
?>
