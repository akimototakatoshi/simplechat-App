<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$user_identifier = $request->session()->get('user_identifier', Str::random(20));
        //session(['user_identifier' => $user_identifier]);  
        
        //ユーザー識別子がなければランダムに生成してセッションに登録
        if($request->session()->missing('user_identifier')){session(['user_identifier' => Str::ramdom(20)]);}
        
       //ユーザー名を変数に登録（デフォルト時：Guest）
       //$user_name = $request->session()->get('user_name', 'Guest');
       if($request->session()->missing('user_name')){session(['user_name' => 'Guest']); }

        //データベースの件数を取得 
       $length = Chat::all()->count();

       //表示する件数を代入する
       $display = 5;

      $chats = Chat::offset($length-$display)->limit($display)->get();
      //チャットをビューに渡して表示
      return view('chat/index', compact('chats'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ユーザー名を取得、セッションに登録
        session(['user_name'=>$request->user_name]);

        $chat = new Chat;
        $form = $request->all();
        $chat->fill($form)->save();
        return redirect('/chat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
