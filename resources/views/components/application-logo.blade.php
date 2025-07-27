@php
    $currentRoute = request()->route()->getName();
    $hideOn = ['login', 'register'];
@endphp

@if (!in_array($currentRoute, $hideOn))
    <img src="{{ asset('images/volvo_logo.png') }}" alt="Volspares Logo" class="h-10 w-auto" />
@endif
