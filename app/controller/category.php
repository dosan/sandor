<?php

class Category extends Controller
{

	public function index(){
		$this->loadViewTemplFolderTemplName('category', 'index.php');
	}

	public function getId($cat_id){

		$this->loadViewTemplFolderTemplName('category','index.php');
	}

	public function getCategoriesWithProducts($cat_id = null)
	{
		$products_model = $this->model('ProductsModel');

		$result = array();

		$data = $this->categories_model->getWithParentCategory($cat_id);
		foreach ($data as $key => $value) {
			$limit = $value['cat_id'] == $cat_id ? 6 : 3;
			if ($limit) {
				$value['products'] = $products_model->getProductsByCat($value['cat_id'], $limit);
			}
			$result[] = $value;
		}

		echo json_encode($result);
	}
	public function getCategories(){
		echo  json_encode($this->categories_model->getAllMainCatsWithChildren());
	}
}
