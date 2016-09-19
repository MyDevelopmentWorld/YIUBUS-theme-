<?php
get_header();
$db = new mysqli('localhost','yiubus','yiubus','yiubus');
if($db->connect_error){ 
   die('데이터베이스 연결에 문제가 있습니다. 관리자에게 문의 바랍니다.');
}
$db->set_charset('utf8');
date_default_timezone_set('Asia/Seoul');
$todayH = date('H');
$todayM = date('H:i');

?>
<!doctype html>
<html lang="ko">
  <head>
  <!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>-->

    <meta charset="utf-8">
    <title>Cambus</title>
    <!-- 모바일용웹 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="mobile-web-app-capable" content="yes">
   <!--슬라이드 메뉴 스타일-->
<!-- 안드로이드 홈화면추가시 상단 주소창 제거 -->
<meta name="mobile-web-app-capable" content="yes">
<link rel="icon" href="/wp-content/themes/ybus/Image/favicon.ico">
<!-- ios홈화면추가시 상단 주소창 제거 -->
<meta name="apple-mobile-web-app-capable" content="yes">

<link rel="apple-touch-icon" href="/wp-content/themes/ybus/Image/favicon.ico">
 
  </head>
 <script>
 <!-- arrow 버튼 포커싱-->
    function fnMove(seq){
        var offset = jQuery("#div" + seq).offset();
        jQuery('html, body').animate({scrollTop : offset.top}, 400);
    }
   
</script>

  <body>
    <div id="jb-container">
   <!--상단바-->
      <div id="jb-header">
        <img src="/wp-content/themes/ybus/Image/Top.png"/ width="580px;">
      
      
   <!--사이드 슬라이드 메뉴 시작-->
    <div class="btn"></div>
<div onclick="history.back();" class="page_cover"></div>
<div id="menu">
  <div onclick="history.back();" class="close"></div>
  <div id="kakao">
  <a href="http://plus.kakao.com/home/@ybus">
     <img src="/wp-content/themes/ybus/Image/kakaotalk.png">
</a></div>
  <img id="side_bar" src="/wp-content/themes/ybus/Image/side_bar.png"/>
</div>  
      </div>
     <!--메인 이미지-->
      <div id="jb-content">
     <?php if($todayH<17) :  ?>
       <img src="/wp-content/themes/ybus/Image/main_morning.png"/>
      <?php
      else :  ?>
      <img src="/wp-content/themes/ybus/Image/main_night.png"/>
      <?php endif;?>
      <img src="/wp-content/themes/ybus/Image/full.png"/>
      <div id="arrow">
      <input type="image" id="arrow" src="/wp-content/themes/ybus/Image/arrow.png" onclick="fnMove('1')">
      </div>
      
      <!--지도 시작-->
      <div id="div1" style="margin-top:10%;">
      
      <img src="/wp-content/themes/ybus/Image/map_bar.png" style="margin-bottom:-6%;"/>
      <?php get_sidebar(); ?>
      
      </div> 
      <!-- 시간표 시작-->
<img src="/wp-content/themes/ybus/Image/time_bar.png"/>
<div id="timetable">
<div id="table">
<div class="row">
<span class="head headcol1">시   간</span>
<span class="head headcol2">순환코스</span>
<span class="head headcol3">시   간</span>
<span class="head headcol4">순환코스</span>
</div> 
<?php
                  //시간 차 순으로 정렬
                     $sql = 'select * from timetable order by idx asc';
                     $result = $db->query($sql);
                     $num = mysqli_num_rows($result);
                     $i=1;
                     $flag = 1;
					 $beforetime="8:00";
					$beforetime2="14:15";
                     while($row = $result->fetch_assoc())
                     {
							$time=$row['time'];
							$time2=$row['time2']; 
                     ?>
<div class="row">
<span class="cell <?php echo $beforetime <= $todayM && $todayM < $time?'light':'col1'?>"><?php echo $row['time']?></span>

<span class="cell <?php echo $flag==1?'white':'grey';echo $beforetime <= $todayM && $todayM < $time?'1':''?>"><?php echo $row['line']?></span>
<span class="cell <?php echo $beforetime2<=$todayM && $todayM < $time2?'light':'col1'?>"><?php echo $row['time2']?></span>
<span class="cell <?php echo $flag==-1?'white':'grey';echo $beforetime2<=$todayM && $todayM < $time2?'1':''?> ?>"><?php echo $row['line2']?></span>
</div>
      

      <?php
      if($i%5==0) $flag = $flag*-1;
      $i++;
      	$beforetime=$time;
		$beforetime2=$time2;           
	}   
      
      
   
   ?>


</div>
      </div>
      </div>
      
   <!-- 하단 바 카피라이트-->
      <div id="jb-footer">
          <img src="/wp-content/themes/ybus/Image/Bottom.png"/ style="margin-bottom:-5px;">
      </div>
    </div>
    <script src="/wp-content/themes/ybus/js/index.js"></script>
  </body>
</html>