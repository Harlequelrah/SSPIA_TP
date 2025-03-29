<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite('resources/css/app.css')
    @livewireStyles()
</head>
<body class="flex justify-center items-center h-screen bg-[#4a7c59]">
    <div class="bg-gray-100 p-8 rounded-lg shadow-lg">
        <x-auth.login />
    </div>
    @livewireScripts()
</body>
</html>
