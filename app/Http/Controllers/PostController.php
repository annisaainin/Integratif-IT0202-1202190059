<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use DB;

class PostController extends Controller
{
    public function index(){
        $this->health();
        $this->asia();
        $this->europe();
        $posts = DB::select('select * from posts where image != ""');
        return view('post',['posts'=>$posts]);
    }

    public function health()
    {  
        $xml = simplexml_load_file("https://news.un.org/feed/subscribe/en/news/topic/health/feed/rss.xml");
        $i = 0;
        foreach ($xml->channel->item as $data) if ($i < 10){
            $values = array('id' => 0, 'title' => $data->title, 'link' => $data->link, 'image' => $data->enclosure['url'], 'description' => $data->description);
            DB::table('posts')->insert($values);     
            $i += 1;
        }
    }

    public function asia()
    {  
        $xml = simplexml_load_file("https://news.un.org/feed/subscribe/en/news/region/asia-pacific/feed/rss.xml");
       
        $i = 0;
        foreach ($xml->channel->item as $data) if ($i < 10){
            $values = array('id' => 0, 'title' => $data->title, 'link' => $data->link, 'image' => $data->img, 'description' => $data->description);       
            DB::table('posts')->insert($values);
            $i += 1;
        }
    }

    public function europe()
    {  
        $xml = simplexml_load_file("https://news.un.org/feed/subscribe/en/news/region/europe/feed/rss.xml");
        $i = 0;
        foreach ($xml->channel->item as $data) if ($i < 10){
            $values = array('id' => 0, 'title' => $data->title, 'link' => $data->link, 'image' => $data->enclosure['url'], 'description' => $data->description);
            DB::table('posts')->insert($values);     
            $i += 1;
        }
    }
    
}