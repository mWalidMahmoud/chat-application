<h1>Bienvenue sur votre application de chat</h1>
<a class="btn btn-primary" href="/?p=chat.logout" role="button">Déconnexion</a>

<h2>Liste des utilisateurs connectés</h2>
<ul class="list-group" id="users"></ul>

<h2>Messages</h2>
<ul class="list-group" id="messages"></ul>

<form method="post">
    <div class="form-group">
        <label for="username"></label>
        <textarea class="form-control" rows="5" name="content" id="content" required
                  placeholder="Votre message"></textarea>
    </div>
    <br/>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    refresh();

    setInterval(
        function () {
            refresh();
        }, 3000
    );

    function refresh() {
        $.ajax(
            {
                type: "POST",
                dataType: "json",
                url: "/?p=chat.refresh",
                success: function (data) {
                    $("#messages").empty();
                    for (message in data) {
                        $("#messages").append('<li class="list-group-item">><strong>' + data[message].username + '</strong> <i>[' + data[message].createdAt + ']</i> :' + data[message].content + '</li>');
                    }
                }
            });

        $.ajax(
            {
                type: "POST",
                dataType: "json",
                url: "/?p=chat.checkConnection",
                success: function (data) {
                    $("#users").empty();
                    for (message in data) {
                        $("#users").append('<li class="list-group-item">>' + data[message] + '</li>');
                    }
                }
            });
    }
</script>