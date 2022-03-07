<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
  <title><?=config_item('site_header')?></title>
  <meta charset="EUC-KR">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
 </head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a href=<?php echo site_url('compet/main')?> class="navbar-brand">온라인대회접수</a>
    </li>  
    <li class="nav-item">
      <a href=<?php echo site_url('compet/registed_athlete')?> class="nav-link">등록현황</a>
      </li>  
    <!--
	<li class="nav-item">
      <a href=<?php echo site_url('compet/upload_file')?> class="nav-link">참가신청서</a>
    </li>
	-->	
    <li class="nav-item">
      <a href=<?php echo site_url('compet/upload_suyaksu')?> class="nav-link">서약서업로드</a>
    </li>  
    <li class="nav-item">
      <a href=<?php echo site_url('compet/find_center')?> class="nav-link">도장검색</a>
    </li>  
    <li class="nav-item">
      <a href=<?php echo site_url('compet/help')?> class="nav-link">도움말</a>
    </li>  
     <li class="nav-item">
         <?php if(!empty($_SESSION['active_competition_manual'])){ 
            $manual_name = $_SESSION['active_competition_manual'];
         ?>
            <a href="http://docs.google.com/gview?url=http://ccnplaza.com/img/<?=$manual_name?> &embedded=true" class="nav-link" target="_blank">대회요강</a>
         <?php } ?>
    </li>  
  </ul>
  <ul class="navbar-nav ml-auto">   
    <li class="nav-item">
    <?php 
      $assoc = $_SESSION['assoc_id']; 
	  $is_login = $_SESSION['login_user_approved']; 
      if($is_login == 1){
        $username = $_SESSION['login_user_name'];
        $center = $_SESSION['login_user_center'];
    ?>
      <a href=<?php echo site_url('compet/loginout')?> class="nav-link"><?=$center?> 로그아웃</a>
      </li>
      <li class="nav-item">
        <a href=<?php echo site_url('compet/edit_center')?> class="nav-link">단체(도장)수정 </a> 
      </li>  
      <?php } else { ?>  
      <a href=<?php echo site_url('compet/login')?> class="nav-link">로그인</a>
      </li> 
      <!--
	  <li class="nav-item">
        <a href=<?php echo site_url('compet/regist_center/').$assoc?> class="nav-link">단체(도장)등록</a> 
      </li>  
	  -->
    <?php } ?>
  </ul>    
</nav>
