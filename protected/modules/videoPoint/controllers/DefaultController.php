<?php

class DefaultController extends Controller
{
	
	public function actionIndex() {
		$model = new UserDetails('searchVideoPoint');
		$model->unsetAttributes();
		$model->location = Yii::app()->request->cookies['siteName'];
			
		if (isset($_GET['UserDetails']))
			$model->setAttributes($_GET['UserDetails']);
	
		$this->render('admin', array(
				'model' => $model,
		));
	}
	public function actionVideo($id){
		$this->render('video',array('userId'=>$id));
	}
	public function actionUploadFile(){
		$id = $_REQUEST['id'] ;
		$model = UserDetails::model()->findByPk($id) ;
		//echo print_r($_REQUEST,true);
 		$fileName = $_FILES["file1"]["name"]; // The file name
		$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES["file1"]["type"]; // The type of file it is
		$fileSize = $_FILES["file1"]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
		if (!$fileTmpLoc) { // if file not chosen
			echo "ERROR: Please browse for a file before clicking the upload button.";
			exit();
		}
		echo 'File name'.$fileName." tmp loc ".$fileTmpLoc ;
		
		// set up basic connection
		$conn_id = ftp_connect(Yii::app()->params['remoteHost']); 
		
		// login with username and password
		$login_result = ftp_login($conn_id, Yii::app()->params['remoteUser'] , Yii::app()->params['remotePwd'] );
		$remoteFile = Yii::app()->params['uploadDir'].'/'.$fileName ;

		$model->status = 'Video Uploaded' ;
		// upload a file
/* 		try{
		if (ftp_put($conn_id, $remoteFile, $fileTmpLoc,FTP_BINARY)) {
			echo "successfully uploaded $fileName \n";
			$model->posting_status = 'Remote Success' ;
						
		} else {
			echo "There was a problem while uploading $fileName\n";
			$model->posting_status = 'Remote Failure' ;
	
		}
		}catch(Exception $ex){
			$model->posting_status = 'Remote Failure' ;
		} */
		if($model->save()){
			echo 'Video has been uploaded.' ;
		}else{
			echo 'Video could not be uploaded, Please retry.\n Errors :\n'.print_r($model->errors,true);
		}
		
 	/* 	if(move_uploaded_file($fileTmpLoc, "test_uploads/$fileName")){
			echo "$fileName upload is complete";
		} else {
		echo "move_uploaded_file function failed";
} */
	}
}
/*
 * send via curl
 * $ch = curl_init();
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('file' => '@/path/to/file.txt'));
curl_setopt($ch, CURLOPT_URL, 'http://server2/upload.php');
curl_exec($ch);
curl_close($ch);
 * /
 */