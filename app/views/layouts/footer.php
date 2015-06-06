
		</div>
		</div>
	<footer>
		<div class="container">
			<p class="text-muted">Footer copyright 2014</p>
		</div>
	</footer>
		<script>
		<?php
			$jsMessages = json_encode($this->mess);
			echo "var jsMessages = ". $jsMessages . ";\n";
		?>
		</script>
	</body>
</html>