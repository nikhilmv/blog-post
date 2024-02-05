<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Support\Str;
use DataTables;
use Yajra\DataTables\Html\Builder;


class PostsController extends Controller
{
    /**
     * Display a category listing of the resource.
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin/post/index' );

    }

    public function getPostData()
    {

        $data = Post::orderBy('id','DESC');
        return Datatables::of($data)
                ->addIndexColumn()

                ->editColumn('name',function($row){
                    return $row->name;
                })        ->editColumn('date',function($row){
                    return $row->date;
                })        ->editColumn('author',function($row){
                    return $row->author;
                })
                ->addColumn('action', function ($row) {
                    $buttons = "";

                        $buttons .='<button type="button" class="btn btn-icon btn-info btn-sm" title="Edit" onclick="window.location.href=\''. route('admin.post.edit', $row->id) .'\'">edit </button> ';

                        $buttons .='<button type="button" class="btn btn-icon btn-danger btn-sm" title="Delete" data-toggle="modal" data-target="#danger-alert-modal" onclick="deleteForm(\'delete-form'.$row->id.'\')">delete </button><form id="delete-form'.$row->id.'" method="post" action="'.route("admin.post.destroy", $row->id).'"><input type="hidden" name="_method" value="delete"><input type="hidden" name="_token"  value="'.csrf_token().'"></form>';


                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);

    return view('admin/post/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/post/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {

        if($request->edit_id == null){

            $post = new Post();
            $post->name = $request->name;
            $post->author = $request->author;
            $post->date = $request->date;
            $post->content = $request->content;

            // Image store code
            if ($image = $request->file('image')) {
                $destinationPath = 'post-image/';
                $profileImage = $uniqueSlug . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $post->image = $profileImage;
            }

            $post->save();
            return response()->json(["status_code" => 200, "message" => "Post created successfully"]);
        }
        if($request->edit_id != null){

            $post = Post::find($request->edit_id);
            $post->name = $request->name;
            $post->author = $request->author;
            $post->date = $request->date;
            $post->content = $request->content;

            // Image update code
            if ($image = $request->file('image')) {
                // Unlink the old image
                $oldImage = $post->image;
                $image_path = public_path('post-image/' . $oldImage);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                // Add the new image
                $destinationPath = 'post-image/';
                $profileImage = $uniqueSlug . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $post->image = $profileImage;
            }

            $post->save();
            return response()->json(["status_code" => 200, "message" => "Post updated successfully"]);
        }


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Post::where('id',$id)->first();
        return view('admin.post.edit',compact('data'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request)
    {



    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Post $post)
    {
        $post = Post::where('id',$post->id)->first();

        // Unlink the old image
        $oldImage = $post->logo;
        if($oldImage != null){
            $image_path = public_path('post-image/' . $oldImage);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $post->delete();
        return redirect()->route('admin.post.index')->with('error','Post deleted successfully.');
    }
}
