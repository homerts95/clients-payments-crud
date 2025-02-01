<?php

namespace App\Services\Client;

use App\Repositories\Client\ClientRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientService
{
    public function __construct(
        protected ClientRepositoryInterface $clientRepository
    )
    {
    }

    public function create(array $data)
    {
        return $this->clientRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->clientRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->clientRepository->delete($id);
    }

    public function all()
    {
        return $this->clientRepository->all();
    }

    public function find($id)
    {
        return $this->clientRepository->find($id);
    }

    public function paginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->clientRepository->paginated($perPage);
    }

}
