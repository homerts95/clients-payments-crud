<?php

namespace App\Repositories\Payment;

use App\Models\Client;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function all(): Collection
    {
        return Payment::all();
    }

    public function create(array $data)
    {
        return Payment::create($data);
    }

    public function update(array $data, $id)
    {
        $Client = Payment::findOrFail($id);
        $Client->update($data);
        return $Client;
    }

    public function delete($id): void
    {
        $Client = Payment::findOrFail($id);
        $Client->delete();
    }

    public function find($id)
    {
        return Payment::findOrFail($id);
    }

    public function paginated(int $perPage = 10): LengthAwarePaginator
    {
        return Payment::paginate($perPage);
    }
}
