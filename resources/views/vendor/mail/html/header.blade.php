@props(['url'])
@php
    $company = \App\Models\Company::first();
@endphp
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                @if ($company->logo == '/img/logo176x32.png')
                    <img src="{{ asset($company->logo) }}" class="logo" style="width: 300px;" />
                @else
                    <img src="{{ asset($company->logo) }}" class="logo" style="width: 300px" />
                @endif
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
