
<div class="basis-2/5 ">
    <div class="w-full">
        <label for="all" class="block text-gray-700 text-sm font-bold mb-2">{{$originTitle}}</label>
        <select name="origin_{{$name}}" id="origin_{{$name}}"
                class="form-multiselect shadow block w-full rounded mt-1" size="10" multiple>
            @foreach($origins as $origin)
                <option value="{{$origin->id}}">{{$origin->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="basis-1/5">
    <div class="flex flex-col">

        <button type="button" id="add"
                class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                onclick="moveElement('origin_{{$name}}', 'destination_{{$name}}')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
        </button>

        <button type="button" id="remove"
                class="bg-indigo-600 hover:bg-indigo-500 text-gray-200 font-bold py-2 my-2 text-center border border-indigo-700 rounded w-2/4 mx-auto"
                onclick="moveElement('destination_{{$name}}', 'origin_{{$name}}')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w46 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>

    </div>
</div>

<div class="basis-2/5">
    <label for="all" class="block text-gray-700 text-sm font-bold mb-2">{{$destinationTitle}}</label>
    <select name="destination_{{$name}}[]" id="destination_{{$name}}"
            class="form-multiselect shadow block rounded w-full mt-1" size="10" multiple>
        @foreach($destinations as $destination)
            <option value="{{$destination->id}}">{{$destination->name}}</option>
        @endforeach
    </select>
</div>

