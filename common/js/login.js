$(document).ready(function () {
    "use strict";
    $("#submit").click(function () {
        var username = $("#myusername").val(), password = $("#password").val(), page = $("#page").val(), common = $("#common").val();

        function testnfc()
        {
            $.ajax({
                type: "GET",
                url: "includes/nfcaccount.php",
                dataType : 'JSON',
                success: function (data) {
                    var result = data["result"];
                    if (result == true)
                    {
                        var msg = data["msg"];
                        $("#message").html("<div class=\"alert alert-info\"> "+msg+"<script type=\'text/JavaScript\'> setTimeout(\'location.href = \"index.php\";\', 10000);</script> </div>");
                    }
                    else {
                        $("#message").html("<div class=\"alert alert-warning\">Aucune carte valide trouvé.</div>");
                    }
                },
                error : function() {
                    $("#message").html("Erreur");
                }
            });
        }

        function testlogin()
        {
            $.ajax({
                type: "POST",
                url: common+"checklogin.php",
                data: "myusername=" + username + "&password=" + password + "&page=" + page,
                dataType: 'JSON',
                success: function (html) {
                    //console.log(html.response + ' ' + html.username);
                    if (html.response === 'true' || html.response === '1')
                    {

                            location.reload();
                            return html.username;
                    } else {

                            $("#message").html(html.response);
                        }
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                beforeSend: function () {
                    $("#message").html("<p class='text-center'><img src="+common+"images/ajax-loader.gif></p>");
                }
            });
        }

        if (page == "members") {
            if ((username != "") && (password != "")) {
                testlogin();
            }
            else {
                testnfc();
            }
        }
        else if ((username === "") || (password === "")) {
            $("#message").html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Merci de compléter les champs utilisateur et mot de passe.</div>");
        }
        else {
            testlogin();
        }
        return false;
    });
});
