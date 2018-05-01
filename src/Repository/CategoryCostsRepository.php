<?php
declare(strict_types=1);
namespace Fin\Repository;


use Fin\Models\CategoryCosts;

class CategoryCostsRepository extends DefaultRepository implements CategoryCostsRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(CategoryCosts::class);
    }

    public function sumByPeriod(string $dateStart, string $dateEnd, int $userId) : Array
    {
        $categories = CategoryCosts::query()
            ->selectRaw('category_costs.name, sum(value) as value')
            ->leftJoin('bill_pays', 'bill_pays.category_cost_id', '=', 'category_costs.id')
            ->whereBetween('date_launch', [$dateStart, $dateEnd])
            ->where('category_costs.user_id', $userId)
            ->whereNotNull('bill_pays.category_cost_id')
            ->groupBy('category_costs.name')
            ->get();
        return $categories->toArray();
    }
}