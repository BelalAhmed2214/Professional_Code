<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Home page</title>
    <style>
    .container {
        text-align: center;
       
        width: 300px;
        height: 200px;
        padding-top: 100px;
    }

    #btn {
        font-size: 25px;
    }
    </style>
</head>

<body>
    <div class="container">
        <a href="{{route('offers.all')}}" class="btn btn-primary btn-lg">Offers</a>
    </div>
</body>

</html>