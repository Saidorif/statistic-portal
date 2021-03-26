<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>STATISTIC</title>
        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->
        <link href="{{ asset('fonts/peicon/css/peicon.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css?version=1.1.1') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css?version=1.1.1') }}">
        <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    </head>
    <body>
        <div class="toggleWrapper">
            <input type="checkbox" class="dn" id="themeswitcher" checked/>
            <label for="themeswitcher" class="toggle">
                <span class="toggle__handler">
                    <span class="crater crater--1"></span>
                    <span class="crater crater--2"></span>
                    <span class="crater crater--3"></span>
                </span>
                <span class="star star--1"></span>
                <span class="star star--2"></span>
                <span class="star star--3"></span>
                <span class="star star--4"></span>
                <span class="star star--5"></span>
                <span class="star star--6"></span>
            </label>
        </div>
        <div id="app">
            <Master/>
        </div>
        <script src="{{ asset('js/xlsx.full.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/print.js') }}"></script>
        <script>
            let switcher = document.querySelector('#themeswitcher');
            let body = document.querySelector('body');
            if(localStorage.getItem('theme') && localStorage.getItem('theme') == 'light'){
                body.classList.add('light')
                switcher.checked = false
            }
            switcher.onchange = function(e){
                if(this.checked){
                    body.classList.remove('light')
                    localStorage.setItem('theme', 'dark')
                }else{
                    body.classList.add('light')
                    localStorage.setItem('theme', 'light')
                }
            }
        </script>
    </body>
</html>
