		</div>
		</div>
	<footer>
		<div class="container">
			<p class="text-muted">Footer copyright 2014</p>
		</div>
	</footer>
		<script type="text/javascript" src="<?php echo JS_PATH ?>jquery.js"></script>
		<script type="text/javascript" src="<?php echo JS_PATH ?>bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo URL; ?>public/js/application.js"></script>
		<script type="text/javascript" src="<?php echo JS_PATH ?>fancybox/jquery.fancybox.js"></script>
		<script type="text/javascript" src="<?php echo URL ?>js/angular.js"></script>
		<script data-require="angular-ui-bootstrap@0.3.0" data-semver="0.3.0" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.3.0.min.js"></script>
		<script type="text/javascript" src="<?php echo URL ?>js/angular-route.js"></script>
		<script type="text/javascript" src="<?php echo URL ?>js/controllers.js"></script>
		<script>
		<?php
			$jsMessages = json_encode($this->mess);
			echo "var jsMessages = ". $jsMessages . ";\n";
		?>
		</script>
	</body>
</html>