<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use TCG\Voyager\Facades\Voyager;

class MenuApiController extends Controller
{
    /**
     * Get menu items by menu name
     *
     * @return \Illuminate\Http\Response
     */
    public function getMenu(Request $request, $name)
    {
        $result = Cache::rememberForever('api_menu_'.$name. '_'.getCurrentLocale(), function() use ($name) {
            $result =[];
            $items= Voyager::model('MenuItem')->whereHas('menu', function($query) use ($name){
                return $query->where('name', $name);
            })->whereNull('parent_id')->orderBy('order')->with('children')->get()->translate();

            foreach ($items as $item){
                $result[] = [
                    'title' => $item->title,
                    'icon_class' => $item->icon_class,
                    'link' => $item->link(),
                    'color' => $item->color,
                    'is_mega' => $item->is_mega,
                    'mega_option' => json_decode($item->mega_option),
                    'children' => $this->getChildMenuItems($item->id)
                ];
            }
            return $result;
        });
        return response()->json($result, 200);
    }

    private function getChildMenuItems($menuId){
        $items = Cache::rememberForever('api_child_menus' . $menuId. '_'.getCurrentLocale(), function() use ($menuId) {
            $children = [];
            $items = Voyager::model('MenuItem')->where('parent_id', $menuId)->orderBy('order')->get()->translate();
            foreach ($items as $item){
                $children[] = [
                    'title' => $item->title,
                    'icon_class' => $item->icon_class,
                    'link' => $item->link(),
                    'color' => $item->color,
                    'children' => $this->getChildMenuItems($item->id)
                ];
            }
            return $children;
        });
        return $items;
    }
}
