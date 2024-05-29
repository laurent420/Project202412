<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/info.css">
    <title>Info Page</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .left, .right {
            width: 48%;
        }
        .tussentitel {
            color: #333;
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .media, .lending, .maps {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .contact a {
            color: #1a73e8;
            text-decoration: none;
        }
        .contact a:hover {
            text-decoration: underline;
        }
        iframe {
            width: 100%;
            border: 0;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    @if (auth()->user()->is_banned == 1)
        <h1>You are banned</h1>
    @else
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Info') }}
                </h2>
            </x-slot>
            <div class="container">
                <div class="left">
                    <h2 class="tussentitel">Opening hours</h2>
                    <div class="media">
                        <h3>MediaLab & FabLab</h3>
                        <p>Closed on holidays</p>
                        <p>Summer closure 2024: 11/07 to 15/08</p>
                        <table>
                            <tr>
                                <th>Day</th>
                                <th>Opening Hours</th>
                            </tr>
                            <tr>
                                <td>Monday</td>
                                <td>10:00 - 12:00 & 12:30 - 17:00</td>
                            </tr>
                            <tr>
                                <td>Tuesday</td>
                                <td>Closed</td>
                            </tr>
                            <tr>
                                <td>Wednesday</td>
                                <td>Closed</td>
                            </tr>
                            <tr>
                                <td>Thursday</td>
                                <td>10:00 - 12:00 & 12:30 - 17:00</td>
                            </tr>
                            <tr>
                                <td>Friday</td>
                                <td>10:00 - 12:00 & 12:30 - 17:00</td>
                            </tr>
                        </table>
                    </div>
                    <div class="lending">
                        <h3>Lending service</h3>
                        <table>
                            <tr>
                                <th>Day</th>
                                <th>Opening Hours</th>
                            </tr>
                            <tr>
                                <td>Monday</td>
                                <td>10:00 - 12:00 & 12:30 - 17:00</td>
                            </tr>
                            <tr>
                                <td>Tuesday</td>
                                <td>Closed</td>
                            </tr>
                            <tr>
                                <td>Wednesday</td>
                                <td>Closed</td>
                            </tr>
                            <tr>
                                <td>Thursday</td>
                                <td>Closed</td>
                            </tr>
                            <tr>
                                <td>Friday</td>
                                <td>10:00 - 12:00 & 12:30 - 17:00</td>
                            </tr>
                        </table>
                    </div>
                    <h2 class="tussentitel">Contact</h2>
                    <div class="contact">
                        <a href="mailto:gwendo@ehb.be">gwendo@ehb.be</a>
                    </div>
                </div>
                <div class="right">
                    <h2 class="tussentitel">Where?</h2>
                    <div class="maps">
                        <p>Campus Kaai of the Erasmushogeschool Brussel.<br>
                            Nijverheidskaai 170, 1070 Brussel</p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2519.4311531217913!2d4.319903976085168!3d50.84169975911683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3c5c00a0304c5%3A0x8eb9da4b7a309a1c!2sMedialab.Brussel!5e0!3m2!1sen!2sbe!4v1715090230758!5m2!1sen!2sbe"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </x-app-layout>
    @endif
</body>

</html>
