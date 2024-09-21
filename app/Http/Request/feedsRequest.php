<?php
namespace App\Http\Request;

use App\Http\Common\curl;
use Illuminate\Support\Facades\Cache;

class feedsRequest {

    protected $curlRequest;
    
    //feeds api
    public const FEED_LIST_API ='feeds/list';
    public const RECIPE_DETAILS_API ='recipes/get-more-info';

    //cache name
    public const FEED_NAME_FEEDLIST = 'feeds-list';
    public const RECIPE_INFO = 'recipe-info';

    //feeds-list type
    protected const FEED_LIST_TYPE_FEATURES = 'featured';
    protected const FEED_LIST_TYPE_MEAL_PLAN = 'meal_plan_carousel';
    protected const FEED_LIST_TYPE_CREATOR_CONTENT = 'creator_content_carousel';
    protected const FEED_LIST_TYPE_SHOPPABLE = 'shoppable_carousel';
    protected const FEED_LIST_TYPE_CAROUSEL = 'carousel';

    protected $featuredLists =[];
    protected $mealPlanCarousel =[];
    protected $creatorContentCarousel =[];
    protected $shoppableCarousel =[];

    protected $ingredients =[];

    public function __construct(curl $curlRequest)
    {
        $this->curlRequest = $curlRequest;
    }

    public function feedsList($data=[]) 
    {
        if (Cache::has($this::FEED_NAME_FEEDLIST)) 
        {
            $return = Cache::get($this::FEED_NAME_FEEDLIST);
            $this->processFeedListData($return);
        }
        else
        {
            $path =$this::FEED_LIST_API.'?'.http_build_query($data);
            $return = $this->curlRequest->getRapid($path);  
            Cache::put( $this::FEED_NAME_FEEDLIST, $return, now()->addDays(1));
            $this->processFeedListData($return);
        }
    }

    public function recipeInfo($id)
    {
        $cacheName = $this::RECIPE_INFO.'-'.$id;
        if(Cache::has($cacheName))
        {
            $return = Cache::get($cacheName);
            $this->processRecipeData($return);
            return json_decode($return);
        }
        else
        {
            $path = $this::RECIPE_DETAILS_API.'?id='.$id;
            $return = $this->curlRequest->getRapid($path);
            Cache::put($cacheName, $return, now()->addDays(1));
            $this->processRecipeData($return);
            return json_decode($return);
        }
    }

    public function processFeedListData($data)
    {
        if(!$data) 
        {
            abort(404);
        }

        $return = json_decode($data);   
    
        if(isset($return->results))
        {
            $results = $return->results;
            foreach($results as $key => $item)
            {
                switch($item->type)
                {
                    case $this::FEED_LIST_TYPE_FEATURES:
                        $this->featuredLists = $item->item;
                        break;
                    case $this::FEED_LIST_TYPE_MEAL_PLAN:
                        $this->mealPlanCarousel = $item;
                        break;
                    case $this::FEED_LIST_TYPE_CREATOR_CONTENT:
                        $this->creatorContentCarousel = $item;
                        break;
                    case $this::FEED_LIST_TYPE_SHOPPABLE:
                        $this->shoppableCarousel = $item;
                        break;
                    case $this::FEED_LIST_TYPE_CAROUSEL:
                        break;    
                }
            }
        }
    }

    public function processRecipeData($data)
    {
        if(!$data) 
        {
            abort(404);
        }
        $recipes=[];
        $return = json_decode($data);   

            foreach($return->sections as $key => $item) {
                foreach($item->components as $key2 => $item2) {
                    $recipes[] = $item2->raw_text;
                }
            }
    
        $this->ingredients = $recipes;
    }

    public function getFeaturedList()
    {
        return  $this->featuredLists;
    }

    public function getMealPlanCarousel()
    {
        return  $this->mealPlanCarousel;
    }

    public function getCreatorContentCarousel()
    {
        return  $this->creatorContentCarousel;
    }

    public function getShoppableCarousel()
    {
        return $this->shoppableCarousel;
    }

    public function getIngredients()
    {
        return $this->ingredients;
    }



}