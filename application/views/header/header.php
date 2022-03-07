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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
 </head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a href=<?php echo site_url('compet/main')?> class="navbar-brand mx-5">온라인대회접수</a>
    <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href=<?php echo site_url('compet/registed_athlete')?> class="nav-link">등록현황</a>
      </li>  
      <li class="nav-item">
        <a href=<?php echo site_url('compet/upload_suyaksu')?> class="nav-link">서약서업로드</a>
      </li>  
      <li class="nav-item">
        <a href=<?php echo site_url('compet/find_center')?> class="nav-link">도장검색</a>
      </li>  
      <li class="nav-item">
        <a href="https://www.notion.so/ccnplaza/2f8c465f46ea469abec7accae0798187" target="_blank" class="nav-link">도움말</a>
        <!-- <a href=<?php echo site_url('compet/help')?> class="nav-link">도움말</a> -->
      </li>  
    </ul>
    <ul class="navbar-nav">   
      <li class="nav-item me-5">
      <?php 
        $assoc = $_SESSION['assoc_id']; 
      $is_login = $_SESSION['login_user_approved']; 
        if($is_login == 1){
          $username = $_SESSION['login_user_name'];
          $center = $_SESSION['login_user_center'];
      ?>
        <a href=<?php echo site_url('compet/loginout')?> class="nav-link"><i class="bi bi-box-arrow-right"><?=$center?></i>로그아웃</a>
        </li>
        <li class="nav-item me-2">
          <a href=<?php echo site_url('compet/edit_center')?> class="nav-link"><i class="bi bi-pencil-square"></i>단체수정</a> 
        </li>  
        <?php } else { ?>  
        <a href=<?php echo site_url('compet/login')?> class="nav-link"><i class="bi bi-box-arrow-in-left"></i>로그인</a>
        </li> 
        <!--
      <li class="nav-item">
          <a href=<?php echo site_url('compet/regist_center/').$assoc?> class="nav-link">단체(도장)등록</a> 
        </li>  
      -->
      <?php } ?>
    </ul>    
    </div>  
</div>  
</nav>
