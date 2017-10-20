<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hello.</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <h1>Hallo.</h1>

        <div class="row">
            <div class="col-md-6">
                <form method="GET">
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input name="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="address">Adres</label>
                        <input name="address" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="country">Land</label>
                        <input name="country" class="form-control" />
                    </div>
                    <button class="btn btn-default">Let's see the magic</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2><?= e(app()->request->get('name')); ?></h2>
                <h4><?= e(app()->request->get('email')); ?></h4>
                <h4><?= e(app()->request->get('address')); ?></h4>
                <h4><?= e(app()->request->get('country')); ?></h4>
            </div>
        </div>
    </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>