<html>
    <body>
        {!! var_dump(app('session')->getFlashBag()->get('errors')) !!}
        <form action="/signin" method="POST">
            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">

            <button type="submit">Inloggen</button>
        </form>
    </body>
</html>