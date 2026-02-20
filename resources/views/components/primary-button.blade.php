<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-navbar ml-5 px-5 py-2 rounded-md bg-gradient-to-r from-blue-400 to-blue-600 text-white hover:from-blue-500 hover:to-blue-700 transition-all ease-in-out duration-150']) }}>
    {{ $slot }}
</button>