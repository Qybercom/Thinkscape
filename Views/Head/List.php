<h1>Heads</h1>
<?php
foreach ($heads as $head)
	echo '<a class="quark-thinkscape-head" href="', $head->name, '" style="background: url(', $head->poster, ');">
			<h3>', $head->name, '</h3>
			<div class="about">', $head->about, '</div>
		</a>';