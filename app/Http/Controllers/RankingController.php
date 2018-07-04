<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


use App\Item;

class RankingController extends Controller
{
    public function want()
    {
        $type = 'want';
        $types= title_case(str_plural($type));

        $items = \DB::table('item_user')->join('items', 'item_user.item_id', '=', 'items.id')->select('items.*', \DB::raw('COUNT(*) as count'))->where('type', $type)->groupBy('items.id', 'items.code', 'items.name', 'items.url', 'items.image_url', 'items.created_at', 'items.updated_at')->orderBy('count', 'DESC')->take(10)->get();

        return view('ranking.want', [
            'types' => $types ,
            'items' => $items,
        ]);
    }

    public function have()
    {
        $type = 'have';
        $types= title_case(str_plural($type));

        $items = \DB::table('item_user')->join('items', 'item_user.item_id', '=', 'items.id')->select('items.*', \DB::raw('COUNT(*) as count'))->where('type', $type)->groupBy('items.id', 'items.code', 'items.name', 'items.url', 'items.image_url', 'items.created_at', 'items.updated_at')->orderBy('count', 'DESC')->take(10)->get();


        return view('ranking.have', [
            'types' => $types,
            'items' => $items,
        ]);
    }
}
