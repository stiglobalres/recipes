@extends('layouts.app', ['title' => 'Tasty Recipe'])

@section('content')

<div class="w-full flex justify-center mt-4  ">
    <div class=" mb-4 w-147 mr-4  ">
        @include('partial.featured', ['featuredList'=> $featuredList])

        <div class="w-full mb-2" >
            <span class="text-lg text-color-lightgrey font-semibold ">{{ $creatorContentCarousel->name }}</span>
            @foreach($creatorContentCarousel->items as $key => $item)
                <div class="h-80 border shadow-lg my-6">
                    <img src="{{ $item->thumbnail_url }}" alt="{{ $item->thumbnail_alt_text }}" class="w-40  h-80 object-cover float-left mr-4" />
                    <div class="w-full py-4">
                        <a class="text-sm font-semibold  text-lime-600 text-ellipsis  overflow-hidden" href="{{ route('recipe',['title'=>str_replace(' ','-',strtolower($item->name)), 'id'=>$item->id ]) }}">{{ $item->name }}</a>
                        @include('partial.common.rating', ['user_ratings'=> $item->user_ratings])
                    </div>
                    
                    <div class="w-full pr-2">
                        <p class="text-sm leading-6"><?=$item->description ?></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class=" mb-2 ml-4   ">
        @include('partial.mealplan', ['mealPlanCarousel'=> $mealPlanCarousel])
    </div>
</div>





@include('partial.shoppable', ['shoppableCarousel'=>$shoppableCarousel])

@endsection
