<form class="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input class="search-input" type="search" name="s" placeholder="<?php esc_attr_e( 'Search ..', 'fugu-framework' ); ?>">
	<button class="search-submit" type="submit" role="button"><i class="fugu-font fugu-font-search"></i></button>
</form>