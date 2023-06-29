function sortProducts() {
  let orderSelect = document.getElementById("order");
  let productsContainer = document.getElementById("product-section");
  let products = Array.from(
    productsContainer.getElementsByClassName("product")
  );

  let selectedOption = orderSelect.value;

  switch (selectedOption) {
    case "price-ascendent":
      products.sort((a, b) => {
        let priceA = parseFloat(a.getAttribute("data-price"));
        let priceB = parseFloat(b.getAttribute("data-price"));
        return priceA - priceB;
      });
      break;
    case "price-descendent":
      products.sort((a, b) => {
        let priceA = parseFloat(a.getAttribute("data-price"));
        let priceB = parseFloat(b.getAttribute("data-price"));
        return priceB - priceA;
      });
      break;
    default:
      return;
  }

  products.forEach((product) => {
    productsContainer.appendChild(product.closest("article"));
  });
}

function filterProducts() {
  let allCheckbox = document.getElementById("all");
  let racketCheckbox = document.getElementById("racket");
  let shoesMenCheckbox = document.getElementById("shoes-men");
  let shoesWomenCheckbox = document.getElementById("shoes-women");
  let clothesCheckbox = document.getElementById("clothes");
  let products = document.getElementsByClassName("all-article");

  for (let i = 0; i < products.length; i++) {
    let product = products[i];
    let category = product.getAttribute("data-category");
    if (allCheckbox.checked) {
      for (let i = 0; i < products.length; i++) {
        let product = products[i];
        product.style.display = "block";
      }
    }
    if (
      (racketCheckbox.checked && category === "raquette") ||
      (shoesMenCheckbox.checked && category === "chaussures-hommes") ||
      (shoesWomenCheckbox.checked && category === "chaussures-femmes") ||
      (clothesCheckbox.checked && category === "vetement")
    ) {
      product.style.display = "block";
    } else {
      product.style.display = "none";
    }
  }
}
