<div class="col-md-9">
	<script type="text/javascript" src="<?php echo JS_PATH ?>angular-controllers/product-pagination.js"></script>
	<script type="text/javascript" src="<?php echo JS_PATH ?>angular-controllers/modal-product.js"></script>
	<div class="row" ng-controller="ProductPagination">
		<h1>Last added Products</h1>
		<div>
			<ul class="pagination">
				<li ng-class="{disabled: main.page == 1}">
					<a href="#" ng-click="previousPage()">« Prev</a>
				</li>
				<li ng-repeat="n in range()" ng-class="{active: main.page == n}" >
					<a href="#" ng-click="setPage(n)">{{n}}</a>
				</li>
				<li ng-class="{disabled: main.pages == main.page}">
					<a href="#" ng-click="nextPage();"> Next »</a>
				</li>
			</ul>
		</div>
		<div>
			<div class="col-sm-4 col-lg-4 col-md-4" ng-repeat="product in products">
				<div class="thumbnail">
					<img style="max-height: 150px; height: 150px;" ng-src="/public/img/{{product.product_image}}" alt="Product">
					<span class="label-success">{{product.product_price}}tg</span>
					<div class="caption">
						<h4><a href='' ng-click="Modal.open(product)">{{product.product_name}}</a></h4>
						<p>{{product.product_description}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>