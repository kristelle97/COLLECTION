@foreach (session('flash_notification', collect())->toArray() as $message)
        @php
            $classes = 'mb-4 rounded py-4 px-4';
            if ($message['level']=='success') {
                $classes .=  ' bg-green-200 text-green-700';
            }
            else if ($message['level']=='error'){
                $classes .=  ' bg-red-200 text-red-700';
            }

        @endphp
        
        <div class="{{$classes}}">
            {!! $message['message'] !!}
        </div>
@endforeach

{{ session()->forget('flash_notification') }}
