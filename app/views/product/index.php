<div class="col-md-9">
	<script type="text/javascript" src="<?php echo JS_PATH ?>angular-controllers/product-pagination.js"></script>
	<script type="text/javascript" src="<?php echo JS_PATH ?>angular-controllers/modal-product.js"></script>


<div ng-controller="ModalProduct">
    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">Im a modal!</h3>
        </div>
        <div class="modal-body">
            <ul>
                <li ng-repeat="item in items">
                    <a ng-click="selected.item = item">{{ item }}</a>
                </li>
            </ul>
            Selected: <b>{{ selected.item }}</b>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok()">OK</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>

    <button class="btn btn-default" ng-click="open()">Open me!</button>
    <button class="btn btn-default" ng-click="open('lg')">Large modal</button>
    <button class="btn btn-default" ng-click="open('sm')">Small modal</button>
    <button class="btn btn-default" ng-click="toggleAnimation()">Toggle Animation ({{ animationsEnabled }})</button>
    <div ng-show="selected">Selection from a modal: {{ selected }}</div>
</div>


	<div class="row" ng-controller="ProductPagination">
		<h1> {{main.title}} </h1>
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
					<img style="max-height: 150px; height: 150px;" ng-src="{{product.product_image}}" alt="Product">
					<span class="label-success">{{product.product_price}}tg</span>
					<div class="caption">
						<h4><a href="/product/{{product.product_id}}/">{{product.product_name}}</a></h4>
						<p>{{product.product_description}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>