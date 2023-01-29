<x-mail::message>
# {{ $tarefa }}

Data limite de conclusao: {{ $data_limite_conclusao }}

<x-mail::button :url="$url">
Ver Tarefa
</x-mail::button>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
