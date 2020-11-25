<?php

namespace App\Services;

use App\Page as ModelPage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repository\PageRepository;
use RuntimeException;

/**
 * Page specific functionality
 */
class Page
{
    /**
     * @var PageRepository
     */
    private $pageRepository;

    /**
     * @param PageRepository $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Get All Pages
     *
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->pageRepository->fetchAll();
    }

    /**
     *
     * @param array $data
     *
     * @return ModelPage
     */
    public function create(array $data): ModelPage
    {
        $forInsert = $this->matchInputModelValues($data);

        if (!$page = $this->pageRepository->create($forInsert)) {
            throw new RuntimeException('Page has not been added.');
        }

        return $page;
    }

    /**
     *
     * @param ModelPage $page
     * @param array $data
     *
     * @return ModelPage $page
     */
    public function update(ModelPage $page, array $data): ModelPage
    {
        $forUpdate = $this->matchInputModelValues($data);

        if (!$this->pageRepository->update($page, $forUpdate)) {
            throw new RuntimeException('Page has not been updated.');
        }

        return $page;
    }

    /**
     *
     * @param ModelPage $page
     *
     * @return bool|null
     */
    public function delete(ModelPage $page): ?bool
    {
        return $this->pageRepository->delete($page);
    }

    /**
     *
     * @param string|null $slug
     * 
     * @return ModelPage|null
     */
    public function fetchBySlug(?string $slug): ?ModelPage
    {
        return $this->pageRepository->findBySlug($slug);
    }

    /**
     *
     * @param  array $data
     *
     * @return array
     */
    private function matchInputModelValues(array $data): array
    {
        return [
            'title' => $data['title'],
            'content' => $data['content'],
            'is_enabled' => isset($data['is_enabled']) ? true : false,
        ];
    }
}
