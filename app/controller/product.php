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
	public function category($parent = null, $category = null){
		require(VIEWS_PATH."layouts".DS."header.php");
		require(VIEWS_PATH."layouts".DS."sidebar.php");
		require(VIEWS_PATH."category".DS."index.php");
		require(VIEWS_PATH."layouts".DS."footer.php");
	}

	/**********************GET DATA FROM DATABASE FOR ANGULAR**************************/


	public function getProducts($parent = null, $category = null){
		$products =  $this->categories_model->getProducts($parent, $category);
		echo json_encode($products);
	}

	public function navigation(){
		echo json_encode($this->categories_model->getAllMainCatsWithChildren());
	}

	public function getProductsByCategory($cat_id, $limit = null){
		$prudcts_model = $this->model('ProductsModel');
		$products = $prudcts_model->getProductsByCat($cat_id, $limit);
		echo json_encode($products);
	}


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
}