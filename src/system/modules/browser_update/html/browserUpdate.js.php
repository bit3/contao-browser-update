window.addEvent('domready', function() {
	$('browserUpdateClose').addEvent('click', $lambda(false));
	$('browserUpdateClose').addEvent('click', function() {
		$('browserUpdate').addClass('invisible');
<?php if($_GET['test'] == 'deaktiviert'): ?>		Cookie.write('browserUpdate', 'false', { duration: <?php echo $_GET['duration']; ?> });
<?php endif; ?>	});
});