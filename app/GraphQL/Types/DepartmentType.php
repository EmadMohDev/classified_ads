<?php

namespace App\GraphQL\Types;

use App\Models\Department;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class DepartmentType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Department',
        'description' => 'Collection of departments',
        'model' => Department::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of department'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the department'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Email of department'
            ],
            'users' => [
                'type' => Type::listOf(GraphQL::type('User')),
                'description' => 'The users',
                'always' => ['id', 'name', 'email'],
            ]
        ];
    }
}
