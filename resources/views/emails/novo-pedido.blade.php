@component('mail::message')

Olá, {{ $nome }}

Seu pedido está sendo preparado. Agradecemos a preferência!

- Pedido de Númento {{ $pedido_id }}.

- Pastel: {{ $pastel }}.

- Data de criação do pedido: {{ date('d-m-Y H:i:s', strtotime($data_criacao)) }}

{{-- @component('mail::button', ['url' => $url ])
Button Text
@endcomponent --}}

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
