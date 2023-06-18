let checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach(function (checkbox) {
  checkbox.addEventListener("change", filterProductsCheckbox);
});

function filterProductsCheckbox() {
  let selectedFilters = document.querySelectorAll(
    'input[type="checkbox"]:checked'
  );
  let selectedValues = Array.from(selectedFilters).map(function (checkbox) {
    return checkbox.value;
  });

  let products = document.querySelectorAll(".card-article");
  products.forEach(function (product) {
    if (
      selectedValues.length === 0 ||
      selectedValues.some(function (value) {
        return product.classList.contains(value);
      })
    ) {
      product.style.display = "block";
    } else {
      product.style.display = "none";
    }
  });
}

function uncheckAllExcept(checkbox) {
  let checkboxes = document.getElementsByName("option");
  checkboxes.forEach(function (currentCheckbox) {
    if (currentCheckbox !== checkbox) {
      currentCheckbox.checked = false;
    }
  });
}

function filterProducts(value) {
  let productsContainer = document.querySelector(".all-article");
  let products = Array.from(
    productsContainer.getElementsByClassName("product")
  );

  if (value === "price-ascendent") {
    products.sort(function (a, b) {
      let priceA = parseInt(a.getAttribute("data-price"));
      let priceB = parseInt(b.getAttribute("data-price"));
      return priceA - priceB;
    });
  } else if (value === "price-descendent") {
    products.sort(function (a, b) {
      let priceA = parseInt(a.getAttribute("data-price"));
      let priceB = parseInt(b.getAttribute("data-price"));
      return priceB - priceA;
    });
  }

  products.forEach(function (product) {
    productsContainer.appendChild(product);
  });
}
