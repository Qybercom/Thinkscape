<h1>A new post.</h1>
Think about something great!<br>
<br>
<form action="/post/create" method="POST">
	<input class="quark-input" name="title" placeholder="Let's give it a title" style="width: 100%; max-width: 300px;" /><br>
	<?php
	if (sizeof($this->User()->heads) == 0)
		echo '<br>There are no team heads that You have access to, so we put that post to your\'s<br>';
	else {
		echo '<select name="head" class="quark-input">';

		foreach ($this->User()->heads as $access)
			echo '<option value="', $access->head->_id, '"', ($head != null && (string)$head->_id == (string)$access->head->_id ? ' selected' : ''),'>', $access->head->name, '</option>';

		echo '</select>';
	}
	?>
	<br>
	<textarea class="quark-input post" name="content" placeholder="So, put your thinks here"></textarea><br>
	<br>
	<?php echo $this->Signature(); ?>
	<button type="submit" class="quark-button block green">Create</button>
</form>