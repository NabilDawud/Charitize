         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
             <div>
                 <x-input-label for="title_en" :value="__('admin.title_en')" />
                 <x-text-input id="title_en" name="title_en" type="text" class="mt-1 block w-full" lang="en"
                     dir="ltr" :value="old('title_en', $case->title['en'] ?? '')" required autofocus />
                 <x-input-error :messages="$errors->get('title_en')" class="mt-2" />
             </div>
             <div>
                 <x-input-label for="title_ar" :value="__('admin.title_ar')" />
                 <x-text-input id="title_ar" name="title_ar" type="text" class="mt-1 block w-full" lang="ar"
                     dir="rtl" :value="old('title_ar', $case->title['ar'] ?? '')" required />
                 <x-input-error :messages="$errors->get('title_ar')" class="mt-2" />
             </div>
         </div>
         <div>
             <x-input-label for="image" :value="__('admin.image')" />

             <div tabindex="0" role="button" onclick="document.getElementById('image').click()"
                 onkeydown="if(event.key==='Enter' || event.key===' ') document.getElementById('image').click()"
                 class="mt-1 flex items-center w-full rounded-md border border-gray-300 bg-white overflow-hidden
                               cursor-pointer focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                 <label for="image"
                     class="px-4 h-10 flex items-center bg-indigo-50 text-indigo-700 font-medium border-e border-gray-300 hover:bg-indigo-100 transition">
                     {{ __('admin.choose_image') }}
                 </label>

                 <span id="file-name" class="px-4 h-10 flex items-center text-gray-500 text-sm truncate">
                     {{ __('admin.no_file_selected') }}
                 </span>

                 <input id="image" name="image" type="file" class="hidden">
             </div>

             @isset($case->image)
                 <div class="mt-2 w-fit">
                     <!-- Card -->
                     <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-3">
                         <!-- Header -->
                         <div class="flex items-center justify-between mb-2">
                             <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                 {{ __('admin.current_image') }}
                             </span>
                         </div>

                         <!-- Image -->
                         <div class="w-44 h-44 rounded-lg overflow-hidden group relative">
                             <img src="{{ asset($case->image->path) }}" alt="{{ __('admin.slider_image') }}"
                                 class="w-full h-full object-cover transition duration-300 group-hover:scale-110">

                             <!-- subtle overlay on hover -->
                             <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition">
                             </div>
                         </div>

                     </div>

                 </div>
             @endisset
             <x-input-error :messages="$errors->get('image')" class="mt-2" />
         </div>

         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
             <div>
                 <x-input-label for="content_en" :value="__('admin.content_en')" />
                 {{-- <textarea name="content" id="content" cols="30" rows="6"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content') }}</textarea> --}}
                 <x-textarea id="content_en" name="content_en" class="mt-1 block w-full" rows="6" lang="en"
                     dir="ltr" required>{{ old('content_en', $case->content['en'] ?? '') }}</x-textarea>
                 <x-input-error :messages="$errors->get('content_en')" class="mt-2" />
             </div>
             <div>
                 <x-input-label for="content_ar" :value="__('admin.content_ar')" />
                 {{-- <textarea name="content" id="content" cols="30" rows="6"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content') }}</textarea> --}}
                 <x-textarea id="content_ar" name="content_ar" class="mt-1 block w-full" rows="6" lang="ar"
                     dir="rtl" required>{{ old('content_ar', $case->content['ar'] ?? '') }}</x-textarea>
                 <x-input-error :messages="$errors->get('content_ar')" class="mt-2" />
             </div>
         </div>
         <div>
             <x-input-label for="link" :value="__('admin.link')" />
             <x-text-input id="link" name="link" type="url" class="mt-1 block w-full" lang="en"
                 dir="ltr" :value="old('link', $case->link ?? '')" />
             <x-input-error :messages="$errors->get('link')" class="mt-2" />
         </div>
         <div>
             <x-input-label for="goal" :value="__('admin.goal')" />
             <x-text-input id="goal" name="goal" type="number" class="mt-1 block w-full"  :value="old('goal', $case->goal ?? '')" required />
             <x-input-error :messages="$errors->get('goal')" class="mt-2" />
         </div>
         <div>
             <x-input-label for="status" :value="__('admin.status')" />
             <select id="status" name="status"
                 class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                 required>
                 <option value="open" {{ old('status', $case->status ?? '') === 'open' ? 'selected' : '' }}>
                     {{ __('admin.open') }}</option>
                 <option value="close" {{ old('status', $case->status ?? '') === 'close' ? 'selected' : '' }}>
                     {{ __('admin.close') }}</option>
             </select>
             <x-input-error :messages="$errors->get('status')" class="mt-2" />
         </div>
         <div>
             <x-input-label for="category_id" :value="__('admin.category')" />
             <select id="category_id" name="category_id"
                 class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                 required>
                 <option value="" disabled selected>{{ __('admin.select_category') }}</option>
                 @foreach ($categories as $category)
                     <option value="{{ $category->id }}" {{ old('category_id', $case->category_id ?? '') == $category->id ? 'selected' : '' }}>
                         {{ $category->title_trans ?? '' }}
                     </option>
                 @endforeach
             </select>
             <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
         </div>