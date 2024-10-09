<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Application Title')</title> <!-- Optional title -->
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <link href="/css/add.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>
<body>
    <div class="flex">
        <!-- Sidebar and Navigation Here -->
      
            <!-- Your sidebar code goes here -->
        </div>

        <!-- Main Content -->
        <div class="w-4/5">
            @yield('content') <!-- This is where the content of your views will be injected -->
        </div>
    </div>
</body>
</html>
