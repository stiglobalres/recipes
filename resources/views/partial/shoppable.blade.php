<div class="w-full   ">
    <span class="text-lg text-color-lightgrey font-semibold "> {{ $shoppableCarousel->name }} </span>
    <div class="w-full flex flex-wrap justify-between mt-4">
    @foreach($shoppableCarousel->items as $key => $item)
       
            <div class=" w-vw-26 mb-8 " >
                <video controls class="border rounded-lg mb-3" >
                    <source src="<?=$item->renditions[0]->url ?>" type="<?=$item->renditions[0]->content_type?>">
                </video>
                <a class="text-sm  font-semibold leading-6" href="{{ route('recipe',['title'=>$item->name , 'id'=>$item->id]) }}"> {{ $item->name }} </a>
            </div>
            
    @endforeach
        </div>
</div>