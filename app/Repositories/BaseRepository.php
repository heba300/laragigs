<?php

namespace App\Repositories;



interface BaseRepository
{
    public function all();
    public function create($data);
    public function update($model, $data);
    public function delete($model);
    public function requestFileExists($file): bool;
    public function saveImage($file, $path);
    public function find($id);
    public function latest($model);
    public function filter($request);
    public function deleteImage($image);
    public function descFilterPaginate(array $filter, int $paginate);
}
