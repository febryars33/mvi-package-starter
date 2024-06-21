<?php

namespace MVI\Starter\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Eloquent's missing "array" driver.
    // Sometimes you want to use Eloquent, but without dealing with a database.
    use \Sushi\Sushi;

    /**
     * Example rows data from database.
     *
     * @var array
     */
    protected $rows = [
        [
            'id'        =>  1,
            'name'      =>  'Developer'
        ],
        [
            'id'        =>  2,
            'name'      =>  'Designer'
        ]
    ];

    /**
     * Schema auto-detection system doesn't meet your specific requirements for the supplied row data.
     *
     * @var array
     */
    protected $schema = [
        'name'      =>  'string',
    ];
}
