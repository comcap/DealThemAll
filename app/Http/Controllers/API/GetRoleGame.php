<?php

namespace App\Http\Controllers\API;

use App\GameRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetRoleGame extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "opp not found";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gameRole = GameRole::select('tbl_Game_role.game_ID','tbl_Game_role.typeID','game_name','game_logo','typeName','type_Image')
            ->join('tbl_Game','tbl_Game.game_ID','=','tbl_Game_role.game_ID')
            ->join('tbl_Role_type','tbl_Role_type.typeID','=','tbl_Game_role.typeID')
            ->where('tbl_Game_role.game_ID',"=",$id)
            ->get();

        return $gameRole;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
