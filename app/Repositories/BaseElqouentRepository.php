<?php

namespace App\Repositories;

use App\Models\Listing;
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
    public function descFilterPaginate(array $filter, int $paginate)
    {
        return $this->model->latest()->filter(request($filter))->paginate($paginate);
    }


    public function create($data)
    {
        return $this->model->create($data);
    }
    public function update($model, $data)
    {
        return $model->update($data);
    }

    public function delete($model)
    {
        return $model->destroy($model->id);
    }
    public function saveImage($file, $path)
    {
    }
    public function deleteImage($image)
    {
        return Storage::disk('public')->delete($image ?? '');
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function latest($model)
    {
        return $this->model;
    }
    public function filter($model)
    {
    }
    public function paginate()
    {
        return $this->model->paginate();
    }
}
