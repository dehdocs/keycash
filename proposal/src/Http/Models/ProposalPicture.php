<?php

namespace Proposal\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProposalPicture
 * @package Proposal\Model
 */
class ProposalPicture extends Model
{
    /**
     * campos a serem inseridos no banco de dados
     * @var array
     */
    protected $fillable = ['url','title','proposal_id'];
}
