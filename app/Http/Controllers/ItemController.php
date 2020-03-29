<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Item;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // if not using paginate add ->get() at the end
        $paginate = 5;
        $items = Item::with('tags')->where('user_id', auth()->id())->sortable()->paginate($paginate);


        if (request()->isMethod('get') && request()->has('tag')) {
            $tag = request()->input('tag');

            $items = Item::whereHas('tags', function ($query) use ($tag) {
                $query->where('tags.text', $tag);
            })
                ->where('user_id', auth()->id())
                ->sortable()
                ->paginate($paginate);
//            ->get();

//            dd($tag);
        }



//        dd($items);
//        $colors = $this->generateColors();

        return view('items.index', [
            'items' => $items,
//            'colors' => $colors,
        ]);
    }


    public function create()
    {
//        $message = '';
//        if (Session::has('message')) {
//            $message = Session::get('message');
//        } else {}

        $tags = Tag::all();


        return view('items.create', [
            'tags' => $tags,
            'session_message' => Session::get('message'),
        ]);
    }

    public function store(StoreItemRequest $request)
    {

//        $count = Tag::where('text', 'home1')->count();
//        dd($count);

        $data = $request->validated();

        // associate with user
        $user = User::find(auth()->id());
        $item = new Item;
        $item->fill($data);
        $item->owner()->associate($user);
        $item->save();

        // attach existing tags
        if (!empty($data['tags'])) {
            $tags = $data['tags'];
            foreach ($tags as $tag_id) {
                $tag = Tag::find($tag_id);
//            dd($tag);
                if ($tag) {
//                    $tag->items()->attach($item);
                    $tag->items()->syncWithoutDetaching($item->id);
                }
            }
        }

        // attach custom tags
        if (!empty($data['custom_tags'])) {

            $custom_tags = $this->formatCustomTags($data['custom_tags']);
//            dd($custom_tags);
            foreach ($custom_tags as $tag_text) {
                $tag = Tag::firstOrCreate([
                    'text' => $tag_text,
                ]);
//            dd($tag);
                if ($tag) {
//                    $tag->items()->attach($item);
                    $tag->items()->syncWithoutDetaching($item->id);
                }
            }
        }


        $request->session()->flash('message', [
            'status' => 1,
            'text' => 'The task added successfully'
        ]);

        return back();

    }

    public function done(Item $item)
    {
//        $id = $request->only('id');
//
//        $item = Item::where('id', $id)->first();

        $item->status = true;
        $item->save();
        return back();
    }

    public function undone(Item $item)
    {
        $item->status = false;
        $item->save();
        return back();
    }

    public function edit(Item $item)
    {


        $item = Item::with('tags')->where('id', $item->id)->first();

        $tags = Tag::all();
//        dd($item);
        return view('items.edit', [
            'item' => $item,
            'tags' => $tags,
            'session_message' => Session::get('message'),
        ]);
    }
    public function update(UpdateItemRequest $request, Item $item)
    {

        $data = $request->validated();

        // detach all tags
        $tags_ids = Tag::all('id');
        $item->tags()->detach($tags_ids);

        // existing tags
        if (!empty($data['tags'])) {
            $tags = $data['tags'];
            foreach ($tags as $tag_id) {
                $tag = Tag::find($tag_id);
                if ($tag) {
//                    $tag->items()->attach($item);
                    $tag->items()->syncWithoutDetaching($item->id);
                }
            }
        }

        // custom tags
        if (!empty($data['custom_tags'])) {
            $custom_tags = $this->formatCustomTags($data['custom_tags']);
            foreach ($custom_tags as $tag_text) {
                $tag = Tag::firstOrCreate([
                   'text' => $tag_text,
                ]);
                if ($tag) {
//                    $tag->items()->attach($item);
                    $tag->items()->syncWithoutDetaching($item->id);
                }
            }
        }

        $item->text = $data['text'];
        $item->save();

//        dd($data);

        $request->session()->flash('message', [
            'status' => 1,
            'text' => 'The task added successfully'
        ]);
        return back();
    }

    public function destroy(Item $item)
    {
//        $item = Item::find($item_id);
//        dd($item);
        $item->delete();
        return back();
    }

    public function sort(Request $request)
    {
        dd($request->all());
    }

    private function formatCustomTags($custom_tags_string)
    {
        $custom_tags_raw = explode(';', $custom_tags_string);

        // get rid of spaces in strings
        $custom_tags = [];
        foreach ($custom_tags_raw as $key => $tag_text) {
            if (strlen(str_replace(' ', '', $tag_text)) === 0) {
//                    unset($custom_tags[$key]);
                continue;
            }
            $custom_tags[] = str_replace(' ', '_', trim($tag_text));
        }

        return $custom_tags;
    }

    private function generateColors()
    {
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        $rand_color = [];
        for ($i = 1; $i <= 500; $i++) {
            $rand_color[] = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
        }
        return $rand_color;
    }
}
