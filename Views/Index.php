<?php
if (sizeof($posts) == 0) {
	echo '
		<h1>An empty blog...</h1>
		Here is some empty space, because here are no blog posts.
	';

	if ($this->User() != null)
		echo ' Go on, create one!<br>
			<br>
			<a class="quark-button block green" href="/post/create">Create</a>
	';
}
else
	foreach ($posts as $post) {
		echo '
			<article>
				<a class="quark-button" href="/post/', $post->_id, '"><h1>', $post->title, '</h1></a>
				', $post->content, '
				<div class="summary">
					<a class="quark-button fa fa-comments" href="/post/comment/list/', $post->_id, '"> ', sizeof($post->comments), '</a>
					<a class="quark-button fa fa-user" href="/user/', $post->author->nickname, '" title="', $post->author->name, '"> ', $post->author->nickname, '</a>
					<a class="quark-button fa fa-calendar-o" href="/post/list/?date=', $post->date, '"> ', date('M, d Y H:i', strtotime($post->date)), '</a>';

					if ($post->head != null)
						echo '<a class="quark-button" style="float: right;" href="/head/', $post->head->name, '"> ', $post->head->name, '</a>';

					echo '
				</div>
			</article>
		';
	}