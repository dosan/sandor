	<div class="col-md-3">
		<p class="lead">Shop Name</p>

		<div class="list-group">
			<div ng-repeat="category in Factory.getCategories()">
				<a href="{{main.url+main.linkTo + category.cat_url}}" class="list-group-item" target="_self">{{category.cat_name}}</a>
				<div ng-repeat="childs in category.children">
					<a href="{{main.url+main.linkTo + category.cat_url +'/'+ childs.cat_url}}" class="list-group-item" target="_self">--{{childs.cat_name}}</a>
				</div>
			</div>
		</div>
	<?php if (Session::get('user_login_status') == 1): ?>
		<div id="userBox">
			<a href="<?php echo URL. 'user/'?>" id="userLink"><?php echo Session::get('user_name'); ?></a><br>
			<a href="<?php echo URL ?>user/logout" onClick="logout();">Log Out</a>
		</div>
	<?php else: ?>
	<?php if (! isset($this->hideLoginBox)): ?>
		<div id="loginBox">
			<h2 class="form-signin-heading">Please sign in</h2>
			<form method="post" id="sidebarLogin">
				<input name="user_name" type="text" id="user_name" class="form-control" value="" placeholder="Email address" required autofocus>
				<input name="user_password" type="password" id="user_password" class="form-control" value="" placeholder="Password" required>
				<br>
				<a href="#" onclick="loginAd('sidebarLogin'); return false;" class="btn btn-primary submitLogin" data-target="sidebarLogin">Log in</a>
				<a href="<?php echo URL ?>user/register" title="Регистрация">Регистрация</a>
			</form>
		</div>
	<?php endif ?>
		<div id="userBox" class="hide">
			<a href="#" id="userLink"></a><br>
			<a href="<?php echo URL ?>user/logout" onClick="logout();">Log Out</a>
		</div>
	<?php endif ?>
		<div class="menuCaption">Basket</div>
		<a href="<?php echo URL ?>basket" title="Перейти в корзину">В корзине</a>
		<span id="basketcountProducts">
		<?php if ($this->basketcountProducts > 0): 
			echo $this->basketcountProducts;
			else: ?>
			Empty
			<?php endif ?>
		</span>
	</div>