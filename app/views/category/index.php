	<div class="col-md-9">
		<script type="text/javascript" src="<?php echo JS_PATH ?>angular-controllers/categories-products.js"></script>
		<script type="text/javascript" src="<?php echo JS_PATH ?>angular-controllers/modal-product.js"></script>

		<div class="row" ng-controller="CategoriesProducts">
			<button class="btn btn-default" ng-click="Modal.toggleAnimation()">Toggle Animation ({{ Modal.getAnimation() }})</button>
			<h1> Categories with last 3 products </h1>
			<div>
				<div ng-repeat="category in categoriesWithProducts">
					<div class="col-md-9">
						<a href="{{main.linkTo}}" ng-click="setCategory('')">Categories</a> > 
						<a href="{{main.linkTo+category.parent_id}}" ng-click="setCategory(category.parent_id)">{{category.parent_cat_name}}</a> > 
						<a href="{{main.linkTo+category.cat_id}}" ng-click="setCategory(category.cat_id)">{{category.cat_name}}</a>
					</div>
					<div class="col-md-9">
						<h3>{{category.products == '' ? main.categoryIsEmtpy : ''}}</h3>
					</div>
					<div class="col-sm-4 col-lg-4 col-md-4" ng-repeat="product in category.products">
						<div class="thumbnail">
							<img style="max-height: 150px; height: 150px;" ng-src="/public/img/{{product.product_image}}" alt="Product">
							<span class="label-success">{{product.product_price}}tg</span>
							<div class="caption">
								<h4><a href="" ng-click="Modal.open(product)">{{product.product_name}}</a></h4>
								<p>{{product.product_description}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>