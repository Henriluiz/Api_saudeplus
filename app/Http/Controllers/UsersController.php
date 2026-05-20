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
                'email' => 'required|string|email|max:255|unique:users,email',
                'genero' => 'required|in:MASCULINO,FEMININO,OUTRO,PREFIRO_NAO_INFORMAR',
                'peso' => 'required|numeric',
                'altura' => 'required|numeric',
                'senha' => 'required|string|min:6',
                'data' => 'required|date',
                'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                $fotoPerfil = $request->file('foto')->store('fotos', 'public');
            } else {
                $fotoPerfil = null;
            }

            $data = \Carbon\Carbon::createFromFormat('Y-m-d', $request->data);

            $user = User::create([
                'nome' => $validatedData['nome'],
                'email' => $validatedData['email'],
                'genero' => $validatedData['genero'],
                'peso' => $validatedData['peso'],
                'altura' => $validatedData['altura'],
                'senha' =>Hash::make($validatedData['senha']),
                'data_nascimento' => $data,
                'foto_perfil' => $fotoPerfil,
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
