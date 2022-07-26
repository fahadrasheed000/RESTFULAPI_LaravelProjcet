<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\CreateBlogRequest; //Laravel form validation class
use App\Http\Requests\UpdateBlogRequest; //Laravel form validation class
use JWTAuth;
use Auth;

class BlogController extends Controller
{
    function __construct()
    {
        $this->BlogModel = new Blog();
    }
    public function index()
    {
        try {
            $auth_check = JWTAuth::parseToken()->authenticate();
            if ($auth_check) {
                $BlogList = $this->BlogModel->getAllBlogs();;
                return apiResponse($BlogList, 'success', 'Successful', '', auth()->user());
            } else {
                return apiResponse(null, 'errors', 'Sorry, token is an invalid', '');
            }
        } catch (\Exception $e) {
            return apiResponse(null, 'errors', 'Sorry, token is an invalid', '');
        }
    }
    public function store(CreateBlogRequest $request)
    {

        try {
            $auth_check = JWTAuth::parseToken()->authenticate();
            if ($auth_check) {
                $response = $this->BlogModel->addBlog($request);

                if ($response) {
                    return apiResponse(null, 'success', 'Blog successfully added', '', auth()->user());
                } else {
                    return apiResponse(null, 'errors', 'Sorry, Invalid Information', '');
                }
            } else {
                return apiResponse(null, 'errors', 'Sorry, token is an invalid', '');
            }
        } catch (\Exception $e) {
            return apiResponse(null, 'errors', 'Sorry, token is an invalid', '');
        }
    }

    public function edit($id)
    {
        $result = $this->BlogModel->getBlogById($id);
        return response()->json($result);
    }


    public function update(UpdateBlogRequest $request, $BlogID)
    {
        try {
            $auth_check = JWTAuth::parseToken()->authenticate();
            if ($auth_check) {
                $response = $this->BlogModel->updateBlog($request, $BlogID);

                if ($response) {
                    return apiResponse(null, 'success', 'Blog successfully updated', '', auth()->user());
                } else {
                    return apiResponse(null, 'errors', 'Sorry, Invalid Information', '');
                }
            } else {
                return apiResponse(null, 'errors', 'Sorry, token is an invalid', '');
            }
        } catch (\Exception $e) {
            return apiResponse(null, 'errors', 'Sorry, token is an invalid', '');
        }
    }


    public function destroy($id)
    {
        try {
            $auth_check = JWTAuth::parseToken()->authenticate();
            if ($auth_check) {
                $response = $this->BlogModel->deleteBlog($id);
                if ($response) {
                    return apiResponse(null, 'success', 'Blog successfully deleted', '', auth()->user());
                } else {
                    return apiResponse(null, 'errors', 'Sorry, Invalid Information', '');
                }
            } else {
                return apiResponse(null, 'errors', 'Sorry, token is an invalid', '');
            }
        } catch (\Exception $e) {
            return apiResponse(null, 'errors', 'Sorry, token is an invalid', '');
        }
    }
}
