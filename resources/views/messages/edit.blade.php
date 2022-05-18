<x-app-layout title="Missatges amb {{$otherUser->name}}">
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-100">
                    <div clase="h-full overflow-hidden py-4">
                        <div class="grid grid-cols-12 gap-y-2">
                            @foreach($messages as $message)
                                @if ($message->user_from == $myUser->id)
                                    <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                        <div class="flex items-center justify-start flex-row-reverse">
                                            <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                @else
                                    <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                        <div class="flex flex-row items-center">
                                            <div
                                                class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                @endif
                                                <div>
                                                    <p>{{$message->content}}</p>
                                                    <p class="italic">{{$message->created_at->format('d/m/Y H:i')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                <form method="POST" action={{ route('messages.store')}}>
                    @csrf
                    <input type="hidden" id="otherid" name="otherid" value="{{$otherUser->id}}">

                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Nou missatge</label>
                        <textarea id="content" name="content" placeholder="Escriu un missatge" rows="4"
                               class="from-control block w-full text-base resize-none shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    </div>
                    <div class="mb-4">
                        <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 px-4 border border-indigo-700 rounded">
                            Desar
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
