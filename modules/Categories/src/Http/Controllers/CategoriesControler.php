<?php

namespace modules\Categories\src\Http\Controllers;

use \App\Http\Controllers\Controller;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Hash;
use modules\Categories\src\Http\Requests\CategoryRequest;
use modules\Categories\src\Repositories\CategoriesRepository;
use Yajra\DataTables\Facades\DataTables;

use modules\Categories\src\Models\Category;
use function Symfony\Component\String\u;


class  CategoriesControler extends Controller
{

    protected $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)

    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index()
    {
        $pageTitle = 'Quản lý danh mục';
        $allUser = $this->categoriesRepository->getAll();
        return view('Categories::list', compact('pageTitle', 'allUser'));
    }

    public function data()
    {
        $categaries = $this->categoriesRepository->getCategories();

        return DataTables::of($categaries)
            ->editColumn('created_at', function ($category) {
                return $category->created_at->format('d/m/Y H:i');
            })
            ->addColumn('link', function ($category) {
                return ' <a href="" class="btn btn-success">Xem</a>';
            })
            ->addColumn('edit', function ($category) {

                return ' <a href="' . route('admin.categories.edit', $category) . '" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function ($category) {
                return ' <a href="' . route('admin.categories.delete', $category) . '" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->rawColumns(['edit', 'delete', 'link'])
            ->toJson();
    }

    public function create()
    {
        $pageTitle = "Thêm danh muc";
        return view('Categories::add', compact('pageTitle'));
    }

    public function store(CategoryRequest $request)
    {
        $this->categoriesRepository->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,

        ]);
        return redirect()->route('admin.categories.index')->with('msg', __('Categories::messages.create.success'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->except(['_token']);

        $this->categoriesRepository->update($id, $data);
        return back()->with('msg', __('Categories::messages.update.success'));

    }

    public function edit($id)
    {
        $category = $this->categoriesRepository->find($id);

        if ($id) {
            $pageTitle = 'Sửa danh mục';
            return view('Categories::edit', compact('category', 'pageTitle'));
        } else {
            return redirect()->route('admin.categories.index');
        }
    }

    public function delete($id)
    {
        $this->categoriesRepository->delete($id);
        return redirect()->route('admin.categories.index')->with('msg', __('Categories::messages.delete.success'));
    }

}


