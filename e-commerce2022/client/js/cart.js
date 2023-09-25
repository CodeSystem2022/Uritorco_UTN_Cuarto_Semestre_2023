const modalContainer = document.getElementById("modal-container");
const modalOverlay = document.getElementById("modal-overlay");

const displayCart = () => {
    modalContainer.style.display = "block";
    modalOverlay.style.display="block";
    //modal Header
    modalContainer.innerHTML = "";
    const modalHeader = document.createElement("div");

    const modalClose = document.createElement("div");
    modalClose.innerText = "❌";
    modalClose.className = "modal-close";
    modalHeader.append(modalClose);

    modalClose.addEventListener("click", ()=> {
        modalContainer.style.display = "none";
        modalOverlay.style.display = "none";
    });

    const modalTitle = document.createElement("div");
    modalTitle.innerText = "Cart";
    modalTitle.className = "modal-title";
    modalHeader.append(modalTitle);

    
    
    
    
    modalContainer.append(modalHeader);

    //modal Body
    cart.forEatch((product)=> {
        const modalBody = document.createElement("div");
        modalBody.className = "modal-body";
        modalBody.innerHTML = `
        <div class="product">
            <img class="product-img" src="${product.img}" />
            <div class="product-info">
                <h4>${product.productName}</h4>
            </div>
        <div class="quantity">
            <span class="quantity-btn-decrese">-</span>
            <span class="quantity-input">${product.quantity}</span>
            <span class="quantity-btn-increse">+</span>
        </div>
            <div class="price">${product.price * product.quanty} $</div>
            <div class="delete-product">❌</div>
        </div>
        `;
        modalContainer.append(modalBody);
    });
};

cartBtn.addEventListener("click", displayCart);
































