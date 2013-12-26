<?php foreach($posts as $post): ?>

<article>
	
	<h1><?=$post['post_title']?></h1>
	<p><?=$post['content']?></p>

	<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
		<?=Time::display($post['created'])?>
	</time>

</article>

<?php endforeach; ?>