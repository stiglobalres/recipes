@if(count(Request::segments()))
<a class="text-sm underline font-semibold" href="{{ route('home') }}">Home</a>
    @for($x = 1; $x < count(Request::segments()); $x++)
        @if($x < count(Request::segments()) & $x > 0)
            <span class="text-sm font-semibold"> / </span>
            @if(!in_array(Request::segment($x) , ['home']))
                <span class="text-sm font-semibold" >{{ ucwords(str_replace('-',' ',Request::segment($x)))}}</span>
            @else
                <a class="text-sm underline font-semibold" href="{{  Request::segment($x) }}">{{ ucwords(str_replace('-',' ',Request::segment($x)))}}</a>
            @endif
        @else 
            <span class="text-sm font-semibold" >{{ ucwords(str_replace('-',' ',Request::segment($x)))}}</span>
        @endif
    @endfor
</div>
@endif