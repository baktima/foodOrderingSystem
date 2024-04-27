let iconCart= document.querySelector('.cartIcon');
let aside = document.querySelector('aside');
let closecart = document.querySelector('.close');

iconCart.addEventListener('click',()=>{
	aside.classList.toggle('showCart')
});

closecart.addEventListener('click',()=>{
	aside.classList.toggle('showCart')
});

