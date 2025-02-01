<?php

namespace App\Services\Payment;

use App\Repositories\Payment\PaymentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentService
{
    public function __construct(
        protected PaymentRepositoryInterface $clientRepository
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

    public function paginated(int $perPage = null): LengthAwarePaginator
    {
        $perPage ??= config('pagination.per_page.clients');
        return $this->clientRepository->paginated($perPage);
    }

}
