<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center px-8 py-3 bg-brand-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 active:bg-brand-800 transition-colors duration-200 ease-in-out w-full sm:w-auto']) }}>
    {{ $slot }}
</button>
