<?php
require './vimeo_uploader/vendor/autoload.php';
use Vimeo\Vimeo;

$client = new Vimeo("3c1687ab0a3cbf25924093dd0b5f2ccef136af52", 
	"SxapeL6t6qigWdjkOtibL5c7Cby4bABbgBZ0ORt8VxHmDiZncjap9DyMLKcRy25o5F/6rj9tReMhwXexMreCRifeC1kGs18S3i0yvtrfv5mQ3KygW46xINkrniPTxxAV", 
	"7f369133c2c114c8b2eceb594b342476");

//$response = $client->request('/tutorial', array(), 'GET');
//print_r($response);

$url = "http://ccnplaza.com/tkd_compet/video/$video_name";
$response = $client->request(
    '/me/videos',
    [
        'upload' => [
            'approach' => 'pull',
            'link' => $url
        ],
    ],
    'POST'
);
//var_dump($response);
echo $response['body']['uri'];
?>
<div class="container">
	<div class="row text-center">
		file upload successed...
	</div>
	<div id="a_id"><?=$a_id?></div>
	<div id="video_name"><?=$video_name?></div>
	<div id="vimeo_id"><?=$video_name?></div>
</div>