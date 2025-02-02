<?php

namespace App\Repositories\Client;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
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

    public function paginated(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $query = Client::query();

        $this->applyDateRangeFilter(
            query: $query,
            fromDate: $filters['date_from'] ?? null,
            toDate: $filters['date_to'] ?? null
        );

        return $query->paginate($perPage)->withQueryString();
    }

    protected function applyDateRangeFilter(
        Builder $query,
        ?string $fromDate,
        ?string $toDate,
        string $field = 'created_at'
    ): void {
        if ($fromDate) {
            $query->whereDate($field, '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate($field, '<=', $toDate);
        }
    }
}
