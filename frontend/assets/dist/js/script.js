AOS.init();

$(".scroll-btn").click(function () {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});

$(".plus").click(function (e) {
  e.preventDefault();
  var $this = $(this);
  var $input = $this.siblings("input");
  var value = parseInt($input.val());

  if (value < 999) {
    value = value + 1;
  } else {
    value = 999;
  }

  $input.val(value);
});

$(".minus").click(function (e) {
  e.preventDefault();
  var $this = $(this);
  var $input = $this.siblings("input");
  var value = parseInt($input.val());

  if (value > 1) {
    value = value - 1;
  } else {
    value = 1;
  }

  $input.val(value);
});

$(".plus, .minus").click(function () {
  var $this = $(this);
  var input = $this.siblings("input");
  var finalPrice = $(this)
    .parent()
    .parent()
    .parent()
    .siblings()
    .children()
    .children()
    .children(".final-price");
  var piecePrice = $(this)
    .parent()
    .parent()
    .parent()
    .siblings()
    .children()
    .children()
    .children(".price-by-piect");

  $(finalPrice).val($(input).val() * $(piecePrice).val());
});

$(".next-step").click(function () {
  $(".step-1").fadeOut(500);
  setTimeout(function () {
    $(".step-2").fadeIn(500);
  }, 400);
  $("#step1").removeClass("active");
  $("#step2").addClass("active");
});

$(".buyer-info").submit(function (e) {
  e.preventDefault();

  $(".step-2").fadeOut(500);
  setTimeout(function () {
    $(".step-3").fadeIn(500);
  }, 400);
  $("#step2").removeClass("active");
  $("#step3").addClass("active");
});
$(".payment-info").submit(function (e) {
  e.preventDefault();

  $(".step-3").fadeOut(500);
  setTimeout(function () {
    $(".step-4").fadeIn(500);
  }, 400);
  $("#step3").removeClass("active");
  $("#step4").addClass("active");
});

$(".language").click(function () {
  if ($(".language-list").css("display") == "none") {
    $(".language-list").slideDown(300);
  } else {
    $(".language-list").slideUp(300);
  }
});

$(".language-option").click(function () {
  var newLanguage = $(this).text();

  $(".active-language").val(newLanguage);
  $(".language-list").slideUp(300);
});

$(".prev-step").click(function () {

  if ($(".step-2").css("display") == "block") {
    $(".step-2").fadeOut(500);
    setTimeout(function () {
      $(".step-1").fadeIn(500);
    }, 400);
    $("#step2").removeClass("active");
    $("#step1").addClass("active");
  }

  if ($(".step-3").css("display") == "block") {
    $(".step-3").fadeOut(500);
    setTimeout(function () {
      $(".step-2").fadeIn(500);
    }, 400);
    $("#step3").removeClass("active");
    $("#step2").addClass("active");
  }

});


$('input:radio[name="paying-method"]').change(function() {
  if($('.paypal').is(':checked')) { 
    $(".card-info").fadeOut(400);
    setTimeout(function () {
      $(".pp-info").fadeIn(400);
    }, 400);
   }
  if($('.credit-card').is(':checked')) { 
    $(".pp-info").fadeOut(400);
    setTimeout(function () {
      $(".card-info").fadeIn(400);
    }, 400);
   }
  
});