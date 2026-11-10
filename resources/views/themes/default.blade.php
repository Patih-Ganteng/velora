<!DOCTYPE html>
<html>
<head>
    <title>{{ $invitation->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="text-center p-8 bg-white shadow-lg rounded">
        <h1 class="text-3xl font-bold">{{ $invitation->title }}</h1>
        <p class="text-gray-500 mt-2">Tema {{ $invitation->sub_theme }} sedang dalam pengembangan.</p>
    </div>
</body>
</html>