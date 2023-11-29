<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;

class BaseElqouentRepository implements BaseRepository
{
    public function __construct(private $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }
    public function validate($request)
    {
        return $this->model->$request->validated();
    }


    public function create($data)
    {
        return $this->model->create($data);
    }
    public function update($model, $data)
    {
    }
    public function delete($listing)
    {
        Storage::disk('public')->delete($listing->logo);

        $listing->delete();
    }
    public function saveImage($file, $path)
    {
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }
}
