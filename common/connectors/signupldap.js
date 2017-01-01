$(document).ready(function(){

    $("#submit").click(function(){

    var username = $("#newuser").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var name = $("#name").val();
    var firstname = $("#firstname").val();
    var nfccard = $("#nfccard").val();

    if((email == "") || (name == "") || (firstname == "") || (username == "")) {
      $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Tous les champs ne sont pas complétés</div>");
    }
    else {
      $.ajax({
        type: "POST",
        url: "../user_create.php",
        data: "newuser="+username+"&nfccard="+nfccard+"&email="+email+"&phone="+phone+"&firstname="+firstname+"&name="+name+"&authtype=ldap",
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
          $("#message").html("<p class='text-center'><img src='../images/ajax-loader.gif'></p>")
        }
      });
    }
    return false;
    });

    $("#submitldap").click(function(){
        $("#messageuldap").html("<img src='../images/ajax-loader.gif'> Recherche de vos informations ...");
        $.ajax({
            type: "POST",
            url: "ldapregister.php",
            data: "usernameldap="+$("#usernameldap").val()+"&passwordldap="+$("#passwordldap").val(),
            dataType: "json",
            success: function (data) {
                var result = data["result"];
                if (result == true)
                {
                    $("#messageldap").html("<div class=\"alert alert-info\"> Nous avons trouvé vos informations, vous pouvez passer à l'étape suivante</div>");
                    var name = data["name"];
                    var email = data["email"];
                    var username = data["username"];
                    var firstname = data["firstname"];
                    $("#submit").prop('disabled', false);
                    $('#firstname').val(firstname);
                    $('#email').val(email);
                    $('#newuser').val(username);
                    $('#name').val(name);
                }
                else
                    $("#messageldap").html("<div class=\"alert alert-warning\"> Utilisateur ou mot de passe invalide </div>");
            }
        });
        return false;
    });

});