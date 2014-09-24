<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionVideo()
	{
		$this->render('video');
	}
	public function actionPostUpload(){
		echo print_r($_REQUEST);
	}
	public function actionUpload(){
		$this->render('upload');
	}
}