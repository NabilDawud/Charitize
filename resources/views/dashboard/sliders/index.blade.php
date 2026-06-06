<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('admin.sliders') }}
            </h2>
            <a href="{{ route('dashboard.sliders.create') }}"
                class="inline-flex items-center px-6 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
                {{ __('admin.add_slider') }}
            </a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-hidden bg-white shadow-sm rounded-xl border border-gray-200">
                        <div class="overflow-x-auto">
                            <table
                                class="w-full text-sm text-right rtl:text-right ltr:text-left text-gray-600 antialiased">
                                <thead
                                    class="text-xs font-semibold uppercase tracking-wider text-gray-500 bg-gray-100 border-b border-gray-200">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-center w-20">
                                            {{ __('admin.id') }}
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-center w-32">
                                            {{ __('admin.image') }}
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-center">
                                            {{ __('admin.title') }}
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-center">
                                            {{ __('admin.created_at') }}
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-center">
                                            {{ __('admin.updated_at') }}
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-center w-48">
                                            {{ __('admin.actions') }}
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @forelse ($sliders as $slider)
                                        <tr class="hover:bg-gray-50/70 transition-colors duration-200">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-center font-medium text-gray-400 text-xs">
                                                {{ '#' }} {{ $slider->id }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex justify-center">
                                                    @if ($slider->image)
                                                        <img src="{{ asset($slider->image->path) }}"
                                                            alt="{{ __('admin.slider_image') }}"
                                                            class="h-20 w-20 object-cover rounded-lg ring-1 ring-gray-200 shadow-xs">
                                                    @else
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-500">
                                                            {{ __('admin.no_image') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-center font-medium text-gray-900">
                                                {{ $slider->title[app()->getLocale()] ?? '-' }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-center text-xs text-gray-500">
                                                {{ $slider->created_at ? (app()->getLocale() === 'en' ? $slider->created_at->format('d-m-Y') : $slider->created_at->format('Y-m-d')) : '-' }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-center text-xs text-gray-500">
                                                {{ $slider->updated_at ? $slider->updated_at->diffForHumans() : '-' }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <div class="flex items-center justify-center gap-x-1.5">
                                                    <a href="{{ route('dashboard.sliders.edit', $slider) }}"
                                                        class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-md transition-colors duration-150 text-xs font-semibold">
                                                        {{ __('admin.edit') }}
                                                    </a>

                                                    <form action="{{ route('dashboard.sliders.destroy', $slider) }}"
                                                        method="POST" class="inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-md transition-colors duration-150 text-xs font-semibold">
                                                            {{ __('admin.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6"
                                                class="px-6 py-12 whitespace-nowrap text-sm font-medium text-center text-gray-400 bg-gray-50/50">
                                                <div class="flex flex-col items-center justify-center space-y-2">
                                                    <svg class="w-8 h-8 text-gray-300" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                                    </svg>
                                                    <span>{{ __('admin.no_sliders_found') }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('submit', (event) => {
            if (!event.target.matches('.delete-form')) {
                return;
            }
            event.preventDefault();
            Swal.fire({
                title: '{{ __('admin.confirm_delete') }}',
                text: '{{ __('admin.confirm_delete_text') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{ __('admin.yes_delete') }}',
                cancelButtonText: '{{ __('admin.cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>
