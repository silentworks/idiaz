var mainMenu = document.querySelector('.pure-menu');
var menuLink = document.querySelector('.menu-link');

menuLink.addEventListener('click', function (event) {
	if (this.classList.contains('active')) {
		this.classList.remove('active');
		mainMenu.classList.remove('active');
	} else {
		this.classList.add('active');
		mainMenu.classList.add('active');
	}
	event.preventDefault();
});
