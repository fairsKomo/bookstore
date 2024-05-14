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

// let listProductHTML = document.getElementById('listProduct');
// let listProduct = [];

export let cart = [];
const listCartHTML = document.getElementById('listCarte');


// const addDataToHTML = () => {
//     fetch('books.php')
//     .then(response => response.json())
//     .then(books => {
//         listProductHTML.innerHTML = ''; // Clear existing entries
//         if (books.length > 0) {
//             books.forEach(book => {
//                 let newProduct = document.createElement('div');
//                 newProduct.classList.add('card');
//                 newProduct.innerHTML = `
//                     <img src="${book.image_path}" alt="" class="image">
//                     <div class="m-4">
//                         <span class="font-bold">${book.title}</span>
//                         <span class="block text-gray-500 text-sm">By ${book.author}</span>
//                         <div class="flex justify-between">
//                             <span class="text-green-500 font-bold">$${book.price}</span>
//                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 cursor-pointer hover:text-primary addToCart">
//                                 <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
//                             </svg>
//                         </div>
//                     </div>`;
//                 listProductHTML.appendChild(newProduct);
//             });
//         } else {
//             listProductHTML.innerHTML = "<p>No books found.</p>";
//         }
//     })
//     .catch(error => console.error('Error fetching books:', error));
// };

listProductHTML.addEventListener('click', (event) => {
    let postionClick = event.target;
    if (postionClick.classList.contains('addToCart')) {
        let product_id = postionClick.parentElement.parentElement.parentElement.dataset.id;
        addToCart(product_id);
    }
});

const addToCart = (product_id) =>{
    let positionOfItem = cart.findIndex((value) => value.product_id == product_id)
    if(cart.length <= 0){
        cart = [{
            product_id: product_id,
            quantity: 1
        }
        ]
    }else if(positionOfItem < 0){
        cart.push({
            product_id: product_id,
            quantity: 1
        })
    }else{
        cart[positionOfItem].quantity = cart[positionOfItem].quantity + 1
    }
    addCartToHTML();
}

const addCartToHTML = () => {
    listCartHTML.innerHTML = '';
    if(cart.length > 0){
        cart.forEach(cart => {
            let newCart = document.createElement('div');
            newCart.classList.add('cartItem');
            newCart.dataset.id = cart.product_id;
            let position = listProduct.findIndex((value) => value.id == cart.product_id);
            let info = listProduct[position];
            newCart.innerHTML = `
            <!-- Product Image -->
                    <img src="${info.image}" alt="Product Image" class="w-20 h-20 object-cover mr-4">
                    <!-- Product Details -->
                    <div>
                        <h2 class="text-lg font-semibold mb-2">${info.name}</h2>
                        <p class="text-gray-600">$${info.price * cart.quantity}</p>
                    </div>
                    <!-- Quantity -->
                    <div class="flex items-center">
                        <span class="add cursor-pointer"><</span>
                        <span class="mx-2">${cart.quantity}</span>
                        <span class="minus cursor-pointer">></span>
                        </button>
                    </div>
            `
            listCartHTML.appendChild(newCart);
        })
    }
}

listCartHTML.addEventListener('click', (event) => {
    let postionOfClick = event.target;
    if(postionOfClick.classList.contains('minus') || postionOfClick.classList.contains('add')){
        let prod_id = postionOfClick.parentElement.parentElement.dataset.id;
        console.log(prod_id);
        let type = 'minus';
        if(postionOfClick.classList.contains('add')){
            type = 'add';
        }
        changeQuantity(prod_id,type);
    }
})

const changeQuantity = (prod_id, type) => {
    let posItem = cart.findIndex((value) => value.product_id == prod_id);
    if(posItem >= 0){
        switch(type){
            case 'minus':
                cart[posItem].quantity = cart[posItem].quantity + 1;
                break;

            default:
                let val = cart[posItem].quantity - 1;
                if(val > 0){
                    cart[posItem].quantity = cart[posItem].quantity - 1
                }else{
                    cart.splice(posItem, 1);
                    break;
                }
        }
    }
    addCartToHTML();
}

// const initApp = () => {
//     fetch('books.php')
//     .then(response => response.json())
//     .then(data => {
//         listProduct = data;
//         addDataToHTML();
//     })
// }
// initApp();
// addDataToHTML();
