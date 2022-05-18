const goToStepTwo = document.querySelectorAll(".goToStepTwo");
const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");

let formStepsNum = 0;

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum++;
    updateFormSteps();
    updateProgressbar();
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum--;
    updateFormSteps();
    updateProgressbar();
  });
});

goToStepTwo.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum = 2;
    // console.log("towa e " + formStepsNum)
    updateFormSteps();
    updateProgressbar();
    var scrollDiv = document.getElementById("selectClosetType").offsetTop;
    window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
  });
});

function updateFormSteps() {
  formSteps.forEach((formStep) => {
    formStep.classList.contains("form-step-active") &&
      formStep.classList.remove("form-step-active");
  });

  formSteps[formStepsNum].classList.add("form-step-active");
}

function updateProgressbar() {
  progressSteps.forEach((progressStep, idx) => {
    if (idx < formStepsNum + 1) {
      progressStep.classList.add("progress-step-active");
    } else {
      progressStep.classList.remove("progress-step-active");
    }
  });

  const progressActive = document.querySelectorAll(".progress-step-active");

  progress.style.width =
    ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}

// email validation

var emailInput;

$("#email").on("change", function() {
  emailInput = $(this).val();

  if (validateEmail(emailInput)) {
    $(this).css({
      color: "green",
      border: "1px solid green"
    });
  } else {
    $(this).css({
      color: "red",
      border: "1px solid red"
    });

    // alert("not a valid email address");
  }
});

$("#subscribe-button").on("click", function(e) {
  e.preventDefault();
  if (validateEmail(emailInput)) {
    // alert("you did it!");
  } else {
    // alert('Please enter a valid email address.');
    return false;
  }
});

function validateEmail(email) {
  var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

  return $.trim(email).match(pattern) ? true : false;
}

// show message on step seven
$("#dimensions_for_another").click(function(){
  $(".success-msg").fadeIn();
});

// border style - checked checkbox
$(".d-inline-block .img-center img").click(function(){
  $(this).parents(".d-inline-block").toggleClass("border");
});



