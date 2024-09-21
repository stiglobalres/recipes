@if($featuredList)
<div class="p-6 py-4 border shadow-lg rounded-lg mb-6">
    <video controls class="float-right rounded-lg ms-1 h-72 w-56 " >
        <source src="<?=$featuredList->renditions[0]->url ?>" type="<?=$featuredList->renditions[0]->content_type?>">
    </video>

    <div class="mb-3 ">
        <span class="font-semibold px-4 py-1 bg-violet-800 text-white ">FEATURED</span>
    </div>

    <a class="text-sm font-semibold text-lime-600" href="<?= route('recipe',['title'=> str_replace(' ','-',strtolower($featuredList->name)), 'id'=> $featuredList->id  ]) ?>">{{ $featuredList->name }}</a>

    @include('partial.common.rating', ['user_ratings'=> $featuredList->user_ratings])
    
    <p class="text-sm antialiased my-4 leading-6"><?=$featuredList->description ?></p>

    <div class="flex">
        
        @include('partial.common.likes', ['val'=> $featuredList->user_ratings->count_positive])
        @include('partial.common.dislikes', ['val'=> $featuredList->user_ratings->count_negative])
    </div>
</div>
@endif