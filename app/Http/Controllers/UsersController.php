<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function cadastro(Request $request)
    {
        DB::beginTransaction();
        try{
            $validatedData = $request->validate([
                'nome' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|string|email|max:255|unique:users,email',
                'genero' => 'required|in:MASCULINO,FEMININO,OUTRO,PREFIRO_NAO_INFORMAR',
                'peso_kg' => 'required|numeric',
                'altura_cm' => 'required|numeric',
                'senha' => 'required|string|min:6',
                'data' => 'required|date',
            ]);

            $user = User::create([
                'nome' => $validatedData['nome'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'genero' => $validatedData['genero'],
                'peso_kg' => $validatedData['peso_kg'],
                'altura_cm' => $validatedData['altura_cm'],
                'senha_hash' =>Hash::make($validatedData['senha']),
                'data_nascimento' => $validatedData['data'],
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Usuário cadastrado com sucesso',
                'user' => $user
            ], 200);

        }catch(\Exception $e){
            DB::rollback();

            return response()->json([
                'error' => 'Erro ao cadastrar paciente',
                'message' => $e->getMessage()
            ]);
        }
    }

}
