<?php

namespace Source\Controllers\Api;

use Source\Core\Controller;
use Source\Models\User;

class Users extends Api{

    public function __construct()
    {
       parent::__construct(); 
    }

    public function index(): void{
        $user = $this->user->data();
        unset($user->senha);
        $response["user"] = $user;
        $this->back($response);
    }

    public function read(array $data){

      $request = $this->requestLimit("usersRead", 5, 60);
      
      if(!$request){
        return;
      }

      if(empty($data["user_id"]) || !$user_id = filter_var($data["user_id"],FILTER_VALIDATE_INT)){
        $this->call(
            400,
            "invalid_data",
            "Infome um id de usuário para ocorrer a pesquisa"
        )->back();
      }

      $user = (new User())->find("id = :user_id", "user_id={$user_id}")->fetch();
    
      if(!$user){
        $this->call(
            404,
            "not_found",
            "Usuário não encontrado"
        )->back();
        return;
      }
 
      $response["user"] = $user->data();
      $this->back($response);
    }

    public function create(array $data){
      
      $request = $this->requestLimit("usersCreate", 5, 60);
      
      if(!$request){
        return;
      }

      $nome = $data['nome'];
      $email = $data['email'];
      $senha = $data['senha'];
      $rg = $data['rg'];
      $cpf = $data['cpf'];
      $cep = $data['cep'];
      $logradouro = $data['logradouro'];
      $numero = $data['numero'];
      $complemento = $data['complemento'];
      $bairro = $data['bairro'];
      $cidade = $data['cidade'];
      $estado = $data['estado'];
      $celular = $data['celular'];
      $convenio = $data['convenio'];
      $conv_numero = $data['nconvenio'];

      //cria um objeto usuário setando o usuário
      //setando os dados vindo do formulário       
      $user = new User();

      $result = $user->find("email = :user_email", "user_email={$email}")->fetch();

      if($result){
        $this->call(
          400,
          "invalid_data",
          "Email já cadastrado"
        )->back();
        return;
      }

      $user->nome = $nome;
      $user->email = $email;
      $user->senha = password_hash($senha,CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
      $user->tipo = 3;

     

      //usa metodo save para salvar esse usuário no banco de dados
      $userId = $user->save();

      $response["user"] = $user->data();
      $this->back($response);
    }

    public function update(array $data){
      $request = $this->requestLimit("usersUpdate", 5, 60);
      if(!$request){
        return;
      }
      $user = (new User())->findById($this->user->id);   
      $user->nome = (!empty($data["nome"])) ? $data["nome"] : $this->user->nome;

      if(!empty($data["email"])) {
        $result = $user->find("email = :user_email", "user_email={$email}")->fetch();
  
        if($result){
          $this->call(
            400,
            "invalid_data",
            "Já existe o email"
          )->back();
          return;
        }
      }

      $user->email = (!empty($data["email"])) ? $data["email"] : $this->user->email;
      $user->senha = (!empty($data["senha"])) ? password_hash($data["senha"], 
      CONF_PASSWD_ALGO, CONF_PASSWD_OPTION) : $this->user->senha;
      $user->tipo = (!empty($data["tipo"])) ? $data["tipo"] : $this->user->tipo;

      $response["user"] = $user->data();
      if($user->save()){
        $this->call(
          200,
          "success_updated",
          "Usuário atualizado com sucesso."
        )->back($response);
        return;
      }

      $this->call(
        400,
        "invalid_data",
        "Erro ao atualizar dados, verifique as informações."
      )->back();
      
    }


    public function delete(array $data){
      
      $request = $this->requestLimit("usersDelete", 5, 60);
      if(!$request){
        return;
      }
      
      if($this->user->destroy()){
        $this->call(
          200,
          "success_deleted",
          "Usuário deletado com sucesso."
        )->back();
        return;
      }

      $this->call(
          400,
          "error_deleted",
          "Erro ao tentar excluir usuário, 
          verifique se há consultas agendadas para o mesmo.
          Dúvidas entre em contato com o suporte"
      )->back();
    }

}