<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
  <title><?=config_item('site_header')?></title>
  <meta charset="UTF-8">
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
  <ul class="navbar-nav">
    <li class="nav-item">
      <?php if($_SESSION['compet_id']==36){ ?>
	  <a href=<?php echo site_url('compet/login')?> class="navbar-brand">Online Regist</a>
	  <?php }else{ ?>
	  <a href=<?php echo site_url('compet/main')?> class="navbar-brand">Online Regist</a>
	  <?php } ?>
    </li>  
    <li class="nav-item">
      <a href=<?php echo site_url('compet/registed_athlete')?> class="nav-link">Show Register</a>
      </li>  
    <!--
    <li class="nav-item">
      <a href=<?php echo site_url('compet/add_athlete')?> class="nav-link">Regist</a>
      </li>  
	<li class="nav-item">
      <a href=<?php echo site_url('compet/upload_file')?> class="nav-link">참가신청서</a>
    </li>
    <li class="nav-item">
      <a href=<?php echo site_url('compet/upload_suyaksu')?> class="nav-link">Pledge Upload</a>
    </li>  
    <li class="nav-item">
      <a href=<?php echo site_url('compet/find_center')?> class="nav-link">Search Center</a>
    </li>  
    <li class="nav-item">
      <a href=<?php echo site_url('compet/help')?> class="nav-link">Help</a>
    </li>  
     <li class="nav-item">
         <?php if(!empty($_SESSION['active_competition_manual'])){ 
            $manual_name = $_SESSION['active_competition_manual'];
         ?>
            <a href="http://docs.google.com/gview?url=http://ccnplaza.com/img/<?=$manual_name?> &embedded=true" class="nav-link" target="_blank">대회요강</a>
         <?php } ?>
    </li>  
	-->	
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
      <a href=<?php echo site_url('compet/loginout')?> class="nav-link"><?=$center?> Logout</a>
      </li>
      <!--
	  <li class="nav-item">
        <a href=<?php echo site_url('compet/edit_center')?> class="nav-link">Edit Center </a> 
      </li>  
	  -->
      <?php } else { ?>  
      <a href=<?php echo site_url('compet/login')?> class="nav-link">Login</a>
      </li> 
      <!--
	  <li class="nav-item">
        <a href=<?php echo site_url('compet/regist_center/').$assoc?> class="nav-link">단체(도장)등록</a> 
      </li>  
	  -->
    <?php } ?>
  </ul>    
</nav>
