	<div class="col-md-9">
		<script type="text/javascript" src="<?php echo JS_PATH ?>angular-controllers/categories-products.js"></script>
		<div class="row" ng-controller="CategoriesProducts">
			<h1> {{main.title}} </h1>
			<div>
				<div ng-repeat="category in categoriesWithProducts">
					<div class="col-md-9">
						<a href="{{main.linkTo}}" ng-click="setCategory()">Categories</a> > 
						<a href="{{main.linkTo+category.parent_id}}" ng-click="setCategory(category.parent_id)">{{category.parent_cat_name}}</a> > 
						<a href="{{main.linkTo+category.cat_id}}" ng-click="setCategory(category.cat_id)">{{category.cat_name}}</a>
					</div>
					<div class="col-md-9">
						<h3>{{category.products == '' ? main.categoryIsEmtpy : ''}}</h3>
					</div>
					<div class="col-sm-4 col-lg-4 col-md-4" ng-repeat="product in category.products">
						<div class="thumbnail">
							<img style="max-height: 150px; height: 150px;" ng-src="{{main.url+'/public/img/no-image.png'}}" alt="Product">
							<span class="label-success">{{product.product_price}}tg</span>
							<div class="caption">
								<h4><a href="/product/{{product.product_id}}/" target="_self">{{product.product_name}}</a></h4>
								<p>{{product.product_description}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
