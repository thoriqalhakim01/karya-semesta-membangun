@props(['disabled' => false])

<select @disabled($disabled)
    {{ $attributes->merge([
        'class' =>
            'block w-full px-3 py-2 border border-gray-300 rounded-md text-sm leading-5 transition duration-150 ease-in-out',
    ]) }}>
    {{ $slot }}
</select>
