<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ArticleCategoryDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Repositories\Contracts\ArticleCategoryInterface;
use App\Http\Requests\Article\UpdateArticleCategory;
use App\Http\Requests\Article\CreateArticleCategory;

class ArticleCategoryController extends Controller
{
    protected $articleCategoryRepository;

    public function __construct(ArticleCategoryInterface $articleCategoryRepository)
    {
        $this->middleware('auth');
        $this->articleCategoryRepository = $articleCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ArticleCategoryDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleCategoryDataTable $dataTable)
    {
        $categories = $this->articleCategoryRepository->getAll()->toTree();
        return $dataTable->render('admin.article-category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesTree = $this->articleCategoryRepository->getWithDepth();
        $categories = array();
        foreach ($categoriesTree as $item) {
            $categories[$item->id] = str_repeat('-', $item->depth) . $item->name;
        }
        return view('admin.article-category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateArticleCategory $req
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleCategory $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $this->articleCategoryRepository->store([
                'name' => $data['name'],
                'slug' => $req->input('slug')?\Str::slug($req->input('slug'), '-'):\Str::slug($data['name'], '-'),
                'parent_id' => $req->input('parent_id'),
                'image' =>  $data['image']
            ]);
            DB::commit();
            Session::flash('success', trans('message.create_article_category_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_article_category_error'));
            return redirect()->back();
        }
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
        $article_category = $this->articleCategoryRepository->getOneById($id);
        $categoriesTree = $this->articleCategoryRepository->getWithDepth();
        $categories = array();
        foreach ($categoriesTree as $item) {
            $categories[$item->id] = str_repeat('-', $item->depth) . $item->name;
        }
        return view('admin.article-category.update', compact('article_category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param UpdateArticleCategory $req
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateArticleCategory $req)
    {
        try {
            $data = $req->validated();
            $category = $this->articleCategoryRepository->getOneById($id);

            $category->name = $data['name'];
            $category->slug = $data['slug'];
            $category->parent_id = $req->input('parent_id');
            if (\request()->hasFile('image')) {
                $category->image = $this->articleCategoryRepository->saveFileUpload($data['image'],'images');
            }

            $category->save();
            Session::flash('success', trans('message.update_article_category_success'));
            return redirect()->route('admin.article-category.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_article_category_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->articleCategoryRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_article_category_success')
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param updateTree $request
     * @return \Illuminate\Http\Response
     */
    public function updateTree(Request $request)
    {
        $data = $request->data;
        $root = $this->articleCategoryRepository->getAll()->find(1);
        $this->articleCategoryRepository->updateTreeRebuild($root, $data);
        return response()->json($data);
    }
}
