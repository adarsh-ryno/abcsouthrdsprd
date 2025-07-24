<?php
/**
 * Search form for Type A Nav
 *
 * @package understrap
 */

// Exit if accessed directly.
//got the update
defined("ABSPATH") || exit(); ?>

<form name="nav-search-form" class="mt-4 px-4">
		<div class="input-group">
			<input class="form-control" placeholder="How Can We Help You?" id="s" name="s" type="text" value="<?php the_search_query(); ?>">
			<div class="input-group-append">
				<button class="btn">
					<i class="fas fa-search"></i> 
				</button>
			</div>
		</div>
</form>