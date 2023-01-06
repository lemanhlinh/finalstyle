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
        return $dataTable->render('admin.article-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article-category.create');
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
            $this->articleCategoryRepository->store($data);
            DB::commit();
            Session::flash('success', trans('message.create_question_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_question_error'));
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

        return view('admin.article-category.update', compact('article_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
