<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\ArticlesModel;
use App\CategoryModel;
use Carbon\Carbon;
use Session;

class Articles extends Controller
{

    function createArticle()
    {
        $adminhome = Session::get('adminSession');
        if($adminhome)
        {
            $categories = CategoryModel::orderby('categoryName')->get();
            return view('createArticle')->with('categories',$categories);    
        } 
        else 
        {
            return view('Login');
        }
    }

    function saveArticle(Request $req)
    {
        $adminhome = Session::get('adminSession');
        if($adminhome)
        {
            if ($req->isMethod('post')) {
                $req->validate([
    
                    'title' => 'required',
                    'subtitle' => 'required',
                    'article' => 'required',
                    'image' => 'required'
                ]);
    
                $articles = new ArticlesModel;
                $articles->title = $req->title;
                $articles->subTitle = $req->subtitle;
                $articles->category = $req->category;
                $articles->article = $req->article;
                // $articles->dateTime = $req->dateTime;
    
                if($req->hasfile('image'))
                {
                    $file = $req->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $file->move('uploads/Articles/',$filename);
                    $articles->Image = $filename;
                }
                else
                {
                    return $articles;
                    $articles->Image = "";
                }

                $mytime = Carbon::now()->toDateTimeString();
                $articles->date = Carbon::parse($mytime)->format('F jS, Y');
    
                $articles->save();
                return redirect('createArticle')->with('flash_message_success', "Saved successfully");
            }
            $categories = CategoryModel::orderby('categoryName')->get();
            return view('createArticle')->with('categories',$categories);
        } 
        else 
        {
            return view('Login');
        }
    }

    function updateArticle(Request $req)
    {
        $adminhome = Session::get('adminSession');
        if($adminhome)
        {
            if ($req->isMethod('post')) {
                $req->validate([
    
                    'title' => 'required',
                    'article' => 'required'
                ]);
    
                $articles = ArticlesModel::find($req->id);
                $articles->title = $req->title;
                $articles->subTitle = $req->subtitle;
                $articles->category = $req->category;
                $articles->article = $req->article;
                // $articles->dateTime = $req->dateTime;
    
                if($req->hasfile('image'))
                {
                    $file = $req->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $file->move('uploads/Articles/',$filename);
                    $articles->Image = $filename;
                }
                else
                {
                    $articles->Image = $req->imageName;
                }
                $articles->save();
                $articles = ArticlesModel::orderby('id', 'DESC')->paginate(6);
                return redirect('createArticle')->with('flash_message_success', "Updated successfully"); 
            }
            $categories = CategoryModel::orderby('categoryName')->get();
            return view('createArticle')->with('categories',$categories);
        } 
        else 
        {
            return view('Login');
        }
    }

    function deleteArticle($id)
    {
        $adminhome = Session::get('adminSession');
        if($adminhome)
        {
            $articles = ArticlesModel::find($id);
            $articles->delete();

            $articles = ArticlesModel::orderby('id', 'DESC')->paginate(6);
            return redirect()->back()->with('flash_message_success', "Deleted successfully");
            return view('articleList')->with('articles',$articles);  
        } 
        else 
        {
            return view('Login');
        }
    }

    function articleList()
    {
        $adminhome = Session::get('adminSession');
        if($adminhome)
        {
            $articles = ArticlesModel::orderby('id', 'DESC')->paginate(6);
            return view('articleList')->with('articles',$articles); 
        } 
        else 
        {
            return view('Login');
        }
    }

    function getArticleWithID($id)
    {
        $adminhome = Session::get('adminSession');
        if($adminhome)
        {
            $articles = ArticlesModel::find($id);
            $categories = CategoryModel::orderby('categoryName')->get();
            return view('editArticle')->with(compact('articles','categories'));
        } 
        else 
        {
            return view('Login');
        }
    }
}
