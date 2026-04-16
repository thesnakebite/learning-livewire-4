@props([
    'heading',
    'number',
    'change',
])

<flux:card class="p-5">
    <flux:subheading>{{ $heading }}</flux:subheading>
    <flux:heading size="xl" class="mt-2">
        @if (is_numeric($number))
            {{ number_format($number) }}
        @else
            {{ $number }}
        @endif
    </flux:heading>
    <flux:text class="mt-2 text-sm {{ $change >= 0 ? 'text-green-600' : 'text-red-600' }}">
        {{ $change >= 0 ? '↗' : '↘' }} {{ $change > 0 ? '+' : '' }}{{ $change }}%
    </flux:text>
</flux:card>
