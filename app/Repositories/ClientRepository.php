<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository implements ClientRepositoryInterface
{
    public function all(): Collection
    {
        return Client::all();
    }

    public function create(array $data)
    {
        return Client::create($data);
    }

    public function update(array $data, $id)
    {
        $Client = Client::findOrFail($id);
        $Client->update($data);
        return $Client;
    }

    public function delete($id): void
    {
        $Client = Client::findOrFail($id);
        $Client->delete();
    }

    public function find($id)
    {
        return Client::findOrFail($id);
    }

    public function paginated(int $perPage = 10): LengthAwarePaginator
    {
        return Client::paginate($perPage);
    }
}
