<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>List Invite</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 600px;
                margin: 20px auto;
                background-color: #ffffff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #333333;
            }

            p {
                color: #666666;
            }

            a {
                color: #007bff;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1 style="text-align: center">{{ $creator->name }} invites You to {{ $list->name }}</h1>
            <p>Hello,</p>
            <p>This is an email invitation for you to join the shopping list from {{ $list->creator->name }}.</p>
            <p>Click on <a href="{{ route('lists.invite.accept', ['list' => $list->id, 'token' => $token->token]) }}">this link</a> to accept invitation.</p>
            <p>To join the shopping list you must have an account in {{ config('app.name') }}.</p>
            <p>If you don't have one, click <a href="{{ route('register') }}">here</a> to create an account.</p>
            <span>If you weren't expecting this email, ignore it.</span>

            <p>If you have any questions, feel free to <a href="mailto:{{ config('mail.from.address') }}">contact us</a>.</p>

            <p>Best regards,<br>{{ config('app.name') }}</p>
        </div>
    </body>
</html>
