<div class="modal-header">
	<h3 class="modal-title">{{product.product_name}}</h3>
</div>
<div class="modal-body">
	<img width="555"  src="/public/img/{{product.product_image}}"/>
	<p>{{product.product_description}}</p>
	Price: <b>{{ product.product_price }}</b>
</div>
<div class="modal-footer">
	<button class="btn btn-primary" ng-hide='inBasket' ng-click="addToBasket(product.product_id)">Add To Basket</button>
	<button class="btn btn-primary" ng-show='inBasket' ng-click="removeFromBasket(product.product_id)">Remove From Basket</button>
	<a href='/basket'  target='_self'>In Basket</a> {{Factory.getInBasket().count}}
</div> 