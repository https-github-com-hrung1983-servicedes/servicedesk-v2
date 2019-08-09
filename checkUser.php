<? 
session_start();  
//header("Content-Type: text/html; charset=tis-620"); 

require("function.php");  
$username=$_REQUEST["username"];
$password=$_REQUEST["password"];
$link=$_REQUEST["link"];

 	$sql = "SELECT
						tbl_user_login.user_bss_id,
						tbl_user.at,
						tbl_user.name,
						tbl_user.sname,
						tbl_user_login.user_name,
						tbl_user_login.`password`,
						tbl_user_login.state,
						tbl_user_login.active,
						tbl_user.user_id,
						tbl_user.email,
						tbl_user.gasperkilo
						FROM
						tbl_user_login
						Left Join tbl_user ON tbl_user_login.user_bss_id = tbl_user.id_login
						WHERE user_name='$username' and password='$password' and active = 'y'";
	//echo $sql;exit;
        $result = mysqli_query($conn,$sql);
		$c=mysqli_fetch_array($result);    //    echo $c["user_bss_id"];            echo $sql;exit;  
        if(mysqli_num_rows($result)>0){
		    $_SESSION["Uid"] = $c["user_bss_id"];  
		    $_SESSION["Uat"] = $c["at"];        
		    $_SESSION["Uname"] = $c["name"];
		    $_SESSION["Usname"] = $c["sname"];
		    $_SESSION["Username"] = $c["user_name"];
		    $_SESSION["Upassword"] = $password;
		    $_SESSION["Ustate"] = $c["state"];
		    $_SESSION["User_id"] = $c["user_id"];
		    $_SESSION["Uemail"] = $c["email"];
		    $_SESSION["Ugasperkilo"] = $c["gasperkilo"];
					if($c["at"]=="PTT"){
						header("Location:Index1.php?link=stock.ngv.bss"); 
					}else{
						header("Location:Index1.php?link=$link"); 
					}
		
	     
            } else {
        echo Message(35,"red","��ͤ�����͹","�س��͡�����������ʼ�ҹ���١��ͧ","<a href='javascript:history.back(1)'> ��Ѻ���� </a>");
        exit;
    } 
?>










