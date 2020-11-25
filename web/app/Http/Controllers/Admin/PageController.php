<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use Illuminate\Http\Response;
use App\Page;
use App\Services\Page as PageService;
use Illuminate\Support\Facades\Log;
use Throwable;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PageService $pageService
     *
     * @return Response
     */
    public function index(PageService $pageService)
    {
        return view('admin.pages.home', [
            'data' => $pageService->getAll()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     *
     * @return Response
     */
    public function show(Page $page)
    {
        return view('admin.pages.view', [
            'page' => $page,
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
        $page = null;

        return view('admin.pages.new', [
            'page' => $page,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PageRequest $request
     * @param  PageService $pageService
     *
     * @return Response|RedirectResponse
     */
    public function store(PageRequest $request, PageService $pageService)
    {
        try {
            $pageService->create($request->all());
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return back()->withInput()->with('error', 'Page has not been added.');
        }

        return redirect()->route('pages.index')->with('message', 'Page has been added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     *
     * @return Response
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', [
            'page' => $page,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PageRequest  $request
     * @param  Page $page
     * @param  PageService $pageService
     *
     * @return Response
     */
    public function update(PageRequest $request, Page $page, PageService $pageService)
    {
        try {
            $pageService->update($page, $request->all());
        } catch (Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('pages.index')->with('message', 'Page has been updated successfully.');
    }

    /**
     * Destroy page
     *
     * @param PageService $pageService
     * @param Page $page
     *
     * @return Response|RedirectResponse
     */
    public function destroy(PageService $pageService, Page $page)
    {
        if ($pageService->delete($page)) {
            return redirect()->route('pages.index')->with('message', 'Page has been removed.');
        }

        return back()->with('error', 'Page has not been removed.');
    }
}
