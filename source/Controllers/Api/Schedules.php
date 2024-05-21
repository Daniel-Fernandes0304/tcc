<?php

namespace Source\Controllers\Api;

use Source\Core\Controller;
use Source\Models\Login;
use Source\Models\User;
use Source\Models\Schedule;

class Schedules extends Api{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void{
        $schedules = (new Schedule())->find("paciente = user_id", "user_id={$this->user->id}")->fetch(true);

        foreach($schedules as $item) {
            $response["schedule"][] = $item->data();
        }

        $this->back($response);
        return;
    }

    public function read(array $data){

        $request = $this->requestLimit("scheduleRead", 5, 60);
        if(!$request){
            return;
        }

        if(empty($data["key"])){
            $this->call(
                400,
                "invalid_data",
                "Informe um id da consulta para ocorrer a pesquisa"
            )->back();
            return;
        }

        if($key = filter_var($data["key"], FILTER_VALIDATE_INT)) {
            $schedule = (new Schedule())->find("id = :schedule_id", "schedule_id={$key}")->fetch();
        } else {
            $schedule = (new Schedule())->find("id = :schedule_data", "schedule_data={$key}")->fetch();
        }

        if(!$schedule){
            $this->call(
                404,
                "not_found",
                "Usuário não encontrado"
            )->back();
            return;
        }

        $response["schedule"] = $schedule->data();
        $this->back($response);
    }

    public function create(array $data)
    {

            $request = $this->requestLimit("schedulesCreate", 5, 60);
            if(!$request){
                return;
            }
            
            $dia = $data['dia'];
            $hora = $data['hora'];
            $medico = $data['medico'];
            $paciente = $data['paciente'];
            $convenio = $data['convenio'];
            $observacoes = $data['observacoes'];

            $schedule = new Schedule();
            $schedule->dia = $dia;
            $schedule->hora = $hora;
            $schedule->medico = $medico;
            $schedule->paciente = $paciente;
            $schedule->convenio = $convenio;
            $schedule->observacoes = $observacoes;

            $scheduleId = $schedule->save();
            
            $response["schedule"] = $schedule->data();
            $this->back($response);
        }


    public function update(array $data){
        $request = $this->requestLimit("scheduleUpdate", 5, 60);
        if(!$request){
            return;
        }

        $schedule = (new Schedule())->findById($data["schedule_id"]);

        $schedule->dia = (!empty($data["dia"])) ? $data["dia"] : $schedule->dia;
        $schedule->hora = (!empty($data["hora"])) ? $data["hora"] : $schedule->hora;
        $schedule->medico = (!empty($data["medico"])) ? $data["medico"] : $schedule->medico;
        $schedule->paciente = (!empty($data["paciente"])) ? $data["paciente"] : $schedule->paciente;
        $schedule->convenio = (!empty($data["convenio"])) ? $data["convenio"] : $schedule->convenio;
        $schedule->observacoes = (!empty($data["observacoes"])) ? $data["observacoes"] : $schedule->observacoes;


        $response["schedule"] = $schedule->data();
        if($schedule->save()) {
            $this->call(
            200,
            "success_updated",
            "Agenda atualizada com sucesso"
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
            $request = $this->requestLimit("scheduleDelete", 5, 60);
            if(!$request){
                return;
            }

            $schedule = (new Schedule())->findById($data["schedule_id"]);

            if($schedule->destroy()) {
                $this->call(
                    200,
                    "success_deleted",
                    "Consulta deletada com sucesso"
                )->back();
                return;
        }
        $this->call(
            400,
            "error_delete",
            "Erro ao tentar excluir usuario, verifique se há consultas agendads para o mesmo. Dúvidas? Entre em contato com o suporte"
        )->back();
    }
    
}