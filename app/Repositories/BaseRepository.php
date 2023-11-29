<?php

namespace App\Repositories;



interface BaseRepository
{
    public function all();
    public function create($data);
    public function update($model, $data);
    public function delete($listing);
    public function saveImage($file, $path);
    public function find($id);
    public function validate($request);
}
