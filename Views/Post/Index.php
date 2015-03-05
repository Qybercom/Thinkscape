<article>
	<?php echo $post->content; ?>
	<div class="summary">
		<a class="quark-button fa fa-comments" href="/post/comment/list/<?php echo $post->_id; ?>"> <?php echo sizeof($post->comments); ?></a>
		<a class="quark-button fa fa-user" href="/user/<?php echo $post->author->nickname; ?>" title="<?php echo $post->author->name; ?>"> <?php echo $post->author->nickname; ?></a>
		<a class="quark-button fa fa-calendar-o" href="/post/list/?date=<?php echo $post->date; ?>"> <?php echo date('M, d Y H:i', strtotime($post->date)); ?></a>
		<?php
		if ($post->head != null)
			echo '<a class="quark-button" style="float: right;" href="/head/', $post->head->name, '"> ', $post->head->name, '</a>';
		?>
	</div>
	<br>
	<br>
	<div class="comments">
		<?php
		$commentOK = $post->Rights($this->User(), array(\Models\Post::RIGHT_COMMENT));

		if (sizeof($post->comments) == 0)
			echo '
				<h4>Hey, here are no comments</h4>
				', ($commentOK ? '<br>Let\'s add one to this post.' : ''), '
			';
		else foreach ($post->comments as $comment)
			echo '
				<div class="quark-thinkscape-comment">
					<a class="quark-button avatar" href="/user/', $comment->author->nickname, '" title="', $comment->author->nickname, '">
						<img src="', $comment->author->avatar, '" alt="avatar" />
					</a>
					<div class="content">
						<a class="quark-button" href="/user/', $comment->author->nickname, '" title="', $comment->author->nickname, '">
							', $comment->author->nickname, '
						</a> at ', date('M, d Y H:i', strtotime($comment->date)), '<br>
						', $comment->content, '
					</div>
				</div>
			';

		if ($commentOK)
			echo '
				<br>
				<br>
				<form action="/post/comment/create/', $post->_id, '" method="POST">
					<textarea name="content" class="quark-input comment" placeholder="Some thinks..."></textarea>
					<br>
					', $this->Signature(), '
					<button type="submit" class="quark-button block">Comment</button>
				</form>
			';
		?>
	</div>
</article>