<?php

namespace App\Repositories;

use App\Domains\DTO\Worker\FilterData;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class WorkerEloquentRepository extends BaseRepository
{
    public function model(): string
    {
        return Worker::class;
    }

    /**
     * @param  int[]  $worker_ids
     */
    public function checkExOrderTypes(array $worker_ids, int $type_id): bool
    {
        return $this->model->newQuery()
            ->whereIn('id', $worker_ids)
            ->whereHas('exOrderTypes', function ($query) use ($type_id) {
                return $query->where('id', $type_id);
            })->exists();
    }

    public function getList(FilterData $data): LengthAwarePaginator
    {
        $builder = $this->model->newQuery();

        $builder = $this->filter($builder, $data);

        return $builder->paginate($data->per_page);
    }

    private function filter(Builder $builder, FilterData $data): Builder
    {
        if (! empty($data->type_ids)) {
            $builder = $builder->whereDoesntHave(
                'exOrderTypes',
                function ($query) use ($data) {
                    $query->select(DB::raw('count(distinct order_type_id)'))
                        ->whereIn('order_type_id', $data->type_ids)
                        ->havingRaw('count(distinct order_type_id) = ?', [count($data->type_ids)]);
                }
            );
        }

        return $builder;
    }
}
