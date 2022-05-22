var result;
var checkbox;
var text;

$(document).ready(function () {
  checkbox = document.getElementById("checkbox");

  text = document.getElementById("captchainput");
  $('#signin').click(function () {
    $("#email").animate({ "opacity": "hide", top: "100" }, 500);
    $("#repeatpassword").animate({ "opacity": "hide", top: "100" }, 500);
  });

  $('#reg').click(function () {
    $("#email").animate({ "opacity": "show", top: "100" }, 500);
    $("#repeatpassword").animate({ "opacity": "show", top: "100" }, 500);
  });

});
var typebutton = false;
function regtap() {
  $("#checkbox").prop("checked", false);
  $("#reg").addClass("active");
  $("#signin").removeClass("active");
  document.getElementById("cbutton").innerHTML = "зарегистрироваться";
  document.getElementById("repeatpassword").style.display = "block";
  document.getElementById("email").style.display = "block";

  typebutton = false;
}
function signintap() {
  $("#checkbox").prop("checked", false);
  $("#reg").removeClass("active");
  $("#signin").addClass('active');


  typebutton = true;
}



$("#form").on("submit", function (e) {
  e.preventDefault();
  if (checkbox.checked) {

    if (!typebutton) {

      $.ajax({
        url: '/php/register.php',
        method: 'post',

        data: $(this).serialize(),
        success: function (data) {
          alert(data);
        }
      });
    }
    if (typebutton) {
      $.ajax({
        url: '/php/auth.php',
        method: 'post',
        timeout: 10000,
        data: $(this).serialize(),
        success: function (data) {
          if (data == false) {
            show_popap_index('dialog-1')
          }

          if (data == true) {
            window.location.replace('/php/home.php');
          }
        }
      });
    }
  } else {
    show_popap_index('dialog-1')
  }


});


function randomNumber(min, max) {
  const r = Math.random() * (max - min) + min
  return Math.floor(r)
}
function sendcaptcha() {

  var val = text.value;
  text.value = "";
  if (result != val) {
    $("#checkbox").prop("checked", false);
  } else {
    $("#checkbox").prop("checked", true);
  }
  $(".overlay").removeClass("active");
}

function show_popap_index(id_popap) {
  text.value = "";
  $("#checkbox").prop("checked", false);

  var id = "#" + id_popap;
  var one = randomNumber(0, 100);
  var two = randomNumber(0, 100);
  var randomexample = randomNumber(0, 2);
  var example = document.getElementById("example");
  if (randomexample == 1) {
    example.innerHTML = one + " + " + two
    result = one + two;
  } else {
    example.innerHTML = one + " - " + two
    result = one - two;
  }

  $(id).addClass('active');
}

$(".window__close").click(function () {
  $(".dialog").removeClass("active");
  $("#checkbox").prop("checked", true);
});