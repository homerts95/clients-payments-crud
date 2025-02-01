<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface ClientRepositoryInterface
{
    public function all();
    public function paginated(int $perPage = 10): LengthAwarePaginator;

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);
}
