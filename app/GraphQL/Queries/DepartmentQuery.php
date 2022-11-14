<?php

namespace App\GraphQL\Queries;

use App\Models\Department;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class DepartmentQuery extends Query
{
    protected $attributes = [
        'name' => 'department',
    ];

    public function type(): Type
    {
        return GraphQL::type('Department');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        return Department::select($fields->getSelect())->with($fields->getRelations())->find($args['id']);
    }
}
