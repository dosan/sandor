<script type="text/javascript" src="<?php echo JS_PATH ?>angular-controllers/categories-products.js"></script>
	<div class="col-md-9" ng-controller="CategoriesProducts">
		<h1> {{main.title}} </h1>
		<div>
			<div class="col-md-9">
				<a href="/">Home</a>
				/ <a href="{{main.linkTo}}" ng-click="loadPage()">Categories</a>
				<span ng-if="Products[0].parent_cat_url == main.categories[0]">
					/ <a href="{{main.linkTo + Products[0].parent_cat_url }}" ng-click="loadPage()">{{Products[0].parent_cat_name}}</a>
				</span>
				<span ng-if="Products[0].cat_url == main.categories[1]">
					/ <a href="{{main.linkTo + Products[0].parent_cat_url+'/'+Products[1].cat_url }}" ng-click="loadPage()">{{Products[0].cat_name}}</a>
				</span>
			</div>
				<div class="col-md-9">
					<h3>{{category.products == '' ? main.categoryIsEmtpy : ''}}</h3>
				</div>
				<div class="col-sm-4 col-lg-4 col-md-4" ng-repeat="product in Products">
					<div class="thumbnail">
						<img style="max-height: 150px; height: 150px;" ng-src="{{main.url+'/public/img/no-image.png'}}" alt="Product">
						<span class="label-success">{{product.product_price}}tg</span>
						<div class="caption">
							<h4><a href="/product/{{product.product_id}}/" ng-click="loadPage()">{{product.product_name}}</a></h4>
							<p>{{product.product_description}}</p>
						</div>
					</div>
				</div>
		</div>
	</div>
