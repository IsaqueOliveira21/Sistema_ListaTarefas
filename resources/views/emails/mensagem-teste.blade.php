<x-mail::message>
# Introdução

O corpo da mensagem.

- Op 1
- Op 2
- Op 3

<x-mail::button :url="''">
Botão
</x-mail::button>

<x-mail::button :url="''">
Botão 2
</x-mail::button>

Agradecimentos,<br>
{{ config('app.name') }}
</x-mail::message>
