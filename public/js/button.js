const buttons = document.querySelectorAll(".addtocart");

buttons.forEach((button) => {
  const done = button.querySelector(".done");
  const pretext = button.querySelector(".pretext");

  button.addEventListener("click", () => {
    done.style.transform = "translate(0px)";
    pretext.style.opacity = "0";

    setTimeout(() => {
      done.style.transform = "translate(-110%)";
      pretext.style.opacity = "1";
    }, 2000);
  });
});
