@if($mealPlanCarousel)

<div class="shadow-lg border w-96 mb-2 rounded-lg py-4">
    <div class="w-full px-4 flex justify-between">
        <span class="text-lg font-semibold text-color-lightgrey overflow-hidden text-ellipsis  text-nowrap ">{{ $mealPlanCarousel->name  }}</span>

    </div>
    
    <div class="px-4 " >
        <div class="w-full grid grid-cols-1 divide-y divide-gray-200 ">
            @foreach($mealPlanCarousel->items as $key => $item )
                <div class=" w-full py-2">
                    
                    <p class="text-sm font-semibold ">{{ $item->name }}</p>
                    <img class=" w-40 h-max float-left rounded-lg border shadow-md mr-2 my-3" src="{{  $item->thumbnail_urls[0] }}" alt="{{ $item->name }}" />
                    
                    <p class="text-sm antialiased my-4 leading-6"><?=$item->description ?></p>
                    <p class=" text-xs mt-2 antialiased">{{  date('d M Y, h:i A', $item->updated_at)  }}</p>
                
                </div>
               
            @endforeach
        </div>
    </div>
</div>

@endif