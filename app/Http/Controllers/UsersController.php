<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Psicologo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

public function cadastroPsicologo(Request $request)
    {
        DB::beginTransaction();
        try {

            $validatedData = $request->validate([
                'nome' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'telefone' => 'required|string|max:20',
                'genero' => 'required|string|max:20',
                'senha' => 'required|string|min:6',
                'data_nascimento' => 'required|date',
                'cpf' => 'required|string|max:14|unique:users',
                'crp' => 'required|string|max:20|unique:psicologo,crp',
                'cadastro_e-psi' => 'required|boolean|unique:psicologo,cadastro_e-psi',
                'grau_formacao' => 'required|in:TECNOLOGO,BACHARELADO,LICENCIATURA,ESPECIALIZACAO,MESTRADO,DOUTORADO,POS_DOUTORADO',
                'termos_aceitos' => 'required|boolean',
            ]);

            $user = User::create([
                'nome' => $validatedData['nome'],
                'email'=> $validatedData['email'],
                'telefone'=>$validatedData['telefone'],
                'genero'=>$validatedData['genero'],
                'senha_hash'=>Hash::make($validatedData['senha']),
                'data_nascimento'=>$validatedData['data_nascimento'],
                'cpf'=>$validatedData['cpf'],
                'tipo_usuario'=>'psicologo' ,
                'status_usuario'=>'ativo',
                'termos_aceitos'=>$validatedData['termos_aceitos'],

            ]);

            Psicologo::create([
                'id_usuario' => $user->id_usuario,
                'crp'=> $validatedData['crp'],
                'cadastro_e-psi'=>$validatedData['cadastro_e-psi'],
                'grau_formacao'=>$validatedData['grau_formacao'],
                'status_psicologo' => 'pendente',
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Usuário cadastrado com sucesso',
                'user' => $user,
            ], 201);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'error' => 'Erro ao cadastrar',
                'message' => $e->getMessage()
            ], 500);

        }
    }

}
