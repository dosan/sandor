<?php

class Category extends Controller
{

	public function index(){
		d($this->categories_model->getProducts('main_category_2'));
		$this->loadViewTemplFolderTemplName('category', 'index.php');
	}

	public function getId($cat_id){
		$this->loadViewTemplFolderTemplName('category','index.php');
	}


}
