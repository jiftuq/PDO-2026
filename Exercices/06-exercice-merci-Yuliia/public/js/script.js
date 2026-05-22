const btn = document.getElementById('btn_nav');
const menu = document.querySelector('.nav_mobile_list');

btn.addEventListener('click', () => {
    btn.classList.toggle('open');
    menu.classList.toggle('open');
});