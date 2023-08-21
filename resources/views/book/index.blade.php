<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('本の管理') }}
      <button onclick="location.href='/book/new/'" class="text-base ml-5 shadow hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" style="  margin-left: 20px; background-color: rgb(59 130 246);">新規作成</button>
    </h2>
  </x-slot>

  @if(session('status'))
  <x-ui.flash-message message="{{ session('status') }}"></x-ui.flash-message>
  @endif

  <div class="pt-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="m-5">

          <form action="{{ route('book') }}">
            <div class="flex flex-row">

              <div class="col-span-6 sm:col-span-3 p-2 w-48">
                <label for="name" class="block text-sm font-medium text-gray-700">本の名前</label>
                <input type="text" name="name" id="name" value="{{ $name }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="p-2 w-48">
                <label for="status" class="block text-sm font-medium text-gray-700">ステータス</label>
                <select id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option value="">--</option>
                  @foreach(App\Models\Book::BOOK_STATUS_OBJECT as $key => $value)
                  <option value="{{ $key }}" @if($status==$key) selected @endif>{{ $value }}</option>
                  @endforeach
                </select>
              </div>

              <div class="p-2 w-48">
                <label for="author" class="block text-sm font-medium text-gray-700">著者</label>
                <select id="author" name="author" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option value="">--</option>
                  @foreach($authors as $option)
                  <option value="{{ $option }}" @if($author==$option) selected @endif>{{ $option }}</option>
                  @endforeach
                </select>
              </div>

              <div class="p-2 w-48">
                <label for="publication" class="block text-sm font-medium text-gray-700">出版</label>
                <select id="publication" name="publication" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option value="">--</option>
                  @foreach($publications as $option)
                  <option value="{{ $option }}" @if($publication==$option) selected @endif>{{ $option }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-span-6 sm:col-span-3 p-2 w-48">
                <label for="note" class="block text-sm font-medium text-gray-700">特記事項</label>
                <input type="text" name="note" id="note" value="{{ $note }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="col-span-6 sm:col-span-3 p-2 w-48 relative">
                <button type="submit" class="absolute inset-x-0 bottom-2 mr-2 shadow hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" style="
                  background-color: rgb(59 130 246);
                  width: 95%;
                  position: absolute;
                  right: 0;
                  top: 32px;
                    ">検索</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <!-- <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
              <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Pricing</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Banh mi cornhole echo park skateboard authentic crucifix neutra tilde lyft biodiesel artisan direct trade mumblecore 3 wolf moon twee</p>
              </div>
              <div class="lg:w-2/3 w-full mx-auto overflow-auto"> -->
          <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
              <tr>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">名前</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ステータス</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">著者</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">出版</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">読み終わった日</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メモ</th>
                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"></th>
                <!-- <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
              </tr> -->
            </thead>
            <tbody>
              @foreach($books as $book)
              <tr>
                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $book->id }}</td>
                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $book->name }}</td>
                <td class="border-t-2 border-gray-200 px-4 py-3">{{ App\Models\Book::BOOK_STATUS_OBJECT[$book->status] }}</td>
                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $book->author }}</td>
                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $book->publication }}</td>
                <!-- 日付のフォーマットを変える -->
                <td class="border-t-2 border-gray-200 px-4 py-3">{{ Carbon\Carbon::parse($book->read_at)->format('Y年n月j日') }}</td>
                <!-- 適切な長さで文字を区切る -->
                <td class="border-t-2 border-gray-200 px-4 py-3">{{ Str::limit($book->note, 40, $end='...') }}</td>
                <td class="border-t-2 border-gray-200 px-4 py-3">
                  <button onclick="location.href='/book/detail/{{ $book->id }}'" class="text-sm shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">詳細</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $books->links() }}

        </div>
      </div>
    </div>
  </div>
</x-app-layout>