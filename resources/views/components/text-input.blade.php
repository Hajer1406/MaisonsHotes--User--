@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'mt-1 block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-dark-900 shadow-sm placeholder-gray-400 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition-colors duration-200 ease-in-out']) }}>
