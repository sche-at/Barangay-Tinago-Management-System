<a {{ $attributes->merge([
    'class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 
                bg-white rounded-lg shadow-sm hover:bg-gradient-to-r hover:from-blue-400 
                hover:to-blue-600 hover:text-white focus:outline-none focus:ring-2 
                focus:ring-offset-2 focus:ring-blue-400 transition duration-300 ease-in-out 
                transform hover:scale-105 no-underline'
    ]) }}>
    {{ $slot }}
</a>
