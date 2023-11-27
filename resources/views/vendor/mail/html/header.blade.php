@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="frontend/assets/img/Logo-SSRC-cut.png" style="display:block;margin:auto;margin-bottom:20px;text-align:center;width:50px;" alt="Logo">
@endif
</a>
</td>
</tr>
