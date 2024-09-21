<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Request\feedsRequest;

class IndexController extends Controller {

    protected $requestApi;
    public function __construct(feedsRequest $requestApi)
    {
       $this->requestApi = $requestApi;
    }

    public function index() 
    {
       
        $data = array(
            'size' =>5,
            'timezone' => '%2B0700',
            'vegetarian' => false,
            'from' => 0
        );

        $this->requestApi->feedsList($data);
        $featuredList = $this->requestApi->getFeaturedList();
        $mealPlanCarousel = $this->requestApi->getMealPlanCarousel();
        $creatorContentCarousel = $this->requestApi->getCreatorContentCarousel();
        $shoppableCarousel = $this->requestApi->getShoppableCarousel();

        return view('index', compact('featuredList', 'mealPlanCarousel', 'creatorContentCarousel','shoppableCarousel'));
    }

    public function recipe(Request $request )
    {

        $result = $this->requestApi->recipeInfo($request->id);

        $ingredients = $this->requestApi->getIngredients();

        return view('recipe', compact('result','ingredients'));
    }
}
