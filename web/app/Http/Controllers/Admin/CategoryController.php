<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Response;
use App\Category;
use App\Services\Category as CategoryService;
use Illuminate\Support\Facades\Log;
use Throwable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CategoryService $categoryService
     *
     * @return Response
     */
    public function index(CategoryService $categoryService)
    {
        return view('admin.categories.home', [
            'data' => $categoryService->getAll()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     *
     * @return Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.view', [
            'category' => $category,
            'isView' => true,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $category = null;

        return view('admin.categories.new', [
            'category' => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest $request
     * @param  CategoryService $categoryService
     *
     * @return Response|RedirectResponse
     */
    public function store(CategoryRequest $request, CategoryService $categoryService)
    {
        try {
            $categoryService->create($request->all());
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return back()->withInput()->with('error', 'Category has not been added.');
        }

        return redirect()->route('categories.index')->with('message', 'Category has been added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     *
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  Category $category
     * @param  CategoryService $categoryService
     *
     * @return Response
     */
    public function update(CategoryRequest $request, Category $category, CategoryService $categoryService)
    {
        try {
            $categoryService->update($category, $request->all());
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('categories.index')->with('message', 'Category has been updated successfully.');
    }

    /**
     * Destroy category
     *
     * @param CategoryService $categoryService
     * @param Category $category
     *
     * @return Response|RedirectResponse
     */
    public function destroy(CategoryService $categoryService, Category $category)
    {
        if ($categoryService->delete($category)) {
            return redirect()->route('categories.index')->with('message', 'Category has been removed.');
        }

        return back()->with('error', 'Category has not been removed.');
    }
}
