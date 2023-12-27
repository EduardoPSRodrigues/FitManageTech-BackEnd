<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo a Fitness Manage Tech</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #fbb73c;
        }

        p {
            color: #333333;
        }

        .type-plan {
            display: inline-block;
            padding: 10px;
            background-color: #fbb73c;
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            border-radius: 4px;
            margin-top: 20px;
        }

    </style>
</head>

<body>

    <div class="container">

        <img src="{{ $message->embed(public_path('bemVindo.png')) }}" width="500px" height="auto" />

        <h1>Olá {{ $user->name }}</h1>
        <p>Em primeiro lugar, gostaríamos de lhe dar as boas-vindas a Fitness Manage Tech.</p>
        <p>Nós sabemos que a decisão por uma academia envolve uma série de fatores e ficamos muito felizes por você ter
            nos escolhido.</p>

        <div class="type-plan">
            Tipo de plano:
            @switch($user->plan_id)
                @case(1)
                    BRONZE
                @break

                @case(2)
                    PRATA
                @break

                @case(3)
                    OURO
                @break

                @default
                    Plano não especificado
            @endswitch
        </div>

        <div class="type-plan">
            Limite de cadastro:
            @switch($user->plan_id)
                @case(1)
                    10 estudantes
                @break

                @case(2)
                    20 estudantes
                @break

                @case(3)
                    Ilimitado
                @break

                @default
                    Limite não especificado
            @endswitch
        </div>

    </div>
</body>

</html>
