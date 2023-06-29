let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
let email = document.getElementById("mail");
let pseudo = document.getElementById("pseudo");
let password = document.getElementById("password");
let lastName = document.getElementById("lastName");
let firstName = document.getElementById("firstName");
let subject = document.getElementById("sujet");
let message = document.getElementById("message");

function formValidateRegister() {
  if (email.value == "") {
    alert("Veuillez entrer votre email.");
    email.focus();
    return false;
  }
  if (!email.value.match(emailRegex)) {
    alert("Veuillez entrer une adresse email valide");
    return false;
  }
  if (pseudo.value == "") {
    alert("Veuillez entrer un pseudo.");
    pseudo.focus();
    return false;
  }
  if (password.value == "") {
    alert("Veuillez entrer un mot de passe.");
    password.focus();
    return false;
  }
}
function formValidatorLogin() {
  if (email.value == "") {
    alert("Veuillez entrer votre email.");
    email.focus();
    return false;
  }
  if (!email.value.match(emailRegex)) {
    alert("Veuillez entrer une adresse email valide");
    return false;
  }

  if (password.value == "") {
    alert("Veuillez entrer un mot de passe.");
    password.focus();
    return false;
  }
}
function formValidatorContact() {
  if (email.value == "") {
    alert("Veuillez entrer votre email.");
    email.focus();
    return false;
  }
  if (!email.value.match(emailRegex)) {
    alert("Veuillez entrer une adresse email valide");
    return false;
  }
  if (lastName.value == "") {
    alert("Veuillez entrer votre nom.");
    lastName.focus();
    return false;
  }
  if (firstName.value == "") {
    alert("Veuillez entrer votre prénom.");
    firstName.focus();
    return false;
  }
  if (subject.value == "") {
    alert("Veuillez entrer l'objet de votre message");
    subject.focus();
    return false;
  }
  if (messsage.value == "") {
    alert("Veuillez écrire un message");
    message.focus();
    return false;
  }
}
