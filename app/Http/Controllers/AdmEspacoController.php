<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Espaco;

class AdmEspacoController extends Controller
{
    public function validations(Request $req)
    {
        $rules = [
            "nome_espaco" => "required|min:3|max:50",
            "capacidade_espaco" => "required",
            "descricao_espaco" => "required",
        ];

        $messages = [
            "required" => "Campo obrigatório",
        ];

        $req->validations($rules, $messages);
    }

    public function addForm()
    {
        $caminho = route('adm.adicionaEspaco');
        return view('adm.espacos.formulario', compact('caminho'));
    }

    public function updateForm($id)
    {
        $espacos = Espaco::find($id);
        $caminho = route('adm.atualizaEspaco', $id);
        return view('adm.espacos.formulario', compact('caminho', 'espacos'));
    }

    public function insert(Request $req)
    {
        $this->validations($req);

        $dados = $req->all();
        Espaco::create($dados);

        return redirect()->route('adm.listaEspaco');
    }

    public function update(Request $req, $id)
    {
        $this->validations($req);

        $dados = $req->all();
        Espaco::find($id)->update($dados);

        return redirect()->route('adm.listaEspaco');
    }

    public function selectAll()
    {
        $registros = Espaco::all();
        return view('adm.espacos.listar', compact('registros'));
    }

    public function delete($id)
    {
        Espaco::find($id)->delete();
        return redirect()->route('adm.listaEspaco');
    }
}
