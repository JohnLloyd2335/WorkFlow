<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WorkFlow</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <h3 class="my-2">Hello {{ $mailData['job_seeker'] }}</h3>

        <p class="lead my-1">Congratulations you are hired as {{ $mailData['position_applied'] }} in
            {{ $mailData['company_name'] }} wait for
            further updates, Thank you.</p>

    </div>
</body>

</html>
