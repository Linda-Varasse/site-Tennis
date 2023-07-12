document.addEventListener("DOMContentLoaded", function () {
  var addToCartButtons = document.querySelectorAll(".addCart");

  addToCartButtons.forEach(function (button) {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      var productId = this.getAttribute("data-product-id");

      fetch("/products", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "productId=" + encodeURIComponent(productId),
      })
        .then(function (response) {
          // Réponse de la requête AJAX (optionnel)
          // Vous pouvez mettre à jour le contenu de la page ici si nécessaire
        })
        .catch(function (error) {
          console.error("Erreur lors de la requête AJAX :", error);
        });
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  let addToCartBtn = document.getElementByClass("add-to-cart-btn");
  addToCartBtn.addEventListener("click", function () {
    let quantity = document.getElementById("quantity").value; // Récupère la quantité choisie
    let size = document.getElementById("size").value; // Récupère la taille choisie
    let categorie = document.getElementById("size").dataset.categorie; // Récupère la catégorie du produit

    // Envoie les données au serveur via une requête Fetch
    fetch("/productsDescription", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "quantity=" +
        encodeURIComponent(quantity) +
        "&size=" +
        encodeURIComponent(size) +
        "&categorie=" +
        encodeURIComponent(categorie),
    })
      .then(function (response) {
        if (response.ok) {
          // Réponse du serveur après ajout au panier (facultatif)
          console.log(response);
        } else {
          // Gérer les erreurs
        }
      })
      .catch(function (error) {
        // Gérer les erreurs
      });
  });
});
