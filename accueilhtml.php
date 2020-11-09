<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <script src="jquery-3.5.1.min.js"></script>
</head>
<body>
    <h1>Accueil</h1>
    
    <script>
    
        $(function()
        {
            $.ajax({
                url: "index.php",
                method: "POST",
                dataType: "json"
                })
                .done(function(messages){
                    console.log(messages);
                    messages=JSON.parse(messages);

                    for (let i = 0; i < messages.length; i++) {
							// pour chacun des éléments envoyés en json, on l'ajoute à la liste
							$("#messages").append("<li>"+ messages[i].id+' '+ messages[i].titre+' '+ messages[i].date + "</li>");
						}
                });
        });
        
    </script>
        <ul id="$messages"></ul>

        <tr>
            <td><h2><a href="affichage_message.php">afficher les messages</a></h2></td>
        </tr>

        
            
</body>
</html>