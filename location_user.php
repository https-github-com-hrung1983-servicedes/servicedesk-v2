<?
require_once("function.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"   
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="900">
<title>BSS MAP</title>  
<style type="text/css">
    html, body{
            height: 100%;
            margin: 0px;
            padding: 0px
            }

/* css กำหนดความกว้าง ความสูงของแผนที่ */  
#map_canvas {   
    width:100%;  
    height: 100%;  
    margin:0;  
}  
#form_search_data {   
    width:450px;  
    height:30px;  
    margin:0;  
}
</style>  
</head>  
<body>
 


<div id="map_canvas"></div>  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>    
<script type="text/javascript">  
var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้  
var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
var arr_path=[]; // กำหนดตัวแปรสำหรับเก็บค่าอาเรย์ ตำแหน่ง path  
var makePolyline; // กำหนดตัวแปร ฟังก์ชั่น สร้างเส้น polylines  
var objPolylines=[]; // กำหนดตัวแปรสำหรับเก็บค่า object ของ polylines  
function initialize() { // ฟังก์ชันแสดงแผนที่  
    GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM  
    // กำหนดจุดเริ่มต้นของแผนที่  
    var my_Latlng  = new GGM.LatLng(13.761728449950002,100.6527900695800);  
    // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas  
    var my_DivObj=$("#map_canvas")[0];   
    // กำหนด Option ของแผนที่  
    var myOptions = {  
        zoom: 10, // กำหนดขนาดการ zoom  
        center: my_Latlng , // กำหนดจุดกึ่งกลาง  
        mapTypeId:GGM.MapTypeId.driver, // กำหนดรูปแบบแผนที่  
        mapTypeControlOptions:{ // การจัดรูปแบบส่วนควบคุมประเภทแผนที่  
            position:GGM.ControlPosition.TOP, // จัดตำแหน่ง  
            style:GGM.MapTypeControlStyle.DROPDOWN_MENU // จัดรูปแบบ style   
        }  
    };  
    map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map  
      
    $.ajax({  
        url:"genMarker.php", // ใช้ ajax ใน jQuery เรียกใช้ไฟล์ xml  
        type: "GET", // ส่งค่าข้อมูลแบบ POST ไปที่ไฟล์ genMarker.php  
        data: { data_search : "<?=$_POST['data_search']?>"}, //รับค่า จากการ submit ฟอร์ม ส่งไปค้นหาข้อมูล  
        dataType: "xml",  
        success:function(xml){  
//          console.log(xml);  
            $(xml).find('marker').each(function(){ // วนลูปดึงค่าข้อมูลมาสร้าง marker  
                    var markerID=$(this).attr("id");// นำค่าต่างๆ มาเก็บไว้ในตัวแปรไว้ใช้งาน      
                    var markerName=$(this).find("name").text(); // นำค่าต่างๆ มาเก็บไว้ในตัวแปรไว้ใช้งาน      
                    var markerLat=$(this).find("latitude").text(); // นำค่าต่างๆ มาเก็บไว้ในตัวแปรไว้ใช้งาน   
                    var markerLng=$(this).find("longitude").text(); // นำค่าต่างๆ มาเก็บไว้ในตัวแปรไว้ใช้งาน              
                    var markerLatLng=new GGM.LatLng(markerLat,markerLng); 
                    var my_Marker = new GGM.Marker({ // สร้างตัว marker  
                        position:markerLatLng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
                        map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map  
                        title: markerID // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ

                });
                    

                    infowindow = new GGM.InfoWindow({// สร้าง infowindow ของแต่ละ marker เป็นแบบ array  
                    content: markerName // ดึง title ในตัว marker มาแสดงใน infowindow
                    
                });  


                     infowindow.open(map,my_Marker);
         
                
//                  console.log($(this).find("id").text());  
            });  
        }
        
    });


    
  
}



$(function(){  
    // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว  
    // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api  
    // v=3.2&sensor=false&language=th&callback=initialize  
    //  v เวอร์ชัน่ 3.2  
    //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false  
    //  language ภาษา th ,en เป็นต้น  
    //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize  
    $("<script/>", {  
      "type": "text/javascript",  
      src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"  
    }).appendTo("body");      
});  
</script>
