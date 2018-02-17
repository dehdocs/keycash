<?php

namespace Proposal\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Profession
 * @package Proposal\Model
 */
class Profession extends Model
{
    /**
     * campos a serem inseridos no banco de dados
     * @var array
     */
    protected $fillable = ['name'];
}
