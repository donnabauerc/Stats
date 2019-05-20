<?php
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stats</title>

        <link rel="stylesheet" type="text/css" href="../css/login.css">

        <script>
            var working = false;
            $('.login').on('submit', function(e) {
                e.preventDefault();
                if (working) return;
                working = true;
                var $this = $(this),
                    $state = $this.find('button > .state');
                $this.addClass('loading');
                $state.html('Authenticating');
                setTimeout(function() {
                    $this.addClass('ok');
                    $state.html('Welcome back!');
                    setTimeout(function() {
                        $state.html('Log in');
                        $this.removeClass('ok loading');
                        working = false;
                    }, 4000);
                }, 3000);
            });
        </script>
    </head>
    <body>
        <div class="wrapper">
            <form class="login">
                <p class="title">Log in</p>
                <input type="text" placeholder="Username" autofocus/>
                <i class="fa fa-user"></i>
                <input type="password" placeholder="Password" />
                <i class="fa fa-key"></i>
                <a href="#">Forgot your password?</a>
                <button>
                    <i class="spinner"></i>
                    <span class="state">Log in</span>
                </button>
            </form>
        </div>
    </body>
</html>
