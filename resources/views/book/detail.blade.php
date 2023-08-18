<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('本の管理') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div>
            <div class="px-4 sm:px-0">
              <h3 class="text-base font-semibold leading-7 text-gray-900">本の詳細</h3>
            </div>
            <div class="mt-6 border-t border-gray-100">
              <dl class="divide-y divide-gray-100">
                <div class="flex px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900" style="
                  width: 40%;">ID</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" style="font-weight: bold;
                  width: 60%;">{{ $book->id }}</dd>
                </div>
                <div class="flex px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900" style="
                  width: 40%;">名前</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" style="font-weight: bold;
                  width: 60%;">{{ $book->name }}</dd>
                </div>
                <div class="flex px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900" style="
                  width: 40%;">ステータス</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" style="font-weight: bold;
                  width: 60%;">{{ $book->status }}</dd>
                </div>
                <div class="flex px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900" style="
                  width: 40%;">著者</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" style="font-weight: bold;
                  width: 60%;">{{ $book->author }}</dd>
                </div>
                <div class="flex px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900" style="
                  width: 40%;">出版</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" style="font-weight: bold;
                  width: 60%;">{{ $book->publication }}</dd>
                </div>
                <div class="flex px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900" style="
                  width: 40%;">読み終わった日</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" style="font-weight: bold;
                  width: 60%;">{{ Carbon\Carbon::parse($book->read_at)->format('Y年n月j日') }}</dd>
                </div>
                <div class="flex px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900" style="
                  width: 40%;">メモ</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" style="font-weight: bold;font-weight: bold;
                  width: 60%;">{{ $book->note }}</dd>
                </div>
              </dl>
            </div>
          </div>
          <div class="flex gap-4 justify-center relative">
            <button onclick="history.back()" class="mt-4 shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">{{ __('戻る') }}</button>
            <button onclick="location.href='/book/edit/{{ $book->id }}'" class="mt-4 shadow bg-orange-500 hover:bg-orange-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" style="background-color: rgb(249 115 22);">変更</button>
          </div>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>