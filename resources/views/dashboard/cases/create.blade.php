<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('admin.add_case') }}
            </h2>
            <a href="{{ route('dashboard.cases.index') }}"
                class="inline-flex items-center px-6 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition">
                {{ __('admin.all_cases') }}
            </a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('dashboard.cases.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        @include('dashboard.cases.form_content')
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                            {{ __('admin.create_case') }}
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const fileInput = document.getElementById('image');
        const fileName = document.getElementById('file-name');

        const defaultText = fileName.textContent;

        fileInput.addEventListener('change', function() {
            fileName.textContent =
                this.files.length ? this.files[0].name : defaultText;
        });
    </script>
</x-app-layout>
