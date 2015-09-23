<h1><?php echo $user->nickname; ?> meditation place</h1>
<br>
<h3>Something about You?</h3><br>
<img src="<?php echo $user->avatar; ?>" alt="avatar" style="float: left; margin: 0 10px 10px 0; max-width: 75px; max-height: 75px;" />
Hi! My name is <?php echo $user->name; ?>.<br>
I am here from <?php echo date('d F Y', strtotime($user->date)); ?>, and
<?php
if (sizeof($user->favourites) == 0)
	echo ' it looks like I am not interested in anything at this time';
else {
	echo 'I am interested of';

	foreach ($user->favourites as $favourite)
		echo '<a class="quark-button" href="/head/', $favourite->_id, '">', $favourite->_id, '</a>';

	if (sizeof($user->favourites) > 4)
		echo ' and <a class="quark-button" href="/head/list/?subscriber=', $user->_id, '">many other</a> themes<br>';
}
?>
<br>
Looks like I am on 1 place in rating. It's cool!<br>
<br>
<br>
<br>
<?php
if (sizeof($posts) == 0)
	echo 'It looks like I doesn\'t wrote any posts. Maybe later.';
else {
	echo '
		Check out my posts. Most popular of them are:<br>
		<ul>
	';

	foreach ($posts as $post)
		echo '<li><a class="quark-button" href="/post/', $post->_id, '">', $post->title, '</a></li>';

	echo '</ul>';

	if (sizeof($posts) > 3)
		echo '...and <a class="quark-button" href="/post/list/?author=', $user->_id, '">many other</a><br>';
}

if ($this->User() != null && $user->_id == $this->User()->_id)
	echo '
		<br>
		<br>
		<br>
		<h3>Secure area</h3>
		Here are a few options that available only for account owner<br>
		<br>
		<a class="quark-button block green" href="/user/update/', $user->_id, '">Update profile</a>
		<a class="quark-button block" href="/user/logout/?_s=', $this->Signature(false), '">Logout</a>
	';