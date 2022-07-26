<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $fillable = ['title', 'content'];


    //===Implementation of Dynamic datatable.
    function getAllBlogs()
    {
        $getData = Blog::select('id','title','content')->orderBy('id', 'ASC')->get();
        return $getData;
    }
    public function addBlog($request)
    {
        try {
            $data = array(
                'title'   =>  $request->title,
                'content' =>  $request->content
            );
            Blog::create($data);
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getBlogById($id)
    {

        $Blog = Blog::where('id', $id)->get(['*']);
        return $Blog;
    }

    public function updateBlog($request, $BlogID)
    {
        try {
            $exist=Blog::select('id')->where('id',$BlogID)->get();
            if(count($exist)>0){
            $data = array(
                'title'   =>  $request->title,
                'content' =>  $request->content
            );
            $updateOrder = Blog::find($BlogID)->update($data);

            if (!$updateOrder) {
                return false;
            } else {
                return true;
            }
        }else{
            return false;
        }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteBlog($id)
    {
        try {
            Blog::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
