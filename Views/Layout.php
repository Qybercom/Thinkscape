<!DOCTYPE html>
<html>
<head>
	<title><?php echo isset($title) ? $title : 'Thinkscape'; ?></title>

	<?php
	echo $this->Resources();
	$user = $this->User();

	$single = $this->_child instanceof \ViewModels\IThinkscapeSingleView;
	$thin = $this->_child instanceof \ViewModels\IThinkscapeThinHeaderView;
	?>
</head>
<body>
<header>
	<div class="left">
		<a class="quark-button logo" href="/">Thinkscape</a>
		<a class="quark-button">Admin</a>
		<a class="quark-button">Gallery</a>
		<a class="quark-button">About</a>
		<a class="quark-button">GitHub</a>
	</div>
	<form class="right">
		<input class="quark-input" placeholder="Search" />
		<a class="quark-button block fa fa-search"></a>

		<?php
		echo $user == null
			? '
				<a class="quark-button" href="/user/create">Register</a> or
				<a class="quark-button" href="/user/login">Login</a>
			'
			: '
				<a class="quark-button block fa fa-plus" href="/post/create"></a>
				<a class="quark-button" href="/user/' . $user->nickname . '"><img src="' . $user->avatar . '" class="avatar" title="' . $user->nickname . '" alt="Avatar" /></a>
			';
		?>
	</form>
</header>
<div id="quark-thinkscape-poster" style="min-height: <?php echo $thin ? '110px' : '300px'; ?>">
	<style>
		#quark-thinkscape-poster {
			background: url(/storage/20130710224438255.jpg);
		}
	</style>
	<?php
	if ($this->Child() instanceof \ViewModels\IndexView)
		echo '
			<div class="title" style="text-shadow: none; margin-top: 200px;">
				<span>Thinkscape</span>
				<p>Get your thinks fly!</p>
			</div>
		';

	if ($this->Child() instanceof \ViewModels\Post\IndexView)
		echo '
			<style>
			#quark-thinkscape-poster {
				background: url(' . $post->poster . ') center center;
				background-size: cover;
			}
			</style>
			<img class="avatar" src="', $post->author->avatar, '" alt="avatar" />
			<div class="title">
				<p>', date('M, d Y H:i', strtotime($post->date)), '</p>
				<span>', $post->title, '</span>',
				($post->Rights($this->User(), array(\Models\Post::RIGHT_MANAGE))
					? '<a class="quark-button block green" href="/post/update/' . $post->_id . '">Edit</a>
						<a class="quark-button block red" href="/post/delete/' . $post->_id . '?_signature=' . $this->Signature(false) . '">Delete</a>'
					: ''
				), '
			</div>
		';

	if ($this->Child() instanceof \ViewModels\Head\IndexView)
		echo '
			<style>
			#quark-thinkscape-poster {
				background: url(' . $head->poster . ') center center;
				background-size: cover;
			}
			</style>
			<div class="title">
				', $head->name, '
				<br><h4>', $head->about, '</h4><br><br>
				<p>Created ', date('M, d Y H:i', strtotime($head->date)), '</p>',
				($head->Rights($this->User(), \Models\HeadAccess::RIGHT_MANAGE)
				? '<a class="quark-button block green" href="/head/update/' . $head->_id . '">Edit</a>
					<a class="quark-button block red" href="/head/delete/' . $head->_id . '?_signature=' . $this->Signature(false) . '">Delete</a>'
				: ''
				), '
			</div>
			';
	?>
</div>
<div id="quark-thinkscape-page">
	<section style="width: <?php echo $single ? '80%' : '55%'; ?>">
		<?php echo $this->View(); ?>
	</section>
	<?php
	if (!$single) {
		echo '<div id="quark-thinkscape-menu">';

		// List of all heads
		echo '
			<nav>
				<h1>Heads</h1>
		';

			if (sizeof($this->heads) == 0) {
				echo 'It looks like there are no heads<br>';
			}
			else {
				foreach ($this->heads as $head)
					echo '<a class="quark-button section" href="/head/', $head->name, '">', $head->name, '</a>';

				echo '<a class="quark-button explore" href="/head/list">See all</a>';
			}

			if ($user != null && $user->role == \Models\User::ROLE_ADMIN)
				echo '<br><a class="quark-button block green" href="/head/create">Add one</a><br><br>';

		echo '</nav>';

		// List of related posts
		echo '
			<nav>
				<h1>Related</h1>
		';

			if (sizeof($this->posts) == 0) {
				echo 'It looks like there are no posts<br>';

				if ($this->User() != null)
					echo '<br><a class="quark-button block green" href="/post/create">Write one</a>';
			}
			else {
				foreach ($this->posts as $post)
					echo '
						<a class="quark-button post" href="/post/', $post->_id, '" style="background: url(', $post->poster, ');">
							<span>', $post->title, '</span>
						</a>
					';
			}

		echo '</nav>';

		echo '</div>';
	}
	?>
</div>
<footer>
	Thinkscape is an open source blog platform, written in PHP with Quark SaaS framework. Check it out on GitHub.
</footer>
</body>
</html>