const goToStepTwo = document.querySelectorAll(".goToStepTwo");
const goToStepSeven = document.querySelectorAll(".goToStepSeven");
const goToStep_three = document.querySelectorAll(".goToStep_three");
const goToStep_four = document.querySelectorAll(".goToStep_four");
const goToStep_five = document.querySelectorAll(".goToStep_five");
const goToStep_six = document.querySelectorAll(".goToStep_six");
const goToStep_seven = document.querySelectorAll(".goToStep_seven");
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

goToStepSeven.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum = 6;
    // console.log("towa e " + formStepsNum)
    updateFormSteps();
    updateProgressbar();
    var scrollDiv = document.getElementById("selectClosetType").offsetTop;
    window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
  });
});

goToStep_three.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum = 2;
    // console.log("towa e " + formStepsNum)
    updateFormSteps();
    updateProgressbar();
    var scrollDiv = document.getElementById("selectClosetType").offsetTop;
    window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
  });
});

goToStep_four.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum = 3;
    // console.log("towa e " + formStepsNum)
    updateFormSteps();
    updateProgressbar();
    var scrollDiv = document.getElementById("selectClosetType").offsetTop;
    window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
  });
});

goToStep_five.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum = 4;
    // console.log("towa e " + formStepsNum)
    updateFormSteps();
    updateProgressbar();
    var scrollDiv = document.getElementById("selectClosetType").offsetTop;
    window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
  });
});

goToStep_six.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum = 5;
    // console.log("towa e " + formStepsNum)
    updateFormSteps();
    updateProgressbar();
    var scrollDiv = document.getElementById("selectClosetType").offsetTop;
    window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
  });
});

goToStep_seven.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum = 6;
    // console.log("towa e " + formStepsNum)
    updateFormSteps();
    updateProgressbar();
    var scrollDiv = document.getElementById("selectClosetType").offsetTop;
    window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
  });
});

  $('input.Walk-in-Closet , input.Reach-in-Closet , input.Kids-Closet , input.Hall , .kitchen-pantry , input.Wine-Rack').click(function(){
      // first 4
      if(
        $('input.Walk-in-Closet').prop("checked") == true ||
        $('input.Reach-in-Closet').prop("checked") == true || 
        $('input.Kids-Closet').prop("checked") == true || 
        $('input.Hall').prop("checked") == true ){

          $(".d-btn-step-p-three").fadeOut();
          $(".d-btn-step-p-four").fadeOut();          
          $(".goToStep_four").fadeIn();
          $(".goToStep_seven").fadeIn();
          $(".for-first-four").fadeIn();               
          $(".for-first-four-all").fadeOut(); 
      }
      else {
        $(".goToStep_four").fadeOut();
        $(".goToStep_seven").fadeOut();
      }
      if(
        $('input.Walk-in-Closet').prop("checked") == true &&
        $('input.Reach-in-Closet').prop("checked") == true && 
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true ){

          $(".for-first-four-all").fadeIn();               
          
      }

      // kitchen
      if ($('input.kitchen-pantry').prop("checked") == true) {        
        $(".goToStep_five").fadeIn();
        $(".goToStep_seven").fadeIn();
        $(".d-btn-step-for-kitchen").fadeOut();  
      } else {
        $(".goToStep_five").fadeOut();
        // $(".goToStep_seven").fadeOut();
      }

      // Wine-Rack
      if ($('input.Wine-Rack').prop("checked") == true) {        
        $(".goToStep_six").fadeIn();
        $(".d-btn-step-for-wine").fadeOut();          
      } else {
        $(".goToStep_six").fadeOut();
      }

      // Hall
      if ($('input.Hall').prop("checked") == true) {        
        $(".for-first-four").fadeOut();
      } 


      // multi

      if(
        $('input.Walk-in-Closet').prop("checked") == true ||
        $('input.Reach-in-Closet').prop("checked") == true || 
        $('input.Kids-Closet').prop("checked") == true || 
        $('input.Hall').prop("checked") == true && 
        $('input.kitchen-pantry').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen").fadeOut();   
          $(".for-first-four-all").fadeOut();   
      }
      if(
        $('input.Walk-in-Closet').prop("checked") == true && 
        $('input.kitchen-pantry').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen").fadeOut();   
          $(".for-first-four").fadeOut();   
      }
      if(
        $('input.Reach-in-Closet').prop("checked") == true && 
        $('input.kitchen-pantry').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen").fadeOut();   
          $(".for-first-four").fadeOut();   
      }
      if(
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.kitchen-pantry').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen").fadeOut();   
          $(".for-first-four").fadeOut();   
      }
      if(
        $('input.Walk-in-Closet').prop("checked") == true && 
        $('input.Wine-Rack').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen").fadeOut();   
          $(".d-btn-step-for-walk-wine-rack").fadeOut();   
      }
      if(
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Wine-Rack').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen").fadeOut();   
          $(".for-first-four").fadeOut();   
      }
      if(
        $('input.Hall').prop("checked") == true && 
        $('input.Wine-Rack').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen").fadeOut();   
      }

      if(
        $('input.Walk-in-Closet').prop("checked") == true &&
        $('input.Reach-in-Closet').prop("checked") == true && 
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true && 
        $('input.Wine-Rack').prop("checked") == true && 
        $('input.kitchen-pantry').prop("checked") == true
        ){
          $(".for-all-selected").fadeOut();   
      }      

      if(
        $('input.Walk-in-Closet').prop("checked") == true ||
        $('input.Reach-in-Closet').prop("checked") == true || 
        $('input.Kids-Closet').prop("checked") == true || 
        $('input.Hall').prop("checked") == true && 
        $('input.Wine-Rack').prop("checked") == true
        ){
          $(".d-btn-step-for-four-wine-rack").fadeOut();   
      }

      if(
        $('input.Walk-in-Closet').prop("checked") == true &&
        $('input.Reach-in-Closet').prop("checked") == true && 
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true         
        ){
          $(".d-btn-step-for-walk-wine-rack").fadeIn();   
      }
      //kitchen + wine rack
      if(        
        $('input.kitchen-pantry').prop("checked") == true && 
        $('input.Wine-Rack').prop("checked") == true
        ){
          $(".d-btn-step-for-four-wine-rack").fadeOut();   
          $(".d-btn-step-for-kitchen-wine-rack").fadeOut();   
          $(".hide-kitchen-wine-rack").fadeOut();             
          $(".kitchen-wine-rack").fadeIn();
      }

      if(
        $('input.Walk-in-Closet').prop("checked") == true &&
        $('input.Reach-in-Closet').prop("checked") == true && 
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true && 
        $('input.kitchen-pantry').prop("checked") == true
        ){
          $(".four-kitchen").fadeOut();   
      }

      if(
        $('input.Walk-in-Closet').prop("checked") == true &&
        $('input.Reach-in-Closet').prop("checked") == true && 
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true && 
        $('input.Wine-Rack').prop("checked") == true
        ){
          $(".four-kitchen").fadeOut();   
      }
      if(        
        $('input.Reach-in-Closet').prop("checked") == true && 
        $('input.Wine-Rack').prop("checked") == true
        ){
          $(".for-first-four").fadeOut();   
      }
      if(
        $('input.Walk-in-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen-two").fadeIn();   
      }
      if(
        $('input.Reach-in-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen-two").fadeIn();   
      }
      if(
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen-two").fadeIn();   
      }
      if(
        $('input.Walk-in-Closet').prop("checked") == true &&
        $('input.Reach-in-Closet').prop("checked") == true && 
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true
        ){
          $(".for-first-four").fadeOut();   
      }
      if(
        $('input.Walk-in-Closet').prop("checked") == true &&
        $('input.Reach-in-Closet').prop("checked") == true && 
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true &&
        $('input.kitchen-pantry').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen").fadeOut();   
      }
      if(
        $('input.Walk-in-Closet').prop("checked") == true &&
        $('input.Reach-in-Closet').prop("checked") == true && 
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true &&
        $('input.Wine-Rack').prop("checked") == true
        ){
          $(".d-btn-step-for-four-kitchen").fadeOut();   
      }
      if(
        $('input.Walk-in-Closet').prop("checked") == true ||
        $('input.Reach-in-Closet').prop("checked") == true || 
        $('input.Kids-Closet').prop("checked") == true || 
        $('input.Hall').prop("checked") == true &&
        $('input.Wine-Rack').prop("checked") == true ||
        $('input.kitchen-pantry').prop("checked") == true 
        ){
          $(".for-all-selected").fadeOut();   
      }
      if(
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true &&
        $('input.Wine-Rack').prop("checked") == true &&
        $('input.kitchen-pantry').prop("checked") == true 
        ){
          $(".d-btn-step-for-four-kitchen ").fadeOut();   
      }
      if(
        $('input.Kids-Closet').prop("checked") == true && 
        $('input.Wine-Rack').prop("checked") == true 
        ){
          $(".for-all-selected").fadeIn();   
      }
      if(
        $('input.Hall').prop("checked") == true && 
        $('input.Wine-Rack').prop("checked") == true 
        ){
          $(".for-all-selected").fadeIn();   
      }
      if(
        $('input.Hall').prop("checked") == true && 
        $('input.Kids-Closet').prop("checked") == true 
        ){
          $(".d-btn-step-for-kitchen.btn.btn-next").fadeOut();   
      }
      if(
        $('input.kitchen-pantry').prop("checked") == true && 
        $('input.Wine-Rack').prop("checked") == true 
        ){
          $(".hide-for-kitchen-wine").fadeOut();   
          $(".previus-btn-three").fadeIn();   
          $(".goTo_six-for-kitchen-wine").fadeIn();   
      }
      if(
        $('input.kitchen-pantry').prop("checked") == true && 
        $('input.Hall').prop("checked") == true &&
        $('input.Kids-Closet').prop("checked") == true 
        ){
          $(".d-btn-step-for-four-kitchen-two").fadeOut();    
      }
      if(
        $('input.kitchen-pantry').prop("checked") == true && 
        $('input.Hall').prop("checked") == true &&
        $('input.Reach-in-Closet').prop("checked") == true 
        ){
          $(".d-btn-step-for-four-kitchen-two").fadeOut();    
          $(".hive-for-kitchen-hall-rich").fadeOut();    
          $(".show-for-hive-for-kitchen-hall-rich").fadeIn();    
      }
      if(
        $('input.Walk-in-Closet').prop("checked") == true && 
        $('input.Hall').prop("checked") == true &&
        $('input.kitchen-pantry').prop("checked") == true 
        ){
          $(".d-btn-step-for-four-kitchen-two").fadeOut();    
          $(".hive-for-kitchen-hall-rich").fadeOut();    
          $(".show-for-hive-for-kitchen-hall-rich").fadeIn();    
      }
      if(
        $('input.Walk-in-Closet').prop("checked") == true ||
        $('input.Reach-in-Closet').prop("checked") == true ||
        $('input.Kids-Closet').prop("checked") == true ||
        $('input.Hall').prop("checked") == true 
        ){
          $(".hide-for-first-four-options").fadeOut();
          $(".show-for-first-four-options").fadeIn(); 
      }
      if(
        $('input.Reach-in-Closet').prop("checked") == true &&
        $('input.Wine-Rack').prop("checked") == true 
        ){
          $(".goToStep_six.for-all-selected").fadeIn(); 
          $(".goToStep_four.show-for-first-four-options").fadeOut();   
          $(".hide-for-rich-and-wine").fadeOut();   
          $(".hide-for-first-four-options.hive-for-kitchen-hall-rich").fadeIn(); 
          $(".goToStep_four.show-for-rich-and-wine").fadeIn(); 
      }
      if(
        $('input.kitchen-pantry').prop("checked") == true){
          $(".hide-for-first-four-options.hive-for-kitchen-hall-rich").fadeOut();   
          $(".hide-for-kitchen-wine").fadeOut();   
          $(".goToStep_three.previus-btn-three").fadeIn()
      }
      if($('input.Wine-Rack').prop("checked") == true){
          $(".hide-for-rich-and-wine.new").fadeOut();   
          $(".goToStep_three.show-for_wine-rack-new").fadeIn();
          $(".show-for-wine-rack-new").fadeIn()
      }

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



