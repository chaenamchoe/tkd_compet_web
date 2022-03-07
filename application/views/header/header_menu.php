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
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <header class="flex justify-between text-gray-500 py-4 px-8 bg-black">
		<a href="<?php echo site_url('compet/main')?>" class="text-lg font-bold hover:text-white">온라인대회접수</a>
		<ul class="hidden sm:flex flex-row items-center align-middle gap-4">
			<li><a href="<?php echo site_url('compet/registed_athlete')?>" class="hover:text-white hover:font-bold">등록현황</a></li>
			<li><a href="<?php echo site_url('compet/upload_suyaksu')?>" class="hover:text-white hover:font-bold">서약서업로드</a></li>
			<li><a href="<?php echo site_url('compet/find_center')?>" class="hover:text-white hover:font-bold">도장검색</a></li>
      <li><a href="<?php echo site_url('compet/help')?>" class="hover:text-white hover:font-bold">도움말</a></li>
		</ul>
    <ul>
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
    <?php } ?>
    </ul>    
    <button class="sm:hidden hover:font-bold">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
			</svg>
		</button>
	</header>    
