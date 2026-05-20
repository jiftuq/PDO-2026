document.addEventListener('DOMContentLoaded', function(){
	const btn = document.querySelector('.menu-toggle');
	const nav = document.querySelector('.main-nav');
	if(btn && nav){
		btn.addEventListener('click', function(){
			const open = nav.classList.toggle('open');
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
		// close menu when clicking a link (mobile)
		nav.querySelectorAll('a').forEach(a=>a.addEventListener('click', ()=>{
			nav.classList.remove('open');
			btn.setAttribute('aria-expanded','false');
		}));
	}
});
