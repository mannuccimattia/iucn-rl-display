@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'bg-main  text-main-contrast border-main-light focus:border-main-emphasis/20 focus:ring-main-emphasis/20 rounded-md shadow-sm']) }}>
