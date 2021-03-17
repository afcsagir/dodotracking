@props(['title' => '', 'sm' => 12, 'md' => 12])


<div
    class="bg-white rounded-md w-full overflow-hidden col-span-{{ $sm }} md:col-span-{{ $md }} shadow">
    <div class="pb-2">
        <div class="p-6 rounded-lg bg-white">
            <div class="md:flex md:justify-between md:items-center">
                <div>
                    <h2 class="text-xl text-gray-800 font-bold leading-tight">{{ $title }}</h2>
                </div>
            </div>
            <div class="my-8 relative">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
