<?php

    //Regras de Negócio
    namespace App\Services;
    use App\Models\User;

    class UserServices
    {
        public function get($id = null)//Retorna dados
        {
            if ($id){
                return User::select($id);
            } else {
                return User::selectAll();
            }
            
        }

        public function post()//Inserir, atualizar dependendo
        {

        }

        public function update()//Alterar
        {

        }

        public function delete()//Apagar
        {

        }

    }