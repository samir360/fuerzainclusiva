<?php

namespace App\Services;

use App\Events\ContactSendMail;
use Illuminate\Support\Facades\Log;

class EmailSendServices
{

    public function sendEmailContacto($request)
    {

        $cliente = ucwords(mb_strtolower($request->name));
        $email = $request->email;
        $subject = 'Contacto';
        $attachedFilePath = null;
        $attachedFileName = 'Contacto';

        #PLANTILLA GENERICA
        $body = " Estimado cliente, <strong>" . $cliente . "</strong> le damos la bienvenida a nuestra web site
                <strong> fuerzainclusiva.com</strong>, le informamos que hemos recibido su comentario, nos comunicaremos con usted a la brevedad posible,
                Gracias.<br><br><strong>Saludos</strong><br><br>";

        try {
            Event(new ContactSendMail($cliente, $email, $body, $subject, $attachedFilePath, $attachedFileName));

        } catch (\Exception $e) {
            //dd($e->getMessage());
            Log::error('sendEmailContacto: ', ['cliente:' => ": {$cliente}" . ' | ' . "Error: {$e->getMessage()}"]);
            return true;
        }
    }


    public function sendEmailSoporteContacto($request)
    {
        $cliente = ucwords(mb_strtolower($request->name));
        $email = $request->email;
        $comentario = $request->comments;
        $subject = $request->subject;
        $attachedFilePath = null;
        $attachedFileName = 'Soporte Contacto';

        #PLANTILLA GENERICA
        $body = " Señores, <strong>fuerzainclusiva.com</strong> el cliente ha enviado su comentario a tráves de nuestro formulario de contacto,
        por favor comuníquese a la brevedad posible..
        
        <br><br><strong>Nombre</strong> " . $cliente . "<br><br>
        
        <strong>Correo Electrónico</strong> " . $email . "<br><br>
        
        <strong>Asunto</strong> " . $subject . "<br><br>
        
        <strong>Comentario</strong> " . $comentario . " <br><br>
        
        <strong>Saludos</strong>";

        try {

            Event(new ContactSendMail($cliente, env('MAIL_FROM_INFO'), $body, $subject, $attachedFilePath, $attachedFileName));

        } catch (\Exception $e) {
            //dd($e->getMessage());
            Log::error('sendEmailSoporteContacto: ', ['cliente:' => ": {$cliente}" . ' | ' . "Error: {$e->getMessage()}"]);
            return true;
        }

    }


    public function sendEmailRegister($request)
    {

        $cliente = ucwords(mb_strtolower($request->firstname . ' ' . $request->lastname));
        $email = $request->email;
        $subject = 'Registro';
        $attachedFilePath = null;
        $attachedFileName = 'Registro';
        $password = $request->password;

        #PLANTILLA GENERICA
        $body = " Estimado cliente, <strong>" . $cliente . "</strong> le damos la bienvenida a nuestra web site
                <strong> fuerzainclusiva.com</strong>, le informamos que su registro se ha realizado exitosamente,Gracias.<br><br>
                
                 <strong> Datos de su cuenta:</strong><br><br>
                 
                 <strong> Correo eletrónico:</strong>$email<br><br>
                 
                 <strong> Contraseña:</strong>$password<br><br>
                 
                
                <strong>Saludos</strong><br><br>";

        try {

            Event(new ContactSendMail($cliente, $email, $body, $subject, $attachedFilePath, $attachedFileName));

        } catch (\Exception $e) {
            //dd($e->getMessage());
            Log::error('sendEmailRegister: ', ['cliente:' => ": {$cliente}" . ' | ' . "Error: {$e->getMessage()}"]);
            return true;
        }
    }


    public function sendEmailRegisterSoporteContacto($request)
    {
        $cliente = ucwords(mb_strtolower($request->firstname . ' ' . $request->lastname));
        $attachedFilePath = null;
        $attachedFileName = 'Nuevo Registro';
        $subject = 'Nuevo Registro';
        $email = $request->email;
        $tipo = 'Empleador';

        if ($request->rol_id == 4) {
            $tipo = 'Candidato';
        }


        #PLANTILLA GENERICA
        $body = " Señores, <strong>fuerzainclusiva.com</strong> le informamos que el cliente $cliente se ha registrado exitosamente.<br><br>
 
                <strong> Datos de la cuenta: </strong><br><br>
                 
                 <strong> Correo eletrónico: </strong>$email<br><br>
                 
                 <strong> Se registro como: </strong>$tipo<br><br>
       
        
        <strong>Saludos</strong>";

        try {

            Event(new ContactSendMail($cliente, env('MAIL_FROM_INFO'), $body, $subject, $attachedFilePath, $attachedFileName));

        } catch (\Exception $e) {
            //dd($e->getMessage());
            Log::error('sendEmailRegisterSoporteContacto: ', ['cliente:' => ": {$cliente}" . ' | ' . "Error: {$e->getMessage()}"]);
            return true;
        }
    }

}