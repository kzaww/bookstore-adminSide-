<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <div class="" style="min-height: 100vh;width:100%;justify-content:center;display:flex;flex-direction: column;">
        <div class="" style="margin-left: 40%">
            <h1 class="text-secondary">404 Page Not Found </h1>
            <form action="{{ route("logout") }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>