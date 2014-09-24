<?php
 
Yii::import('application.vendors.*');
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
 
     $authenticationURL = 'https://www.google.com/accounts/ClientLogin';
 
     $httpClient = Zend_Gdata_ClientLogin::getHttpClient(
                      $username          = 'ajay.work11',
                      $password           = 'ajay4work',
                      $service           = 'youtube',
                      $client           = null,
                      $source           = 'PromoBang',
                      $loginToken           = null,
                      $loginCaptcha      = null,
                      $authenticationURL);
 	
     $devkey = 'AI39si46zwkIWokHimGp8yHJyKVugkmmSPo6JuiOQaKidSr1w_zN-VccQ1DPQAy_oqHWdbws2o6gqV9iikah9PjtBgDkcf7pUw';
 
          $yt = new Zend_Gdata_YouTube($httpClient, '', '', $devkey);
          $video = new Zend_Gdata_YouTube_VideoEntry();
 
 
          $video->setVideoTitle('Your video title');
          $video->setVideoDescription('Description of the video');
          $video->setVideoPrivate();
          $video->setVideoCategory('Select a category'); // see Youtube. Else you may get an error. Avoid using People & Blogs. People alone or Blogs alone is good.
          $video->SetVideoTags('apps');
          $handler_url     = 'http://gdata.youtube.com/action/GetUploadToken';
          $token_array     = $yt->getFormUploadToken($video, $handler_url);
          $token          = $token_array['token'];
          $post_url     = $token_array['url'];
          $next_url      = 'http://meradata.bugs3.com/studio/default/postUpload';
?>
 
<form action="<?php echo $post_url ?>?nexturl=<?php echo $next_url ?>"
method="post" enctype="multipart/form-data">
     <input name="file" type="file"/>
     <input name="token" type="hidden" value="<?php echo $token ?>"/>
     <input value="Upload Video File" type="submit" />
</form>