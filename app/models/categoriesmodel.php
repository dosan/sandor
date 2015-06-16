<?php


class CategoriesModel extends MainModel{

	public function getProducts($parent_url = null, $category_url = null){
		$sql = "SELECT p.product_name, p.product_id, p.product_price, p.name_id, p.product_description, p.product_image, p.product_status,
						c.cat_name, c.cat_url, pc.cat_name AS parent_cat_name, pc.cat_url AS parent_cat_url
					FROM products AS p
				LEFT JOIN shop_categories AS c ON p.cat_id = c.cat_id
				LEFT JOIN shop_categories AS pc ON c.parent_id = pc.cat_id";
		if ($parent_url) {
			$sql .= " WHERE pc.cat_url = '{$parent_url}'";
		}
		if ($category_url) {
			$sql .= " AND c.cat_url = '{$category_url}'";
		}
		$query =  $this->db->query($sql);
		return $this->getArrayResult($query);
	}
/*	public function getPath($parent_url = null, $category_url = null){
		// change the product_id to product_url to in get request to use product_url
		$sql = "SELECT p.prdouct_name, p.product_id, c.cat_name, c.cat_url, pc.cat_name as parent_cat_name, pc.cat_url as parent_cat_url
				FROM products AS p
				LEFT JOIN shop_categories AS c ON c.cat_id = p.cat_id
				LEFT JOIN category AS pc ON pc.cat_id = c.parent_id";
		if ($parent_url) {
			$sql .= " WHERE pc.cat_url = '{$parent_url}'";
		}
		if ($category_url) {
			$sql .= " AND c.cat_url = '{$category_url}'";
		}
		$query =  $this->db->query($sql);
		return $this->getArrayResult($query);
	}*/

	public function getChildCategories($parent_url){
		$sql = "SELECT
			t1.cat_name AS cat_name,
			t1.cat_id
			FROM shop_categories AS t1
			LEFT JOIN shop_categories AS t2 ON t1.parent_id = t2.cat_id
			WHERE t2.cat_url = '{$parent_url}'
		";
		$query =  $this->db->query($sql);
		return $this->getArrayResult($query);
	}

	public function getCategories(){
		$sql = "SELECT
				c.cat_id,
				c.parent_id,
				c.cat_name
			FROM
				`shop_categories` AS p
			RIGHT JOIN `shop_categories` AS c
			ON p.cat_id = c.parent_id
		";
		$query =  $this->db->query($sql);
		return $this->getArrayResult($query);
	}

	/**
	 * Получить главные категории с привязками дочерних
	 * 
	 * @return array массив категорий 
	 */

	public function getAllMainCatsWithChildren(){
		// CHANGE THE CHILDREN FUNCTION TO RECURSION(CALL ITSELF INSTEAD getChildrenCategories)
		// static $recursion = 1;
		$sql = 
			"SELECT
				cat_id,
				parent_id,
				cat_name,
				cat_url
			FROM
				`shop_categories`
			WHERE
				parent_id = 0
			";
		$query =  $this->querySqlWithTryCatch($sql);
		$result = array();
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$rsChildren = $this->getChildrenCategories($row['cat_id']);
			if ($rsChildren) {
				$row['children'] = $rsChildren;
			}
			$result[] = $row;
		}
		return $result;
	}

	 /**
	 * Получить дочернии категории для категории $cat_id
	 * 
	 * @param integer $cat_id ID категории
	 * @return array массив дочерних категорий 
	 */
	public function getChildrenCategories($cat_id){
		$sql = 
			"SELECT
				cat_id,
				parent_id,
				cat_name,
				cat_url
			FROM
				`shop_categories`
			WHERE
				parent_id = '{$cat_id}'";
		$query =  $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($query);
	}
	/**
	* get all main categories
	*
	* @return array data catogries
	*/
	public function getAllMainCategories(){
		$sql = "SELECT *
			FROM shop_categories
			WHERE parent_id = 0
			";
		$result = $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($result);
	}
	/**
	* Add the new category
	* @param string $cat_name Name of category
	* @param integer $cat_parent_id ID parent category
	* @return integer ID new category
	*/
	public function insertCategory($cat_name, $cat_parent_id = 0){
		$cat_url = get_in_translate_to_en($cat_name);
		// prepare query
		$sql = "INSERT INTO
					`shop_categories`(`parent_id`, `cat_name`, `cat_url`)
				VALUES ({$cat_parent_id}, '{$cat_name}', '{$cat_url}')";

		$result = $this->querySqlWithTryCatch($sql);
		$cat_id = $this->db->lastInsertId();
		return $cat_id;
	}
	/**
	* Get All categories
	*
	* @return array categories
	*/
	public function getAllCategories(){
			$sql = "SELECT cat_name, cat_id
			FROM shop_categories
			ORDER BY parent_id ASC";

		$result = $this->querySqlWithTryCatch($sql);
		return $this->getArrayResult($result);
	}

	/**
	* Update Categories
	*
	* @param integer $item_id category id
	* @param integer $parent_id id main category
	* @param string $new_name new name category
	*
	*/
	public function updateCategoryData($item_id, $parent_id = -1, $new_name = ''){
		$set = array();
		if ($new_name) {
			$set[] = "`cat_name` = '{$new_name}'";
		}
		if ($parent_id > -1) {
			$set[] = "`parent_id` = {$parent_id}";
		}
		$setStr = implode($set, ", ");
		$sql = "UPDATE `shop_categories` SET $setStr WHERE cat_id = '{$item_id}'";
		$result = $this->querySqlWithTryCatch($sql);
		return $result;
	}

	public function getWithParentCategory($where){

		$sql = "SELECT
				c.cat_id,
				c.cat_name,
				c.parent_id,
				p.cat_name AS parent_cat_name
			FROM
				`shop_categories` AS p
			INNER JOIN `shop_categories` AS c
			ON p.cat_id = c.parent_id";

		$sql .= $where ? ' WHERE p.cat_id = '.$where.' OR c.cat_id = '.$where : '';
		
		$query =  $this->db->query($sql);
		return $query->fetchall(PDO::FETCH_ASSOC);
	}
}//endclass