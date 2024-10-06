// Sample product data
const products = [
    { id: 1, name: "Black Spectacles", price: 99, image: "https://picsum.photos/800/400?random=1" },
    { id: 2, name: "Yellow Spectacles", price: 89, image: "https://picsum.photos/800/400?random=2" },
    { id: 3, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=3" },
    { id: 4, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=30" },
    { id: 5, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=4" },
    { id: 6, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=5" },
    { id: 7, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=6" },
    { id: 8, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=7" },
    { id: 9, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=8" },
    { id: 10, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=9" },
    { id: 11, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=10" },
    { id: 12, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=11" },
    { id: 13, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=12" },
    { id: 14, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=13" },
    { id: 15, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=14" },
    { id: 16, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=15" },
    { id: 17, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=16" },
    { id: 18, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=17" },
    { id: 19, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=18" },
    { id: 20, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=19" },
    { id: 21, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=20" },
    { id: 22, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=21" },
    { id: 23, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=22" },
    { id: 24, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=23" },
    { id: 25, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=24" },
    { id: 26, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=25" },
    { id: 27, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=26" },
    { id: 28, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=27" },
    { id: 29, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=28" },
    { id: 30, name: "Blue Spectacles", price: 120, image: "https://picsum.photos/800/400?random=29" },
    // Add up to 30 products here with different prices
];

// Pagination variables
let currentPage = 1;
const productsPerPage = 6;

// Display products on the current page
function displayProducts() {
    const productList = document.getElementById("product-list");
    productList.innerHTML = ""; // Clear previous products

    const start = (currentPage - 1) * productsPerPage;
    const end = start + productsPerPage;

    const currentProducts = products.slice(start, end);

    currentProducts.forEach(product => {
        const productItem = document.createElement("div");
        productItem.className = "product-item";
        productItem.innerHTML = `
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>Price: $${product.price}</p>
        `;
        productItem.onclick = () => openProductDetails(product.id);
        productList.appendChild(productItem);
    });

    // Update page number display
    document.getElementById("page-number").textContent = currentPage;
}

// Open product details page
function openProductDetails(productId) {
    window.location.href = `product-details.html?id=${productId}`;
}

// Search function
function searchProducts() {
    const searchInput = document.getElementById("search-input").value.toLowerCase();
    const filteredProducts = products.filter(product => product.name.toLowerCase().includes(searchInput));

    const productList = document.getElementById("product-list");
    productList.innerHTML = ""; // Clear previous products

    filteredProducts.forEach(product => {
        const productItem = document.createElement("div");
        productItem.className = "product-item";
        productItem.innerHTML = `
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>Price: $${product.price}</p>
        `;
        productItem.onclick = () => openProductDetails(product.id);
        productList.appendChild(productItem);
    });
}

// Filter by price range
function filterProducts() {
    const priceRange = document.getElementById("price-range").value;

    let filteredProducts = products;

    if (priceRange === "low") {
        filteredProducts = products.filter(product => product.price < 50);
    } else if (priceRange === "mid") {
        filteredProducts = products.filter(product => product.price >= 50 && product.price <= 100);
    } else if (priceRange === "high") {
        filteredProducts = products.filter(product => product.price > 100);
    }

    const productList = document.getElementById("product-list");
    productList.innerHTML = ""; // Clear previous products

    filteredProducts.forEach(product => {
        const productItem = document.createElement("div");
        productItem.className = "product-item";
        productItem.innerHTML = `
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>Price: $${product.price}</p>
        `;
        productItem.onclick = () => openProductDetails(product.id);
        productList.appendChild(productItem);
    });
}

// Pagination functions
function nextPage() {
    if (currentPage * productsPerPage < products.length) {
        currentPage++;
        displayProducts();
    }
}

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        displayProducts();
    }
}

// Initial display
displayProducts();