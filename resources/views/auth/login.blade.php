<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,700;1,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <title>NailsbySpufilll - Авторизация</title>

    <style>

        * {
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: #D9D9D9;
        }

        .register {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .register form {
            margin-top: 20px;
        }

        .title {
            font-size: 21px;
            font-weight: 500;
            text-decoration: underline;
        }

        .input-group {
            max-width: 783px;
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 30px;
        }

        .input-group label {
            font-size: 18px;
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            outline: none;
            background-color: #BCBCBC;
            border: none;
            border-radius: 5px;
        }

        .input-group button {
            display: inline-block;
            max-width: fit-content;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            background-color: #FFBDBD;
        }

    </style>
</head>
<body>
<div class="register">
    <h2 class="title">Авторизация</h2>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group">
            <label for="">Введите Ваш номер телефона</label>
            <input type="text" name="phone_number" placeholder="Введите Ваш номер телефона">
        </div>
        <div class="input-group">
            <label for="">Введите пароль</label>
            <input type="password" name="password" placeholder="Введите пароль">
        </div>
        <div class="input-group">
            <button type="submit">Войти</button>
        </div>
        <a href="{{ route('register') }}">Зарегистрироваться</a>
    </form>
</div>

</body>
</html>
