<?php

namespace App\Repositories\Contracts;

interface ArticleCategoryInterface extends BaseInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data);

    public function saveFileUpload($file, $type);

    public function updateTreeRebuild($root, $data);
}
