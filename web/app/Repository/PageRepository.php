<?php

namespace App\Repository;

use App\Page;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PageRepository
 */
class PageRepository
{
    /**
     * Return all pages
     *
     * @return LengthAwarePaginator
     */
    public function fetchAll(): LengthAwarePaginator
    {
        return Page::paginate(\config('custom.pages.show_per_page'));
    }

    /**
     * Get Page by id.
     * 
     * @param int $pageId
     * 
     * @return Page|null
     */
    public function getById(int $pageId): ?Page
    {
        return Page::where('id', $pageId)->first();
    }

    /**
     * Get Page by slug.
     *
     * @param string|null $slug
     * @return Page|null
     */
    public function findBySlug(?string $slug): ?Page
    {
        return Page::where('slug', $slug)->where('is_enabled', true)->first();
    }

    /**
     * Create Page
     *
     * @param array $data
     * @return Page
     */
    public function create(array $data): Page
    {
        return Page::create($data);
    }

    /**
     * Update Page
     *
     * @param Page $page
     * @param array $fields
     *
     * @return Page
     */
    public function update(Page $page, array $fields): Page
    {
        $page->fill($fields);
        $page->save();

        return $page;
    }

    /**
     * Remove Page
     *
     * @param  Page $page
     *
     * @return bool|null
     */
    public function delete(Page $page): ?bool
    {
        return $page->delete();
    }
}
