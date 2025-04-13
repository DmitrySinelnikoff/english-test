<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добро пожаловать</title>
    <style>
        body {
            margin: 0px;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to bottom right, rgb(106, 220, 245), rgb(188, 147, 253));
            min-height: 100vh;
        }
        .substrate {
            width: calc(100%-20px);
            height: auto;
            margin: 2% 8%;
            padding: 2%;
            background-color: white;
            border-radius: 5px;
        }
        .blue-text {
            color: #30498f;
        }
    </style>
</head>
<body>
    <div class="substrate">
        <h1>Привет,  {{ $name }}!</h1>
        <p>Спасибо за регистрацию на нашем сайте! Мы очень рады видеть вас среди наших пользователей.</p>
        <p>Теперь у вас есть доступ ко всем возможностям платформы.</p>
        <p>Чтобы начать, вы можете перейти в свой <a href="http://english.learn:8000/home" class="blue-text"> личный кабинет</a>.</p>
        <p>С уважением,<br>Команда <strong>wordexamtest</strong>.</p>
    </div>
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Восстановление пароля</title>
    <style>
        body {
            margin: 0px;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to bottom right, rgb(106, 220, 245), rgb(188, 147, 253));
            min-height: 100vh;
        }
        .substrate {
            width: calc(100%-20px);
            height: auto;
            margin: 2% 8%;
            padding: 2%;
            background-color: white;
            border-radius: 5px;
        }
        .blue-text {
            color: #30498f;
        }
    </style>
</head>
<body>
    <div class="substrate">
        <h1>Привет!</h1>

        <div>Intro Lines </div>
        @foreach ($introLines as $line)
            {{ $line }}
        @endforeach
    
        <div>Action Button</div>
        @isset($actionText)
        {{
            $color = match ($level) {
                'success', 'error' => $level,
                default => 'primary',
            }
        }}
        < :url="$actionUrl" :color="$color">
        {{ $actionText }}
        </>
    </div>


</body>
</html> --}}