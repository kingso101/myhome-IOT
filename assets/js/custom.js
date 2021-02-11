function showNotification() {
	if (!Notification) {
		console.log('Desktop notifications not available in your browser..');
		return;
	}


	if (Notification.permission !== "granted"){
		Notification.requestPermission();
	}else {
		var notification = new Notification('ALERT! YOU HAVE AN INTRUDER', { 
			body: 'You have someone at the front door.',
			icon: '<?= $home_url; ?>/assets/images/logo.jpg' 
		});
		notification.onshow = function() { setTimeout(notification.close, 5000) }

	};

}

