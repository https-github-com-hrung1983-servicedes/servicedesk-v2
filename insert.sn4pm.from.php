<?
session_start();
require_once("function.php");
$q = $_GET['q'];
?>
<? if($cnt_job==0) {?>
<?=$q?>
	<table align="center" bordercolor="#000000" class="mytable"  border="0" width="60%"> 
		<tr>			
			<th class="th" width="10%" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">#</th>
			<th class="th" width="60%" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">Category Name</th> 
			<th class="th" width="20%" style="padding:0px; border-bottom:1px solid #ccc; border-right:0px solid #ccc;">New SN.</th> 
		</tr>		
              <?$sql_cate = "SELECT cate_id,cate_name FROM tbl_category_hardware WHERE cate_id in ('1','2','3','4','6','7','8','9','10','11','12','13','14','36','37','31','32','33','34','25','30','27','45','16','60','61','62','63'
,'64','65','66','67','68','20')   order by cate_name"; //echo $sql_cate;
              $c_col = mysqli_query($conn,$sql_cate);
$row1 = 1;
              while($rs_col = mysqli_fetch_array($c_col)){
	      ?>
		<tr  onmouseover="this.style.backgroundColor='violet';" onmouseout="this.style.backgroundColor='white';" >      
                      <td align='center'></a><?=$row1++?></td> 
                      <td></a><?=$rs_col['cate_name']?></td> 
                      <td>

						
						
			<select name="sn_new<?=$rs_col['cate_id']?>" id="sn_new<?=$rs_col['cate_id']?>" style="width:195pt" ><option value="0">-Select-</option>
			<?
				$sql1 = "SELECT
			tbl_hardware_onhand_user.id,
			tbl_hardware_onhand_user.hardware_no,
			tbl_hardware_onhand_user.user_id
			FROM
			tbl_hardware_onhand_user
			Where tbl_hardware_onhand_user.hardware_status in ('w','a','o')
			And tbl_hardware_onhand_user.cate_id = '$rs_col[cate_id]'
			And tbl_hardware_onhand_user.status_pm = 'n'
			And tbl_hardware_onhand_user.from_site_id = '$q'
			order by tbl_hardware_onhand_user.hardware_no";


				$rc1 = mysqli_query($conn,$sql1);
				while($c1 = mysqli_fetch_array($rc1)){
			?>
	
			<option value="<?=$c1['id']?>" ><?=$c1["hardware_no"]?></option>
<?}?>
			</select>


		      </td> 
		</tr>
        <?}?>
             </table>
                 <?}?>