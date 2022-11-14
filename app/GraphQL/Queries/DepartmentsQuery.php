<?php

// https://www.freecodecamp.org/news/build-a-graphql-api-using-laravel/
namespace App\GraphQL\Queries;

use App\Models\Department;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class DepartmentsQuery extends Query
{
    protected $attributes = [
        'name' => 'departments',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Department'));
    }

    public function resolve($root, array $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        return Department::select($fields->getSelect())->with($fields->getRelations())->get();
    }
}
