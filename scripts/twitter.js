new TWTR.Widget({
	
	version: 2,
	type: 'profile',
	rpp: 3,
	interval: 6000,
	width: 605,
	height: 149,
	theme: {
		
		shell: {
		
			background: '#84abaa',
			color: '#ffffff'
		
		},
		
		tweets: {
	
			background: '#ffffff',
			color: '#000000',
			links: '#0374ff'
	
		}
	
	},
	
	eatures: {
	
		scrollbar: false,
		loop: false,
		live: false,
		hashtags: true,
		timestamp: true,
		avatars: false,
		behavior: 'all'

	}

}).render().setUser('_interunesp_').start();