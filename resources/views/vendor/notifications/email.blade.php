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
    .submit-button {
        width: auto;
        height: auto;
        padding: 10px;
        margin-top: 10px;
        font-size: 15pt;
        background-color: rgb(230, 229, 229);
        border: 2px solid rgb(230, 229, 229);
        border-radius: 8px;
        cursor: pointer;
    }
</style>

    <div class="substrate">
        <h1>Привет!</h1>
        <div>Вы получаете это электронное письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи.   </div>

        <x-mail::button :url="$actionUrl" class="submit-button">Сбросить пароль</x-mail::button>

        <div>Срок действия этой ссылки для сброса пароля истечет через 60 минут. Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется. С уважением,</div>
        <div>{{ config('app.name') }}</div>
    </div>
