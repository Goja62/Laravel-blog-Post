<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <H1>This is blade template</H1>
    <h3><a href="/about">Go to about page</a></h3>

    <p>A great number is {{ 2 + 2 }}</p>
    <p>The curret year is {{ date('Y') }}</p>
    <p>My Name is {{ $name }}</p>
    <ul>
        @foreach ($sportovi as $sport)
            <li>Sport je: {{ $sport }}</li>
        @endforeach
    </ul>
    <p></p>
</body>

</html>
