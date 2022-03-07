<style>
/* Small devices (landscape phones, 544px and up) */
@media (max-width: 544px) {  
  h1 {font-size:2rem;} /*1rem = 16px*/
  h2 {font-size:1.5rem;} /*1rem = 16px*/
  h3 {font-size:1.5rem;} /*1rem = 16px*/
  h4 {font-size:1rem;} /*1rem = 16px*/
}	
</style>

<?php
require './vimeo_uploader/vendor/autoload.php';
use Vimeo\Vimeo;

$client = new Vimeo("3c1687ab0a3cbf25924093dd0b5f2ccef136af52", 
	"SxapeL6t6qigWdjkOtibL5c7Cby4bABbgBZ0ORt8VxHmDiZncjap9DyMLKcRy25o5F/6rj9tReMhwXexMreCRifeC1kGs18S3i0yvtrfv5mQ3KygW46xINkrniPTxxAV", 
	"7f369133c2c114c8b2eceb594b342476");

//$response = $client->request('/tutorial', array(), 'GET');
//print_r($response);
//$url = "https://www.dropbox.com/home/$video_name";
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
//exit;
$vimeo_str = $response['body']['uri'];
$vimeo_id = explode('/',$vimeo_str);
//echo('<script>document.getElementById("btn").click();</script>');
?>
<div class="container">
	<br/>
	<div class="row text-center">
		<div class="col-sm-12 text-center">
		<h3>���� ������ ���������� ���ε� �Ǿ����ϴ�.</h3>
		</div>
		<div id="msg"></div>
		<div id="video_id"></div>
	</div>
	<hr>
	<div class="row text-center">
		<br/>
		<div class="col-sm-12 text-center">
			<p><h4>
				���������� ���ε� �Ǹ� �ڵ����� ���ڵ��� ���۵˴ϴ�.<br>
				���ڵ��� ���� ������ ��Ʈ����Ʈ(Bitrate)�� ����ð���	���� �ٸ��ϴ�.<br>
				��ȭ�� �� 1080p(FHD: 1920x1080) �Ǵ� 720p(HD: 1080x720)��<br>
				��ȭ������ �Ǿ� �ִ����� Ȯ�� �� �� �Կ��ϼ���.
				</h4>
			</p>
			<a id="btn" href=<?php echo site_url("compet/update_athlete_videoid/$a_id/$vimeo_id[2]")?> class="btn btn-primary btn-lg">���â���� �̵�</a>
		</div>	
	</div>	
	<hr>
<script>
	document.getElementById("btn").click();
</script>
