<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\{PHPMailer, Exception};

class CorreoController
{
  private $correo;

  public function __construct(string $Host, bool $SMTPAuth, string $Username, string $Password, int $Puerto)
  {
    try {
      $this->correo = new PHPMailer(true);
      $this->correo->isSMTP();
      $this->correo->Host = $Host;
      $this->correo->SMTPAuth = $SMTPAuth;
      $this->correo->Username = $Username;
      $this->correo->Password = $Password;
      $this->correo->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $this->correo->Port = $Puerto;
      $this->correo->CharSet = 'UTF-8';

      // Configuración adicional para debug
      $this->correo->SMTPDebug = 0; // 0 = off, 1 = client messages, 2 = client and server messages
      $this->correo->Debugoutput = function ($str, $level) {
        error_log("PHPMailer Debug: $str");
      };
    } catch (Exception $e) {
      error_log("Error al inicializar PHPMailer: " . $e->getMessage());
      throw $e;
    }
  }

  public function enviarCorreoRecuperacion(string $remitente, string $destinatario, string $titulo, array $data)
  {
    try {
      $this->correo->setFrom($remitente, 'TuRifaDigi');
      $this->correo->addAddress($destinatario);

      $this->correo->isHTML(true);
      $this->correo->Subject = $titulo;

      // Generar enlace de recuperación
      $resetLink = "http://localhost/TuRifadigi/reset-password?token=" . $data['token'];

      $this->correo->Body = '
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <title>Recuperación de Contraseña - TuRifaDigi</title>
                    <style>
                        .email-container { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f2f2f2; margin: 0; padding: 0; }
                        .content-box { max-width: 600px; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
                        .header { color: #4a90e2; text-align: center; margin-bottom: 30px; }
                        .button { background-color: #4a90e2; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block; }
                        .button:hover { background-color: #357abd; }
                        .footer { font-style: italic; text-align: center; color: #666; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef; }
                    </style>
                </head>
                <body>
                    <div class="email-container">
                        <div class="content-box">
                            <h1 class="header">Recuperación de Contraseña</h1>
                            <p>Hola ' . htmlspecialchars($data['usuario']) . ',</p>
                            <p style="text-align: justify;">
                                Has solicitado restablecer la contraseña de tu cuenta en TuRifaDigi. 
                                Para continuar con el proceso, haz clic en el siguiente botón:
                            </p>  
                            <div style="text-align: center; margin: 30px 0;">
                                <a href="' . $resetLink . '" class="button">
                                    Restablecer Contraseña
                                </a>
                            </div>
                            <p><strong>Importante:</strong></p>
                            <ul>
                                <li>Este enlace expirará en 24 horas por razones de seguridad.</li>
                                <li>Si no solicitaste este cambio, puedes ignorar este correo.</li>
                                <li>Por tu seguridad, no compartas este enlace con nadie.</li>
                            </ul>
                            <div class="footer">
                                <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
                                <p>TuRifaDigi - ' . date('Y') . '</p>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
            ';

      if (!$this->correo->send()) {
        error_log("Error Mailer: " . $this->correo->ErrorInfo);
        throw new Exception($this->correo->ErrorInfo);
      }
      return true;
    } catch (Exception $e) {
      error_log("Error al enviar correo a {$destinatario}: " . $e->getMessage());
      throw $e;
    }
  }
}
