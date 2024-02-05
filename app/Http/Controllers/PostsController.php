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

    public function getCompanyData()
    {

        $data = Company::orderBy('id','DESC');
        return Datatables::of($data)
                ->addIndexColumn()

                ->editColumn('company_name',function($row){
                    return $row->name;
                })        ->editColumn('email',function($row){
                    return $row->email;
                })        ->editColumn('website',function($row){
                    return $row->website;
                })
                ->addColumn('action', function ($row) {
                    $buttons = "";

                        $buttons .='<button type="button" class="btn btn-icon btn-info btn-sm" title="Edit" onclick="window.location.href=\''. route('admin.company.edit', $row->id) .'\'">edit </button> ';

                        $buttons .='<button type="button" class="btn btn-icon btn-danger btn-sm" title="Delete" data-toggle="modal" data-target="#danger-alert-modal" onclick="deleteForm(\'delete-form'.$row->id.'\')">delete </button><form id="delete-form'.$row->id.'" method="post" action="'.route("admin.company.destroy", $row->id).'"><input type="hidden" name="_method" value="delete"><input type="hidden" name="_token"  value="'.csrf_token().'"></form>';


                    return $buttons;
                })
                ->rawColumns(['action','logo'])
                ->make(true);

    return view('admin/company/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/company/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {

        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required',
            'website' =>  'required',
            'logo' =>  'required',
        ]);
        $baseSlug = Str::slug($request->name);
        $uniqueSlug = $baseSlug;

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        // Image store code
        if ($image = $request->file('logo')) {
            $destinationPath = 'company-image/';
            $profileImage = $uniqueSlug . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $company->logo = $profileImage;
        }

        $company->save();
        return redirect()->route('admin.company.index')->with('success','company created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Company::where('id',$id)->first();
        return view('admin.company.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'email'=>'required',
            'website' =>  'required',
        ]);

        $baseSlug = Str::slug($request->name);
        $uniqueSlug = $baseSlug;


        $company = Company::find($request->edit_id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        // Image update code
        if ($image = $request->file('logo')) {
            // Unlink the old image
            $oldImage = $company->logo;
            $image_path = public_path('company-image/' . $oldImage);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            // Add the new image
            $destinationPath = 'company-image/';
            $profileImage = $uniqueSlug . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $company->image = $profileImage;
        }

        $company->save();
        return redirect()->route('admin.company.index')->with('info', 'Company updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Company $company)
    {
        $company = company::where('id',$company->id)->first();

        // Unlink the old image
        $oldImage = $company->logo;
        if($oldImage != null){
            $image_path = public_path('company-image/' . $oldImage);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $company->delete();
        return redirect()->route('admin.company.index')->with('error','Company deleted successfully.');
    }
}
