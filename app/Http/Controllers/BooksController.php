<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Freshbitsweb\Laratables\Laratables;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if(\Auth::check()){
            $keyword=$request->input('word');
            $query=Book::query();
            //検索結果
            $count=0;
            //ほんの冊数
            $totalNumber=0;
            if(!empty($keyword)){
                $query->where('book_display','LIKE',"%{$keyword}%");
                $books=$query->paginate(5);
                $count=$query->count();
                foreach($books as $book){
                    $totalNumber += $book->book_number;
                }
            }else{
                //本の一覧を取得
                $books=Book::orderBy('id','desc')->paginate(5);
                //ほんのカウント用
                $book_count=Book::all();
                foreach($book_count as $book){
                $totalNumber += $book->book_number;
                }
            }

            //ユーザー情報
            $user=\Auth::user();
            //一覧ビューで表示
            return view('books.index',[
                'user'=>$user,
                'keyword'=>$keyword,
                'books'=>$books,
                'count'=>$count,
                'number'=>$totalNumber,
            ]);
        }
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::check()){
            $book = new Book;
            $user=\Auth::user();

            //登録ビューを表示
            return view('books.create',[
               'book' => $book,
               'user'=>$user,
            ]);
        }else{
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::check()){
            //コミック新規登録
            $request->user()->books()->create([
                'book_title'=>$request->book_title,
                'book_display'=>$request->book_display,
                'book_number'=>$request->book_number,
                'book_isbn'=>$request->book_isbn,
                'book_author'=>$request->book_author,
                'book_publisher'=>$request->book_publisher,
                'book_coverURL'=>$request->book_coverURL,
            ]);
        }
        //トップページへリダイレクト
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //idの値でコミックを検索して取得
        $book = Book::findOrFail($id);
        if(\Auth::check()){
            if(\Auth::id()===$book->user_id){
                $user=\Auth::user();
                //詳細ビューで表示
                return view('books.show',[
                    'book' =>$book,
                    'user' => $user,
                ]);
            }
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //idの値でコミックを検索して取得
        $book = Book::findOrFail($id);
        if(\Auth::check()){
            $user=\Auth::user();
            if(\Auth::id()===$book->user_id){
                //表示
                return view('books.edit',[
                    'book' => $book,
                    'user' => $user,
                ]);            
            }
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //本の情報更新
    public function info_update(Request $request,$id){
        $book = Book::findOrFail($id);
        if(\Auth::check()){
            if(\Auth::id()===$book->user_id){
                //コミック情報を更新
                $book->book_title = $request->book_title;
                $book->book_isbn = $request->book_isbn;
                $book->book_author = $request->book_author;
                $book->book_publisher = $request->book_publisher;
                $book->book_coverURL = $request->book_coverURL;
                $book->book_display = $request->book_display;
                $book->book_number = $request->book_number;
                $book->save();
            }
        }
        return redirect('/');
    }
    //冊数の変更(ボタン)
    public function number_fluctuation_plus(Request $request,$id){
        $book=Book::findOrFail($id);
        if(\Auth::check()){
            if(\Auth::id()===$book->user_id){
                $book->book_number +=1;
                $book->save();
            }
        }
        return back();
    }
    public function number_fluctuation_minus(Request $request,$id){
        $book=Book::findOrFail($id);
        if(\Auth::check()){
            if(\Auth::id()===$book->user_id){
                if(0<$book->book_number){
                    $book->book_number -=1;
                    $book->save();                
                }
            }
        }
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //idの値でコミックを検索して取得
        $book = Book::findOrFail($id);
        if(\Auth::check()){
            //コミックを削除
            $book->delete();
        }
        //トップページへリダイレクト
        return redirect('/');
    }
}
