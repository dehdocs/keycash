<?php

namespace Proposal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Image;
use Proposal\Model\Profession;
use Proposal\Model\Proposal;
use Proposal\Model\ProposalPicture;
use Storage;
use Validator;

/**
 * Class ProposalController
 * @package Proposal\Http\Controllers
 */
class ProposalController extends Controller{

    /**
     * utilizado para checagem de erros
     * @var bool
     */
    private $pictureStatus = true;


    /**
     * retorna a view inicial
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function  index () {
        return view('proposal::index');
    }

    /**
     * retorna a view de criação de propostas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function  create(){
        return view('proposal::create');
    }

    /**
     * Retorna a view de lista de propostas em paginação
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list(){
        $proposals = Proposal::paginate(10);
        return view('proposal::list')->with(compact('proposals'));
    }

    /**
     * Recebe o objeto da proposta e retorna a view de leitura
     * @param Proposal $proposal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Proposal $proposal){
        return view('proposal::view')->with(compact('proposal'));
    }

    /**
     * Recebe um request via post, valida e insere os dados na proposta
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function  postCreate(Request $request){
        $parameters = [
                    'name'          => 'required|min:3|max:100',
                    'cpf'           => 'required|min:11|max:11',
                    'profession'    => 'required|min:1|max:40',
                    'address'       => 'required|min:5|max:150',
                    'photos'        => 'required',
                    'photos.*'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ];

        $validator = Validator::make($request->all(),$parameters);
        if($validator->fails()){
            return redirect()->route('proposal-create')->withErrors($validator)->withInput();
        }else{
            $profession = $this->checkOrInsertProfession($request->profession);
            if($profession){
                $data = [
                    'name'              => $request->name,
                    'cpf'               => $request->cpf,
                    'profession_id'     => $profession->id,
                    'address'           => $request->address
                ];
                if($proposal = Proposal::create($data)){
                    $this->saveImages($request->photos, $proposal);

                    if($this->pictureStatus){
                        return redirect()->back();
                    }else{
                        return redirect()->route('proposal-create')->with('message','Não foi possível criar as imagens da proposta')->withInput();
                }
                }else{
                    return redirect()->route('proposal-create')->with('message','Não foi possível criar a proposta')->withInput();
                }
            }else{
                return redirect()->route('proposal-create')->with('message','Não foi possível criar a profisß')->withInput();
            }

        }
    }


    /**
     * recebe o nome de uma profissão, verifica se ela existe e retorna o objeto
     * @param $name
     * @return bool|Profession
     */
    private function checkOrInsertProfession($name){
        $profession = Profession::where('name',$name)->first();

        if(is_null($profession)){
            $data = ['name' => $name];
            if($profession = Profession::create($data)){
                return $profession;
            }else{
                return false;
            }
        }else{
            return $profession;
        }
    }

    /**
     * Recebe os arquivos enviados no cadastro, redimensiona e envia para a pasta publica
     * @param $photos
     * @param Proposal $proposal
     */
    private function saveImages($photos, Proposal $proposal){
        $n = 1;
        foreach($photos as $photo){

            $extension = $photo->getClientOriginalExtension();
            $realFileName = $photo->getFilename();


            $hashName = hash('sha1',$realFileName).'.'.$extension;
            $thumbName = hash('sha1',$realFileName).'t.'.$extension;
            $p =  Image::make($photo->getRealPath());


            $large = $p->resizeCanvas(1000, 1000, 'center');
            $large->save(public_path('/images/large/'.$hashName));

            $thumb = $p->resize(50, 40);
            $thumb->save(public_path('/images/large/'.$thumbName));

            $data = ['url' => $hashName, 'proposal_id' => $proposal->id ,'title' => "picture $n"];
            if(!ProposalPicture::create($data)){
                $this->pictureStatus = false;
            }
            $n++;
        }
    }

}