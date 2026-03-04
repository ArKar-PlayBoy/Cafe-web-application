<?php

namespace App\Policies;

use App\Models\StockItem;
use App\Models\User;

class StockItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, StockItem $stockItem): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, StockItem $stockItem): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, StockItem $stockItem): bool
    {
        return $user->isAdmin();
    }

    public function viewMovements(User $user, StockItem $stockItem): bool
    {
        return $user->isAdmin();
    }

    public function viewRecipe(User $user, StockItem $stockItem): bool
    {
        return $user->isAdmin();
    }

    public function updateRecipe(User $user, StockItem $stockItem): bool
    {
        return $user->isAdmin();
    }

    public function addStock(User $user, StockItem $stockItem): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function adjustStock(User $user, StockItem $stockItem): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function viewBatches(User $user): bool
    {
        return $user->isAdmin();
    }

    public function viewAlerts(User $user): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }
}
