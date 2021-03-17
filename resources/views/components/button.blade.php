@props(['color'])
<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-' . $color . '-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-' . $color . '-600 active:bg-' . $color . '-600 focus:outline-none focus:border-' . $color . '-600 focus:ring ring-' . $color . '-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
