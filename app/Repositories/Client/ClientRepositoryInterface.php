<?php

namespace App\Repositories\Client;

use Illuminate\Pagination\LengthAwarePaginator;

interface ClientRepositoryInterface
{
    public function all();

    public function paginated(int $perPage = 10, array $filters = []): LengthAwarePaginator;

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);
}
