<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        .day {
            margin-top: 20px;
        }

        .exercise {
            margin-left: 20px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            padding: 10px;
            list-style: none;
        }
    </style>
</head>

<body>
    <h1>Treinos do Estudante: {{ $student_name }}</h1>

    <!-- Exibição dos treinos por dia -->
    @forelse($workouts as $day => $exercises)
        <div class="day">
            <h2>{{ $day }}</h2>
            <ul>
                @forelse($exercises as $exercise)
                    <li class="exercise">
                        @if (isset($exercise['workout_details']))
                            <strong>Exercício:</strong> {{ $exercise['exercise_details']['description'] }} <br>
                            <strong>Repetições:</strong> {{ $exercise['workout_details']['repetitions'] }} <br>
                            <strong>Peso:</strong> {{ $exercise['workout_details']['weight'] }} <br>
                            <strong>Tempo de descanso:</strong> {{ $exercise['workout_details']['break_time'] }}
                            minuto(s) <br>
                            <strong>Tempo de execução:</strong> {{ $exercise['workout_details']['time'] }} minuto(s)
                            <br>
                            <strong>OBS:</strong> {{ $exercise['workout_details']['observations'] }} <br>
                        @else
                            <span>Sem detalhes disponíveis para este exercício.</span>
                        @endif
                    </li>
                @empty
                @endforelse
            </ul>
        </div>
    @empty
        <p>Nenhum dia de treino disponível para exibir.</p>
    @endforelse
</body>

</html>
