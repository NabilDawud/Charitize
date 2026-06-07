         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
             <div>
                 <x-input-label for="title_en" :value="__('admin.title_en')" />
                 <x-text-input id="title_en" name="title_en" type="text" class="mt-1 block w-full" lang="en" dir="ltr" :value="old('title_en' , $category->title['en'] ?? '')"
                     required autofocus  />
                 <x-input-error :messages="$errors->get('title_en')" class="mt-2" />
             </div>
             <div>
                 <x-input-label for="title_ar" :value="__('admin.title_ar')" />
                 <x-text-input id="title_ar" name="title_ar" type="text" class="mt-1 block w-full" lang="ar" dir="rtl" :value="old('title_ar' , $category->title['ar'] ?? '')"
                     required  />
                 <x-input-error :messages="$errors->get('title_ar')" class="mt-2" />
             </div>
         </div>

     