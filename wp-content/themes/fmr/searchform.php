<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<div>
		<label for="s">RECHERCHER</label><br />
		<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="ok" />
	</div>
</form>