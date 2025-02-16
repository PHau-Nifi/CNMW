<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\Rating;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    function __construct(){
        $cloud_name = cloud_name();
        view()->share('cloud_name',$cloud_name);
    }
    public function movie()
    {
        $movies = Movie::orderBy('id', 'DESC')->Paginate(3);
        return view('admin.web.movies.index', ['movies' => $movies]);
    }

    public function getCreate()
    {
        $rating = Rating::all();
        $movieGenres = MovieGenre::get()->where('status',1);
        return view('admin.web.movies.create', [
            'movieGenres' => $movieGenres,
            'rating' => $rating
        ]);
    }

    public function postCreate(Request $request)
    {

        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $img = $request['image'] = $file;
            $cloud = Cloudinary::upload($img->getRealPath(), [
                'folder' => 'movies',
                'format' => 'jpg',
            ])->getPublicId();
            $movie = new Movie(
                [
                    'name' => $request->name,
                    'image' => $cloud,
                    'showTime' => $request->showTime,
                    'releaseDate' => $request->releaseDate,
                    'endDate' => $request->endDate,
                    'director' => $request->director,
                    'cast' => $request->cast,
                    'national' => $request->national,
                    'rating_id' => $request->rating,
                    'description' => $request->description,
                    'trailer'=> $request->trailer
                ]
            );
            $movie->save();
            $movieGenres = MovieGenre::find($request->movieGenres);
            $movie->movieGenres()->attach($movieGenres);
        }else{
            return redirect('admin/movie')->with('warning','Vui lòng nhập hình ảnh');
        }
        return redirect('admin/movie');
    }

    public function getEdit($id)
    {
        $movieGenres = MovieGenre::all();
        $rating = Rating::all();
        $movie = Movie::find($id);
        return view('admin.web.movies.edit', ['movie' => $movie,
            'movieGenres' => $movieGenres,
            'rating' => $rating]);
    }

    public function postEdit(Request $request, $id)
    {

        $movie = Movie::find($id);
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $img = $request['image'] = $file;
            if ($movie['image'] != '') {
                Cloudinary::destroy($movie['image']);
            }
            $cloud = Cloudinary::upload($img->getRealPath(), [
                'folder' => 'movies',
                'format' => 'jpg',
            ])->getPublicId();
            $movie['image'] = $cloud;
        }
        $movie['director'] = $request['director'];
        $movie['cast'] = $request['cast'];
        $movie['name'] = $request['name'];
        $movie['showTime'] = $request['showTime'];
        $movie['releaseDate'] = $request['releaseDate'];
        $movie['endDate'] = $request['endDate'];
        $movie['national'] = $request['national'];
        $movie['description'] = $request['description'];
        $movie['trailer'] = $request['trailer'];
        $movie['rating_id'] = $request['rating'];

        $movie->update();

        $movieGenres = MovieGenre::find($request->movieGenres);
        $movie->movieGenres()->detach();
        $movie->movieGenres()->attach($movieGenres);


        return redirect('admin/movie')->with('success', "Cập nhật thành công!");
    }

    public function delete($id)
    {
        $movie = Movie::find($id);
        Cloudinary::destroy($movie['image']);
        $movie->delete();
        return response()->json(['success' => 'Xóa thành công!']);
    }

    public function status(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $movie['status'] = $request->active;
        $movie->save();
        return response('success',200);
    }

    public function movieGenre()
    {
        $movieGenres = MovieGenre::orderBy('id', 'DESC')->Paginate(5);
        $rating = Rating::all();
        return view('admin.web.Movie_genres.index', 
        [
            'movieGenres' => $movieGenres,
            'rating' => $rating
        ]);
    }

    public function postEditMovieGenre(Request $request, $id)
    {
        $movieGenres = movieGenre::find($id);
    
        $movieGenres['name'] = $request['name'];
        $movieGenres->update();
        return redirect('admin/movie/moviegenre')->with('success', "Cập nhật thành công!");
    }

    public function postCreateMovieGenre(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1',
        ], [
            'name.required' => 'name is required',
        ]);
        $movieGenres = new movieGenre([
            'name' => $request->name,
        ]);
        $movieGenres->save();
        if($movieGenres){
            return redirect('admin/movie/moviegenre')->with('success', "Thành công!");
        }
        else{
            return redirect('admin/movie/moviegenre')->with('fail', "Thất bại");
        }
    }
    public function deleteMovieGenre($id)
    {
        $movieGenres = movieGenre::find($id);
        $movieGenres->delete();
        return response()->json(['success' => 'Xóa thành công!']);
    }

    public function statusMovieGenre(Request $request)
    {
        $movieGenre = movieGenre::find($request->movieGenres_id);
        $movieGenre['status'] = $request->active;
        $movieGenre->save();
        return response('success',200);
    }

    public function postEditRating(Request $request, $id)
    {
        $rating = Rating::find($id);
    
        $rating['name'] = $request['name'];
        $rating['description'] = $request['description'];
        $rating->update();
        return redirect('admin/movie/moviegenre')->with('success', "Cập nhật thành công!");
    }

    public function postCreateRating(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1',
            'description' => 'required'
        ], [
            'name.required' => 'name is required',
            'description.required' => 'description is required',
        ]);
        $rating = new Rating([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $rating->save();
        if($rating){
            return redirect('admin/movie/moviegenre')->with('success', "Thành công!");
        }
        else{
            return redirect('admin/movie/moviegenre')->with('fail', "Thất bại");
        }
    }
    public function deleteRating($id)
    {
        $rating = Rating::find($id);
        $rating->delete();
        return response()->json(['success' => 'Xóa thành công!']);
    }
}
