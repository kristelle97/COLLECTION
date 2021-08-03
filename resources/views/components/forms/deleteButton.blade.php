<form action="{{ $action }}" method="POST">
      @csrf
      @method('DELETE')
      <button class='bg-transparent text-gray-400 font-semibold hover:text-blue-800 py-2 px-2'>
        {{ $slot }}
      </button>
</form>
