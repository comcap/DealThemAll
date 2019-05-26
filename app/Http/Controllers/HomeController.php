<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Comment;
use App\Feed;
use App\Game;
use App\Like;
use App\StatsPlayer;
use App\Team;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()){
            $gameList = Game::get();

            $userRole = UserRole::join('tbl_Role','tbl_Role.role_ID','=','tbl_User_Role.role_ID')
                ->join('tbl_Game','tbl_Game.game_ID','=','tbl_User_Role.game_ID')
                ->where('user_ID','=',Auth::user()->user_ID)
                ->where('stateRole','>',0)
                ->limit(2)
                ->get();

            $countStats= StatsPlayer::where('user_ID','=',Auth::user()->user_ID)->count();

            $feeds = Feed::select('*','tbl_feed.updated_at','tbl_feed.created_at')
                    ->join('tbl_User','tbl_User.user_ID','=','tbl_feed.user_ID')
                    ->join('tbl_Game','tbl_Game.game_ID','=','tbl_feed.game_ID')
                    ->orderBy('tbl_feed.created_at','desc')
                    ->get();

            $asset = Asset::get();

            $result = $feeds->map(function ($item,$key) use ($asset){
                $orders = $asset->filter(function ($value, $key) use ($item){
                    return $value->post_ID == $item->post_ID;
                });

                $item->imagePath = $orders->values();

                return $item;
            });

//            ->join('tbl_asset','tbl_asset.post_ID','=','tbl_feed.post_ID')
//            return $result;
            $listComment = Comment::select('*','tbl_comment.created_at')->join('tbl_User','tbl_User.user_ID','=','tbl_comment.user_ID')
                ->get()->groupBy('post_ID');
            $listComment = ['data'=>$listComment];

            $getLike = Like::select('post_ID',DB::raw('count(post_ID) as total'))->where('state','=',1)->groupBy('post_ID')->get()->keyBy('post_ID');
            $getLike = ['data'=>$getLike];

            $stateLike = Like::select('post_ID','state')->where('user_ID','=',1)->where('state','=',1)->get()->groupBy('post_ID');

//            return $getLike;

//            $getPubg = json_decode(file_get_contents(public_path('mockup/getPubg.json')));
//            $getOverWatch = json_decode(file_get_contents(public_path('mockup/getOverWatch.json')));

            $arr = [];
            if (Auth::user()->steam_ID != null){
                $getPubg = $this->getPubg(Auth::user()->steam_ID);

                foreach ($getPubg as $value){
                    array_push($arr,collect(["title"=>$value['displayName'],"description"=>$value['description'],"thumbnail"=>$value['icon'],"value"=>$value['defaultvalue']]));
                }
            }

            if (Auth::user()->battlenet_ID != null){
                $getOverWatch = $this->getOverWatch(Auth::user()->battlenet_ID);

                foreach ($getOverWatch as $value){
                    array_push($arr,collect(["title"=>$value['title'],"description"=>$value['description'],"thumbnail"=>$value['thumbnail'],"value"=>$value['acquired']]));
                }
            }

            $fill = collect($arr)->filter(function ($item){
                return $item['value'] == false || $item['value'] == 0;
            });

            $count = collect($arr)->filter(function ($item){
                return $item['value'] == true || $item['value'] > 0;
            })->count();


            if (count($fill)>0){
                if (count($fill)>4){
                    $result = $fill->random(4);
                }else{
                    $result = $fill;
                }
            }else{
                $result = [];
            }

            return view('pages.home',compact('stateLike','getLike','listComment','gameList','userRole','countStats','feeds','count','result'));
        }else{
            $feeds = Feed::select('*','tbl_feed.updated_at','tbl_feed.created_at')
                ->join('tbl_User','tbl_User.user_ID','=','tbl_feed.user_ID')
                ->join('tbl_Game','tbl_Game.game_ID','=','tbl_feed.game_ID')
                ->orderBy('tbl_feed.created_at','desc')
                ->get();

            $asset = Asset::get();

            $result = $feeds->map(function ($item,$key) use ($asset){
                $orders = $asset->filter(function ($value, $key) use ($item){
                    return $value->post_ID == $item->post_ID;
                });

                $item->imagePath = $orders->values();

                return $item;
            });

            $listComment = Comment::select('*','tbl_comment.created_at')->join('tbl_User','tbl_User.user_ID','=','tbl_comment.user_ID')
                ->get()->groupBy('post_ID');
            $listComment = ['data'=>$listComment];

            $getLike = Like::select('post_ID',DB::raw('count(post_ID) as total'))->where('state','=',1)->groupBy('post_ID')->get()->keyBy('post_ID');
            $getLike = ['data'=>$getLike];

            return view('pages.home',compact('getLike','listComment','feeds'));
        }

    }

    public function store(Request $request){
        if (isset($request)){
            if ($request->type == "comment"){
                $postID = $request->postID;
                $text = $request->text;
                $userID = $request->userID;

                $comment = new Comment();
                $comment->user_ID = $userID;
                $comment->post_ID = $postID;
                $comment->textMessage =$text;
                $comment->save();

                $listComment = Comment::select('tbl_comment.post_ID','tbl_User.user_ID','tbl_User.user_image','tbl_User.user_name','tbl_comment.textMessage','tbl_comment.created_at')
                    ->join('tbl_User','tbl_User.user_ID','=','tbl_comment.user_ID')
                    ->where('post_ID','=',$postID)
                    ->get();

                return $listComment;
            }else{
                $postID = $request->postID;
                $userID = $request->userID;

                $getLike = Like::where('post_ID','=',$postID)->where('user_ID','=',$userID)->first();

                if ($getLike == ""){
                    $like = new Like();
                    $like->post_ID = $postID;
                    $like->user_ID = $userID;
                    $like->state = 1;
                    $like->save();
                }else{
                    if ($getLike->state == 0){
                        Like::where('post_ID','=',$postID)->where('user_ID','=',$userID)
                            ->update(['state'=>1]);
                    }else{
                        Like::where('post_ID','=',$postID)->where('user_ID','=',$userID)
                            ->update(['state'=>0]);
                    }
                }

                $countLike = Like::where('post_ID','=',$postID)->where('state','=',1)->get()->count();

                return $countLike;
            }
        }else{
            return "error";
        }
    }

    function getPubg($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v2/?appid=578080&key=EBAC31D270D905749D75BEB0536CD423&steamid=".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Postman-Token: c07c310a-1b70-423c-bd4d-7985c4862d68",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response,true);
            $PlayerAchievement = $json['playerstats']['stats'];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v2/?appid=578080&key=EBAC31D270D905749D75BEB0536CD423",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Postman-Token: 6dbb2c16-fddf-4e76-8630-29d7b89eb0a3",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response,true);
            $Playerlist = $json['game']['availableGameStats']['achievements'];
            $PlayerlistID = $json['game']['availableGameStats']['stats'];
        }

        $collect = collect($Playerlist);
        $collectID = collect($PlayerlistID);

        $collectID = $collectID->map(function ($item)use ($PlayerAchievement){
            foreach ($PlayerAchievement as $value){
                if ($item['name'] == $value['name']){
                    $item['defaultvalue'] = $value['value'];
                }
            };
            return $item;
        });

        $result = $collect->map(function ($item,$index) use ($collectID){
            foreach ($collectID as $key => $value){
                if ($index == $key){
                    $item['defaultvalue'] = $value['defaultvalue'];
                }
            }
            return $item;
        });

        return $result;
    }
    function getOverWatch($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://owjs.ovh/overall/pc/us/".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Postman-Token: bb3af313-ad24-4496-9cb7-1c293a3587b2",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response,true);
            $PlayerAchievement = $json['achievements'];
        }

        return $PlayerAchievement;
    }
}
