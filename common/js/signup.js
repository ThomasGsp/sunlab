$(document).ready(function(){

  $("#submit").click(function(){

    var username = $("#newuser").val();
    var password = $("#password1").val();
    var password2 = $("#password2").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var name = $("#name").val();
    var firstname = $("#firstname").val();
    var nfccard = $("#nfccard").val();

    if((username == "") || (password == "") || (email == "") || (name == "") || (firstname == "")) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Tous les champs ne sont pas complétés</div>");
    }
    else {
      $.ajax({
        type: "POST",
        url: "user_create.php",
        data: "newuser="+username+"&nfccard="+nfccard+"&password1="+password+"&password2="+password2+"&email="+email+"&phone="+phone+"&firstname="+firstname+"&name="+name+"&authtype=local",
        success: function(html){

			var text = $(html).text();
			//Pulls hidden div that includes "true" in the success response
			var response = text.substr(text.length - 4);

          if(response == "true"){

			$("#message").html(html);

					$('#submit').hide();
			}
		else {
			$("#message").html(html);
			$('#submit').show();
			}
        },
        beforeSend: function()
        {
          $("#message").html("<p class='text-center'><img src='images/ajax-loader.gif'></p>")
        }
      });
    }
    return false;
  });
});
