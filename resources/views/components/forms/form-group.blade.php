<div class="md:flex md:justify-center mb-6">
  <div class="md:w-2/3">
    <label for="{{ $name }}" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">{{$label}}</label>

    {{$slot}}

    <input type="{{ isset($type) ? $type : 'text' }}" name="{{ $name }}" id={{$name}} class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue {{ $size ?? '' }}" placeholder="{{ isset($placeholder) ? $placeholder : '' }}" {{ isset($attributes) ? $attributes : '' }}>
    </div>

</div>
