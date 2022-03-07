<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'compet';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//대회접수 	소속명/컨트리코드
$route['goyang'] = 'compet/assoc/1/0/0';		//고양시
$route['ansan'] = 'compet/assoc/4/0/0';		//안산시
$route['anyang'] = 'compet/assoc/5/0/0';		//안양시
$route['kwangju'] = 'compet/assoc/2/1/0';	//광주시태권도협회
$route['gvcs'] = 'compet/assoc/9/0/0';		//글로벌
$route['gvcs/1'] = 'compet/assoc/9/0/1';   	//글로벌(영문)
$route['kwangjin'] = 'compet/assoc/10/0/0';		//광진구협회
$route['korea'] = 'compet/assoc/11/0/0';	//한중대회
$route['korea/1'] = 'compet/assoc/11/0/1';  //한중대회(영문)
$route['sihung'] = 'compet/assoc/12/0/0';		//시흥시
$route['bme'] = 'compet/assoc/13/0/0';		//bme	
$route['bme/1'] = 'compet/assoc/13/0/1';   	//bme국제대회(영문)
$route['dragoncup'] = 'compet/assoc/15/0/0';	//드라곤컵
$route['dragoncup/1'] = 'compet/assoc/15/0/1';   //드라곤컵(영문)
$route['ntad'] = 'compet/assoc/16/0/0';   //남양주시장애인태권도협회
$route['hanam'] = 'compet/assoc/17/0/0';   //하남시태권도협회
$route['djtkd'] = 'compet/assoc/18/0/0';   //대전시태권도협회
$route['km'] = 'compet/assoc/19/0/0';   //한국무예전부경수박기수덕협회
$route['guri'] = 'compet/assoc/20/0/0';   //구리시태권도협회
$route['yangju'] = 'compet/assoc/21/0/0';   //양주시태권도협회
$route['ambassador'] = 'compet/assoc/22/0/0';   //대사배태권도대회
$route['ambassador/1'] = 'compet/assoc_amb/22/0/1';   //대사배태권도대회
$route['mta'] = 'compet/assoc/23/0/0';   //MTA태권도
$route['usfk'] = 'compet/assoc/24/0/1';   //주한미군태권도
$route['kmtkd'] = 'compet/assoc/25/0/0';   //광명시태권도
$route['ulju'] = 'compet/assoc/26/0/0';   //을주군태권도
$route['kuysc'] = 'compet/assoc/27/0/0';   //김운용컵
$route['kuysc/1'] = 'compet/assoc/27/0/1';   //김운용컵
$route['bucheon'] = 'compet/assoc/28/0/0';   //부천시협회
$route['ktmca'] = 'compet/assoc/29/0/0';   //대한특공무술중앙회
$route['ujbtkd'] = 'compet/assoc/30/0/0';   //의정부태권도협회
$route['123news'] = 'compet/assoc/32/0/0';   //123news
$route['wthands'] = 'compet/assoc/33/0/0';   //세계태권도손기술어울림
$route['wthands/1'] = 'compet/assoc/33/0/1';   //세계태권도손기술어울림
$route['sungnam'] = 'compet/assoc/34/0/0';   //성남시태권도협회
$route['compet/(:num)'] = 'compet/asso/$1';
$route['compet/(:num)/(:num)'] = 'compet/assoc/$1/0/$2';
$route['compet/(:num)/(:num)/(:num)'] = 'compet/assoc/$1/$2/$3';

$route['regist/(:num)'] = 'compet/regist/$1';
$route['regist/(:num)/(:num)'] = 'compet/regist/$1/$2';


$route['youtube/(:num)'] = 'video/youtubelive/$1';
$route['youtube/edit/(:num)'] = 'video/youtube_edit/$1';

//비디오재생	video/대회코드/코트번호
$route['video/(:num)'] = 'video/videos/$1';
$route['video/(:num)/(:num)'] = 'video/videos/$1/$2/0';
$route['video/(:num)/(:num)/(:num)'] = 'video/videos/$1/$2/$3';

//대진표 및 순위 match/대회코드
$route['match/(:num)'] = 'match/matches/$1/0';
$route['match/(:num)/(:num)'] = 'match/matches/$1/$2';
//부심채점 point/대회코드/코트번호/부심번호
$route['point'] = 'point/set_compet';
$route['point/(:num)/(:num)/(:num)'] = 'point/points/$1/$2/$3';
//원격채점 
$route['judge/(:num)'] = 'judge/judges/$1';
$route['judge/(:num)/(:num)'] = 'judge/judges/$1/$2';

