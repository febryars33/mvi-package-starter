<?php

namespace MVI\Starter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    // Eloquent's missing "array" driver.
    // Sometimes you want to use Eloquent, but without dealing with a database.
    use \Sushi\Sushi;

    /**
     * Example rows data from database.
     *
     * @var array
     */
    protected $rows = [];

    /**
     * Schema auto-detection system doesn't meet your specific requirements for the supplied row data.
     *
     * @var array
     */
    protected $schema = [
        'role_id'   =>  'integer',
        'name'      =>  'string',
        'status'    =>  'boolean',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'name',
        'status'
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->faker();
    }

    /**
     * Creating the dummy data.
     *
     * @return void
     */
    protected function faker(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $this->rows[] = [
                'id'        =>  $i,
                'role_id'   =>  fake()->randomElement([1, 2]),
                'name'      =>  fake()->name(),
                'status'    =>  fake()->randomElement([0, 1])
            ];
        }
    }

    /**
     * Get the role that owns the Employee.
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
