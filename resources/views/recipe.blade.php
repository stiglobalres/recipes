@extends('layouts.app')

@section('title') {{ $result->seo_title }} @endsection

@section('meta')
    <meta property="description" content="{{ $result->keywords }}">
@endsection

@section('content')

<div class="w-full  mt-4  ">
    <span class="text-lg text-color-lightgrey font-semibold ">{{ $result->name }}</span>
</div>

@include('partial.common.rating', ['user_ratings'=> $result->user_ratings])

<div class="w-full  flex mt-4 ">
    <span class="text-sm text-color-lightgrey  ">By: </span>
    <div class="grid grid-cols-3 divide-x divide-gray-400 ">
        @foreach($result->credits as $key => $item)
            <div class="px-2 "><span class="text-sm text-color-lightgrey  ">{{ $item->name }}</span></div>
        @endforeach
        
    </div>
    
</div>

<div class=""><span class="text-sm text-color-lightgrey  "> Published on {{  date('M d, Y',$result->created_at)}}</span> </div>

<div class="w-full  mt-4  ">
    <p class="text-sm antialiased my-4 leading-6"><?=$result->description ?></p>
</div>

<div class="w-full  mt-4  ">
    <div class="w-full flex  ">

        <div class=" mb-2  w-99 ">
            <div class=" mb-2  ">
                <div class="w-full ">
                    <span class="text-sm text-color-lightgrey font-semibold ">Instructions:</span>
                </div>
                <div class="w-full mt-4 px-4">
                    <ul class="list-disc " >
                        @foreach($result->instructions as $key => $item)
                            <li class="text-sm leading-6"> {{  $item->display_text }}</li>
                        @endforeach
                    </ul>  
                </div>
            </div>
        </div> 
    
        <div class=" mb-2 ml-4  ">
            <div class=" mb-2 w-64 border p-2 rounded-lg">
                <div class="w-full ">
                    <span class="text-sm text-color-lightgrey font-semibold ">Ingredients:</span>
                </div>
                <div class="w-full mt-4 px-4">
                    <ul class="list-disc " >
                        @foreach($ingredients as $key => $name)
                            <li class="text-sm leading-6"> {{  $name }}</li>
                        @endforeach
                    </ul>  
                </div>
            </div>
        </div>

        <div class=" mb-2 ml-4   ">
            <div class="w-full flex justify-center ">
                <video controls class="float-right rounded-lg ms-1  w-56 ">
                    <source src="<?=$result->renditions[0]->url ?>" type="<?=$result->renditions[0]->content_type?>">
                </video>
            </div>
        </div>   

    </div>
</div>

@endsection