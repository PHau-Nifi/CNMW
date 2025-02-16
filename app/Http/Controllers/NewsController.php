<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class NewsController extends Controller
{
    function __construct(){
        $cloud_name = cloud_name();
        view()->share('cloud_name',$cloud_name);
    }

    public function news()
    {
        $news = News::orderBy('id', 'DESC')->Paginate(5);
        return view('admin.web.news.index', ['news' => $news]);
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'title' => 'required|min:1',
            'content' => 'required|min:1'
        ], [
            'title.required' => 'title is required',
            'content.required' => 'Content is required'
        ]);
        if($request->hasFile('Image')) {
            $file = $request->file('Image');
            $img = $request['image'] = $file;
            $cloud = Cloudinary::upload($img->getRealPath(), [
                'folder' => 'news',
                'format' => 'jpg',
            ])->getPublicId();
            $new = new News(
                [
                    'title' => $request->title,
                    'image' => $cloud,
                    'content' => $request->content
                ]);
            $new->save();
                if ($new) {
                    return redirect('/admin/news')->with('success', 'Tạo thành công!');
                }
                else{
                    return redirect('/admin/news')->with('fail', 'Tạo không thành công!');
                }
        }
        else if($request->image_url){
            $file = $request->image_url;
            $new = new News(
                [
                    'title' => $request->title,
                    'image' => $file,
                    'content' => $request->content
                ]);
            $new->save();
            if ($new) {
                return redirect('/admin/news')->with('success', 'Tạo thành công!');
            }
            else{
                return redirect('/admin/news')->with('fail', 'Tạo không thành công!');
            }
        }
        else{
            return redirect('/admin/news')->with('fail', 'File hình ảnh lỗi');
        }
        
    }
    public function postEdit(Request $request,$id)
    {
        $new = News::find($id);
        $request->validate([
            'title' => 'required|min:1',
            'content' => 'required|min:1'
        ], [
            'title.required' => 'title is required',
            'content.required' => 'Content is required'
        ]);
        if($request->hasFile('Image')) {
            $file = $request->file('Image');
            $img = $request['image'] = $file;
            if ($news['image'] != '') {
                Cloudinary::destroy($news['image']);
            }
            $cloud = Cloudinary::upload($img->getRealPath(), [
                'folder' => 'news',
                'format' => 'jpg',
            ])->getPublicId();
            $request['image'] = $cloud;
        }else if($request->image_url){
            $new->image = $request->image_url;
        }
        $new->title = $request->title;
        $new->content = $request->content;
        $new->save();
        return redirect('/admin/news')->with('success', 'Cập nhật thành công!');
        
    }

    public function delete($id)
    {
        $news = News::find($id);
        Cloudinary::destroy($news['image']);
        $news->delete();
        return response()->json(['success' => 'Delete Successfully']);
    }
    public function status(Request $request){
        $news = News::find($request->news_id);
        $news['status'] = $request->active;
        $news->save();
        return response('success',200);
    }

}
