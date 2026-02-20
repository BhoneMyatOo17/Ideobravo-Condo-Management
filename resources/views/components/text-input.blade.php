@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block w-full px-3 py-2 rounded-md border border-solid border-alpha-light dark:border-alpha-dark text-sm text-base focus:border-primary']) }}>