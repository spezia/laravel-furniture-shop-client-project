AOS.init();

// default setup
$('.js-response').hide();
$('.js-error-response').hide();

$(".scroll-btn").click(function () {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});

$(".plus").click(function (e) {
  e.preventDefault();
  let $this = $(this);
  let totalPrice = $('.js-total-price').html();
  let $input = $this.siblings("input");
  let value = parseInt($input.val());
  let piecePrice = parseInt($this
    .parent()
    .parent()
    .parent()
    .siblings()
    .children()
    .children()
    .children(".price-by-piect")
    .val());;

  if (value < 999) {
    value = value + 1;
    calulatePrice($this, piecePrice, value);
    let total = parseInt(totalPrice) + piecePrice;
    $('.js-total-price').html(total);
    $('.js-total').attr('value', total);
  } else {
    value = 999;
  }

  $input.val(value);
});

$(".minus").click(function (e) {
  e.preventDefault();
  let $this = $(this);
  let $input = $this.siblings("input");
  let value = parseInt($input.val());
  let totalPrice = $('.js-total-price').html();
  let piecePrice = parseInt($this
    .parent()
    .parent()
    .parent()
    .siblings()
    .children()
    .children()
    .children(".price-by-piect")
    .val());

  if (value > 1) {
    value = value - 1;
    calulatePrice($this, piecePrice, value);
    let total = parseInt(totalPrice) - piecePrice;
    $('.js-total-price').html(total);
    $('.js-total').attr('value', total);
  } else {
    value = 1;
  }

  $input.val(value);
});

function calulatePrice($this, piecePrice, quantity) {
  let finalPrice = $this
    .parent()
    .parent()
    .parent()
    .siblings()
    .children()
    .children()
    .children(".final-price");

  $(finalPrice).val(quantity * piecePrice);
};

$(".next-step").click(function () {
  $(".step-1").fadeOut(500);
  setTimeout(function () {
    $(".step-2").fadeIn(500);
  }, 400);
  $("#step1").removeClass("active");
  $("#step2").addClass("active");
});

$(".js-step1").click(function (e) {
  e.preventDefault();

  $(".step-2").fadeOut(500);
  setTimeout(function () {
    $(".step-3").fadeIn(500);
  }, 400);
  $("#step2").removeClass("active");
  $("#step3").addClass("active");
});

$(".js-step2").click(function (e) {
  e.preventDefault();

  let data = $('#js-order').serialize();
  let url = $('#js-order').data('url');

  $.ajax({
    type: "POST",
    url: url,
    async: true,
    data: data,
    dataType: 'json',
    success: function (response) {
      if (response.status == 1) {
        $('#js-shopping-total').html(0); // update number of items in shopping cart
      } else {
        // OVDE TREBA OTVORITI STRANICU SLEDECU !!!
        $(".step-3").fadeOut(500);
        setTimeout(function () {
          $(".step-4").fadeIn(500);
        }, 400);
        $("#step3").removeClass("active");
        $("#step4").addClass("active");

        $('.js-error-response').html(response.msg).show();
      }
    },
    error: function (xhr) {

      $('.js-error-response').html('');
      $.each(xhr.responseJSON.errors, function (key, value) {
        $('.js-error-response').append('<div class="alert alert-danger">' + value + '</div');
      });

      $('.js-error-response').show();
    }
  });
});

// OLD BUTTONS WITH TWO FORMS AND SUBMITS BY TEMPLATE 
// $(".buyer-info").submit(function (e) {
//   e.preventDefault();

//   $(".step-2").fadeOut(500);
//   setTimeout(function () {
//     $(".step-3").fadeIn(500);
//   }, 400);
//   $("#step2").removeClass("active");
//   $("#step3").addClass("active");
// });
// $(".payment-info").submit(function (e) {
//   e.preventDefault();

//   $(".step-3").fadeOut(500);
//   setTimeout(function () {
//     $(".step-4").fadeIn(500);
//   }, 400);
//   $("#step3").removeClass("active");
//   $("#step4").addClass("active");
// });

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

$('input:radio[name="paying-method"]').change(function () {
  if ($(".paypal").is(":checked")) {
    $(".card-info").fadeOut(400);
    setTimeout(function () {
      $(".pp-info").fadeIn(400);
    }, 400);
  }
  if ($(".credit-card").is(":checked")) {
    $(".pp-info").fadeOut(400);
    setTimeout(function () {
      $(".card-info").fadeIn(400);
    }, 400);
  }
});


$(".color-holder").click(function () {
  if (!$(this).hasClass("active")) {
    $(".color-holder").removeClass("active")
    $(this).addClass("active")
  }
})