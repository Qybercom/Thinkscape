<h1>A new head</h1>
<br>
<form action="/head/create" method="POST">
	Let's describe it<br>
	<br>
	<input class="quark-input" name="name" placeholder="Give it a name" style="width: 100%; max-width: 300px;" /><br>
	<input class="quark-input" name="about" placeholder="Something about" style="width: 100%; max-width: 500px;" /><br>
	<br>
	<?php echo $this->Signature(); ?>
	<button type="submit" class="quark-button block green">Create</button>
</form>