<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Pastelaria Sabor Delícia')
<img src="http://localhost:8000/img/logo.png" class="logo" alt="Pastelaria Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
