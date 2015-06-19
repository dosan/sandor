<?php

class Product extends Controller
{
	/**
	 * @var array $products data of products
	 */
	public $product = null;
	public $productInBasket = 0;
	public function index()
	{
		require(VIEWS_PATH."layouts".DS."header.php");
		require(VIEWS_PATH."layouts".DS."sidebar.php");
		require(VIEWS_PATH."product".DS."index.php");
		require(VIEWS_PATH."layouts".DS."footer.php");
	}


	/**********************GET DATA FROM DATABASE FOR ANGULAR**************************/


	public function getData($page = 1, $limit = 9){
		$offset = ($page - 1) * $limit;
		$prudcts_model = $this->model('ProductsModel');
		$products = $prudcts_model->getLastProducts($limit, $offset);
		echo json_encode($products);
	}
	/**
	* Воводим информацию о продукте
	* 
	* @param $product_id integer index product id
	**/
	public function getId($product_id){
		if(in_array($product_id, $_SESSION['basket'])){
			$this->productInBasket = 1;
		}
		$product_model = $this->model('ProductsModel');
		$this->product = $product_model->getProductById($product_id);
		$this->loadViewTemplFolderTemplName('product','getid.php');
	}
	public function getProduct($id){
		$model = $this->model('ProductsModel');
		echo json_encode($model->getProductById($id));
	}
}