<form action="<?php echo home_url(); ?>/" method="get" id="searchform">
    <fieldset>
        <input class="input" name="s" type="text" id="keywords" value="<?php _e('to search, type and hit enter','cosmotheme') ?>" onfocus="if (this.value == '<?php _e('to search, type and hit enter','cosmotheme') ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('to search, type and hit enter','cosmotheme') ?>';}">
        <input type="submit" name="search" class="button" value="<?php _e('Search','cosmotheme') ?>">
	</fieldset>
</form>