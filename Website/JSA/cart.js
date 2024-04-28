document.addEventListener('DOMContentLoaded', function() {
    let iconCart = document.querySelector('.cartIcon');
    let aside = document.querySelector('aside');
    let closecart = document.querySelector('.close');

    // Retrieve cart state from session storage
    let cartState = sessionStorage.getItem('cartState');
    if (cartState === 'open') {
        aside.classList.add('showCart');
    }

    iconCart.addEventListener('click', () => {
        aside.classList.toggle('showCart');
        // Update cart state in session storage
        cartState = aside.classList.contains('showCart') ? 'open' : 'closed';
        sessionStorage.setItem('cartState', cartState);
    });

    closecart.addEventListener('click', () => {
        aside.classList.toggle('showCart');
        // Update cart state in session storage
        cartState = aside.classList.contains('showCart') ? 'open' : 'closed';
        sessionStorage.setItem('cartState', cartState);
    });
});
