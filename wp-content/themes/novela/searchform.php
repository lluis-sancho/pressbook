<form action="<?php echo home_url(); ?>" method="get" role="search">
	<fieldset>
		<div class="searchform-wrapper">
			<!-- <i class="fa fa-search"></i> -->
			<input type="text" class="searchinput" name="s"  placeholder="<?php _e("Search Here", 'novela'); ?>">
            <button type="submit" class="button"><i class="fa fa-search"></i>
                <span class="search-button-text"><?php _e('Search', 'novela'); ?></span>
            </button>
		</div>
	</fieldset>
</form>