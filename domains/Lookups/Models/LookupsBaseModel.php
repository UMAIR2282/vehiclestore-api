<?php

namespace Lookups\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;
use Lookups\Actions\Traits\Addable;
use Lookups\Actions\Traits\Deleteable;
use Lookups\Actions\Traits\Fetchable;
use Lookups\Actions\Traits\Listable;
use Lookups\Actions\Traits\Updateable;
use Lookups\Collections\LookupItemsCollection;
use Lookups\Collections\LookupItemsQueryBuilder;

abstract class LookupsBaseModel extends BaseModel
{
    use Addable, Updateable, Deleteable, Fetchable, Listable;

    public function newEloquentBuilder($query) : LookupItemsQueryBuilder
    {
        return new LookupItemsQueryBuilder($query);
    }
}