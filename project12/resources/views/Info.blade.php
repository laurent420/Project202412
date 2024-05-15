<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/info.css">
    <title>Document</title>
</head>

<body>
@if ( auth()->user()->is_banned  == 1)
    <h1>You are banned</h1>    

@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Info') }}
            </h2>
        </x-slot>
        <h2 class="tussentitel">Opening hours</h2>
        <h3>MediaLab & FabLab</h3>
        <p>Closed on holidays</p>
        <p> Summer closure 2024: 11/07 to 15/08</p>
        <p>Monday: 10:00 - 12:00 & 12:30 - 17:00</p>
        <p>Tuesday: closed</p>
        <p>Wednesday: closed</p>
        <p>Thursday: 10:00 - 12:00 & 12:30 - 17:00</p>
        <p>Friday: 10:00 - 12:00 & 12:30 - 17:00</p>

        Lending service
        Monday: 10:00 - 12:00 & 12:30 - 17:00
        Tuesday: closed
        Wednesday: closed
        Thursday: closed
        Friday: 10:00 - 12:00 - 12:30 - 17:00

        Contact
        gwendo@ehb.be
    </x-app-layout>


@endif
</body>

</html>