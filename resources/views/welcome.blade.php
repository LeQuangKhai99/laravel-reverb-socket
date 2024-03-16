<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    {{ Auth::user()->name }}
    <div id="list-mess"></div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        console.log('aa');
        Echo.channel('send-message')
            .listen('Message', (e) => {
                console.log(e);
                document.getElementById('list-mess').innerHTML += `<p>${e.mess}</p>`;
                console.log('mess: ' + e.mess)
            });
    });
</script>

</html>
