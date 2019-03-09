
function login(){
  emailField = document.getElementById("email");
  submitButton = document.getElementById("submit");
  signupButton = document.getElementById("signup");
  console.log(emailField);
  emailField.style.top = "0px";
  emailField.style.zIndex = "1";
  submitButton.style.top = "0px";
  signupButton.style.top = "0px";
  signupButton.style.transform = "rotateX(90deg)";
}

function shownav(){
  nav = document.getElementById("mainnav");
  nav.style.right = "0px";
}

function hidenav(){
  nav = document.getElementById("mainnav");
  nav.style.right = "-350px"
}
