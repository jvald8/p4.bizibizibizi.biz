$('input').click(function() {
	$(this).css('border', 'none');
	$(this).attr('value', '');
});
/*$('input[id=recipe_name]').click(function() {
	$(this).attr('value', '');
});*/
$('input[id=add_button]').click(function() {
	$(this).css('color', 'red');
});