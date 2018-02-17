<?php

namespace Proposal\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Proposal
 * @package Proposal\Model
 */
class Proposal extends Model
{
    /**
     * campos a serem inseridos no banco de dados
     * @var array
     */
    protected $fillable = ['name','cpf','profession_id','address'];
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Retorna profissão vinculada
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profession(){
        return $this->belongsTo(Profession::class);
    }

    /**
     * retorna fotos da proposta
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pictures(){
        return $this->hasMany(ProposalPicture::class);
    }
}
