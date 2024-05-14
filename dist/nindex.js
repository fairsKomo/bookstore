const burger = document.querySelector('#burger');
const menu = document.querySelector('#menue');

const cartContainer = document.getElementById('cartContainer');
const cartButton = document.getElementById('cart');
const closeCart = document.getElementById('close');

const toggle = () =>{
    cartContainer.classList.toggle('hidden')
}

cartButton.addEventListener('click', toggle);
closeCart.addEventListener('click', toggle);

burger.addEventListener('click', () =>{
    if(menu.classList.contains('hidden')){
        menu.classList.remove('hidden');
    } else{
        menu.classList.add('hidden')
    }
})

document.addEventListener('DOMContentLoaded', function() {
    let cart = [];
    let total = 0;
    const checkoutButton = document.getElementById('checkout');
    const listProduct = document.getElementById('listProduct');
    const cartContainer = document.getElementById('listCarte');
    loadCart();


    listProduct.addEventListener('click', function(event) {
        let addToCartButton = event.target.closest('.addToCart');
        if (addToCartButton) {
            const bookId = addToCartButton.dataset.id;
            const title = addToCartButton.dataset.title;
            const price = addToCartButton.dataset.price;
            const path = addToCartButton.dataset.path;
            addToCart(title, price, bookId, path);
        }
    });

    const addCartToHTML = () => {
        console.log(cart);
        cartContainer.innerHTML = ''; // Clear existing cart items
        total = 0;

        cart.forEach(item => {
            let newCart = document.createElement('div');
            newCart.classList.add('cartItem');
            newCart.innerHTML = `
                <img src="../${item.image_path}" alt="Product Image" class="w-20 h-20 object-cover mr-4">
                <div>
                    <h2 class="text-lg font-semibold mb-2">${item.title}</h2>
                    <p class="text-gray-600">$${parseInt(item.price) * parseInt(item.quantity)}</p>
                </div>
                <div class="flex items-center">
                    <span class="add cursor-pointer" data-id="${parseInt(item.book_id)}">&lt;</span>
                    <span class="mx-2">${item.quantity}</span>
                    <span class="minus cursor-pointer" data-id="${parseInt(item.book_id)}">&gt;</span>
                </div>
            `;
            cartContainer.appendChild(newCart);
    
            // Add the cost of this item (price * quantity) to the total
            total += parseFloat(item.price) * parseInt(item.quantity);
        });
    
        // Append a new div at the bottom of cartContainer to display the total price
        let totalDiv = document.createElement('div');
        totalDiv.classList.add('total');
        totalDiv.innerHTML = `<h3 class="text-xl m-2">Total: $${total.toFixed(2)}</h3>`; // .toFixed(2) ensures the number is formatted as a proper currency value
        cartContainer.appendChild(totalDiv);
    };

    checkoutButton.addEventListener('click', function(event) {
        checkOut();
    });

    const addToCart = (tit, pri, id, pa) => {
        let posOfItem = cart.findIndex(value => value.book_id == id);
        if (cart.length <= 0 || posOfItem < 0) {
            cart.push({
                book_id: id,
                price: pri,
                title: tit,
                image_path: pa,
                quantity: 1
            });
            
        } else {
            cart[posOfItem].quantity++;
        }
        addCartToHTML();
        updateCartDatabase(id, cart[posOfItem].quantity);
    };

    function updateCartDatabase(productId, quantity) {
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}&quantity=${quantity}`
        })
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error('Error updating cart:', error));
    }

    function loadCart(){
        fetch('fetch_cart.php')
        .then(response => response.json())
        .then(data => {
            cart = data;
            addCartToHTML();
        })
        .catch(error => console.error('Error loading cart:', error));
    }



    cartContainer.addEventListener('click', (event) => {
        let positionOfClick = event.target;
        if (positionOfClick.classList.contains('minus') || positionOfClick.classList.contains('add')) {
            let prod_id = positionOfClick.dataset.id;
            let type = positionOfClick.classList.contains('add') ? 'minus' : 'add';
            changeQuantity(prod_id, type);
        }
    });

    const changeQuantity = (prod_id, type) => {
        let posItem = cart.findIndex(value => value.book_id == prod_id);
        if (posItem >= 0) {
            if (type === 'add') {
                cart[posItem].quantity += 1;
                addCartToHTML();
                updateCartDatabase(prod_id, cart[posItem].quantity);
            } else {
                cart[posItem].quantity -= 1;
                if (cart[posItem].quantity <= 0) {
                    // Call a different function to handle removal from the database
                    removeItemFromDatabase(prod_id);
                    cart.splice(posItem, 1);  // Remove the item from the cart array
                } else {
                    addCartToHTML();
                    updateCartDatabase(prod_id, cart[posItem].quantity);
                }
            }
        }
    };

    function removeItemFromDatabase(productId) {
        fetch('remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Log the server response
            addCartToHTML(); // Update the HTML to reflect the item removal
        })
        .catch(error => console.error('Error removing item from cart:', error));
    }

    function checkOut(){
        fetch('checkout.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                items: cart,
                total: total.toFixed(2)
            })
        })
        .then(response => response.json())
        .then(data =>{
            console.log(data.message);  // server response message
            if (data.success) {
                alert('Checkout successful!');
                cart = [];  // Clear the cart
                addCartToHTML();  // Refresh the cart display
            } else {
                alert('Checkout failed. Please try again.');
            }
        })
        .catch(error => console.error('Error during checkout:', error));
    }
});
