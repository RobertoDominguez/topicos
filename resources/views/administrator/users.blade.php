<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>


<body>


    <nav class="navbar navbar-dark bg-dark justify-content-between">
        <a class="navbar-brand">Navbar</a>
        
        <form action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cerrar sesion</button>
        </form>
      </nav>


    @foreach ($users as $user)
        <table class="table" style="width:100%">

            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <form action="{{ route('users.accept', $user->id) }}" method="POST">
                    {{ csrf_field() }}
                    <td><button type="submit">Aceptar</button></td>
                </form>
                <form action="{{ route('users.reject', $user->id) }}" method="POST">
                    {{ csrf_field() }}
                    <td><button type="submit">Rechazar</button></td>
                </form>
            </tr>

        </table>
    @endforeach

</body>

</html>
