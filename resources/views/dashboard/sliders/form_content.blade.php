         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
             <div>
                 <x-input-label for="title_en" :value="__('admin.title_en')" />
                 <x-text-input id="title_en" name="title_en" type="text" class="mt-1 block w-full" lang="en" dir="ltr" :value="old('title_en' , $slider->title['en'] ?? '')"
                     required autofocus  />
                 <x-input-error :messages="$errors->get('title_en')" class="mt-2" />
             </div>
             <div>
                 <x-input-label for="title_ar" :value="__('admin.title_ar')" />
                 <x-text-input id="title_ar" name="title_ar" type="text" class="mt-1 block w-full" lang="ar" dir="rtl" :value="old('title_ar' , $slider->title['ar'] ?? '')"
                     required  />
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

             @isset($slider->image)
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
                             <img src="{{ asset($slider->image->path) }}" alt="{{ __('admin.slider_image') }}"
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
                 <x-textarea id="content_en" name="content_en" class="mt-1 block w-full" rows="6" lang="en" dir="ltr"
                     required>{{ old('content_en' , $slider->content['en'] ?? '') }}</x-textarea>
                 <x-input-error :messages="$errors->get('content_en')" class="mt-2" />
             </div>
             <div>
                 <x-input-label for="content_ar" :value="__('admin.content_ar')" />
                 {{-- <textarea name="content" id="content" cols="30" rows="6"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content') }}</textarea> --}}
                 <x-textarea id="content_ar" name="content_ar" class="mt-1 block w-full" rows="6" lang="ar" dir="rtl"
                     required>{{ old('content_ar' , $slider->content['ar'] ?? '') }}</x-textarea>
                 <x-input-error :messages="$errors->get('content_ar')" class="mt-2" />
             </div>
         </div>

         <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
             <div>
                 <x-input-label for="btn1_text_en" :value="__('admin.btn1_text_en')" />
                 <x-text-input id="btn1_text_en" name="btn1_text_en" type="text" class="mt-1 block w-full" lang="en" dir="ltr"
                     :value="old('btn1_text_en' , $slider->btn1_text['en'] ?? '')" />
                 <x-input-error :messages="$errors->get('btn1_text_en')" class="mt-2" />
             </div>
             <div>
                 <x-input-label for="btn1_text_ar" :value="__('admin.btn1_text_ar')" />
                 <x-text-input id="btn1_text_ar" name="btn1_text_ar" type="text" class="mt-1 block w-full" lang="ar" dir="rtl"
                     :value="old('btn1_text_ar' , $slider->btn1_text['ar'] ?? '')" />
                 <x-input-error :messages="$errors->get('btn1_text_ar')" class="mt-2" />
             </div>
             <div>
                 <x-input-label for="btn1_link" :value="__('admin.btn1_link')" />
                 <x-text-input id="btn1_link" name="btn1_link" type="url" class="mt-1 block w-full" lang="en" dir="ltr"
                     :value="old('btn1_link' , $slider->btn1_link ?? '')" />
                 <x-input-error :messages="$errors->get('btn1_link')" class="mt-2" />
             </div>
         </div>

         <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
             <div>
                 <x-input-label for="btn2_text_en" :value="__('admin.btn2_text_en')" />
                 <x-text-input id="btn2_text_en" name="btn2_text_en" type="text" class="mt-1 block w-full" lang="en" dir="ltr"
                     :value="old('btn2_text_en' , $slider->btn2_text['en'] ?? '')" />
                 <x-input-error :messages="$errors->get('btn2_text_en')" class="mt-2" />
             </div>
             <div>
                 <x-input-label for="btn2_text_ar" :value="__('admin.btn2_text_ar')" />
                 <x-text-input id="btn2_text_ar" name="btn2_text_ar" type="text" class="mt-1 block w-full" lang="ar" dir="rtl"
                     :value="old('btn2_text_ar' , $slider->btn2_text['ar'] ?? '')" />
                 <x-input-error :messages="$errors->get('btn2_text_ar')" class="mt-2" />
             </div>
             <div>
                 <x-input-label for="btn2_link" :value="__('admin.btn2_link')" />
                 <x-text-input id="btn2_link" name="btn2_link" type="url" class="mt-1 block w-full" lang="en" dir="ltr"
                     :value="old('btn2_link' , $slider->btn2_link ?? '')" />
                 <x-input-error :messages="$errors->get('btn2_link')" class="mt-2" />
             </div>
         </div>
     