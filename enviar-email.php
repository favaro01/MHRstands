<?php
// Configurações de erro
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Headers para CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recebe os dados do formulário
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
    $mensagem = isset($_POST['mensagem']) ? trim($_POST['mensagem']) : '';
    
    // Validação básica
    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo json_encode([
            'success' => false,
            'message' => 'Por favor, preencha todos os campos obrigatórios.'
        ]);
        exit;
    }
    
    // Validação de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Por favor, insira um email válido.'
        ]);
        exit;
    }
    
    // ============================================
    // CONFIGURAÇÕES DE EMAIL - EDITE AQUI
    // ============================================
    
    $config = [
        'smtp_host' => 'smtp.gmail.com',           // Seu servidor SMTP (ex: smtp.gmail.com, smtp.office365.com)
        'smtp_port' => 587,                        // Porta (587 para TLS, 465 para SSL)
        'smtp_secure' => 'tls',                    // 'tls' ou 'ssl'
        'smtp_user' => 'seu-email@gmail.com',      // Seu email
        'smtp_pass' => 'sua-senha-app',            // Sua senha ou senha de app
        'from_email' => 'seu-email@gmail.com',     // Email de envio
        'from_name' => 'MHR Stands - Site',        // Nome de envio
        'to_email' => 'contato@mhrstands.com.br',  // Email que vai receber
        'to_name' => 'MHR Stands'                  // Nome do destinatário
    ];
    
    // ============================================
    
    // Verifica se o PHPMailer está disponível
    if (!file_exists(__DIR__ . '/phpmailer/src/PHPMailer.php')) {
        // Fallback: Usar mail() nativo do PHP
        enviarEmailNativo($nome, $email, $telefone, $mensagem, $config);
    } else {
        // Usar PHPMailer (recomendado)
        enviarEmailPHPMailer($nome, $email, $telefone, $mensagem, $config);
    }
}

// Função para enviar com PHPMailer
function enviarEmailPHPMailer($nome, $email, $telefone, $mensagem, $config) {
    require __DIR__ . '/phpmailer/src/PHPMailer.php';
    require __DIR__ . '/phpmailer/src/SMTP.php';
    require __DIR__ . '/phpmailer/src/Exception.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    $mail = new PHPMailer(true);
    
    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = $config['smtp_host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['smtp_user'];
        $mail->Password   = $config['smtp_pass'];
        $mail->SMTPSecure = $config['smtp_secure'];
        $mail->Port       = $config['smtp_port'];
        $mail->CharSet    = 'UTF-8';
        
        // Remetente e destinatário
        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress($config['to_email'], $config['to_name']);
        $mail->addReplyTo($email, $nome);
        
        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = 'Novo contato - MHR Stands';
        $mail->Body    = montarEmailHTML($nome, $email, $telefone, $mensagem);
        $mail->AltBody = montarEmailTexto($nome, $email, $telefone, $mensagem);
        
        $mail->send();
        
        echo json_encode([
            'success' => true,
            'message' => 'Mensagem enviada com sucesso! Entraremos em contato em breve.'
        ]);
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao enviar mensagem. Por favor, tente novamente.',
            'error' => $mail->ErrorInfo
        ]);
    }
}

// Função para enviar com mail() nativo (fallback)
function enviarEmailNativo($nome, $email, $telefone, $mensagem, $config) {
    $assunto = 'Novo contato - MHR Stands';
    $corpo = montarEmailHTML($nome, $email, $telefone, $mensagem);
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: {$config['from_name']} <{$config['from_email']}>\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    if (mail($config['to_email'], $assunto, $corpo, $headers)) {
        echo json_encode([
            'success' => true,
            'message' => 'Mensagem enviada com sucesso! Entraremos em contato em breve.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao enviar mensagem. Por favor, tente novamente.'
        ]);
    }
}

// Template HTML do email
function montarEmailHTML($nome, $email, $telefone, $mensagem) {
    $data = date('d/m/Y H:i');
    
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #2b313d 0%, #11aaa2 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
            .header h1 { margin: 0; font-size: 24px; }
            .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 10px 10px; }
            .info-box { background: white; padding: 20px; margin: 15px 0; border-radius: 8px; border-left: 4px solid #11aaa2; }
            .label { font-weight: bold; color: #2b313d; margin-bottom: 5px; }
            .value { color: #555; margin-bottom: 15px; }
            .footer { text-align: center; padding: 20px; color: #999; font-size: 12px; }
            .icon { display: inline-block; width: 20px; margin-right: 8px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>🏢 Novo Contato - MHR Stands</h1>
                <p style='margin: 5px 0 0 0; font-size: 14px;'>Recebido em $data</p>
            </div>
            <div class='content'>
                <div class='info-box'>
                    <div class='label'>👤 Nome:</div>
                    <div class='value'>$nome</div>
                    
                    <div class='label'>📧 Email:</div>
                    <div class='value'><a href='mailto:$email' style='color: #11aaa2;'>$email</a></div>
                    
                    <div class='label'>📱 Telefone:</div>
                    <div class='value'>" . ($telefone ? $telefone : 'Não informado') . "</div>
                    
                    <div class='label'>💬 Mensagem:</div>
                    <div class='value' style='white-space: pre-wrap; background: #f5f5f5; padding: 15px; border-radius: 5px;'>$mensagem</div>
                </div>
                
                <p style='text-align: center; color: #11aaa2; font-weight: bold; margin-top: 20px;'>
                    ⚡ Responda o quanto antes para não perder esta oportunidade!
                </p>
            </div>
            <div class='footer'>
                <p>Este email foi enviado automaticamente pelo formulário de contato do site MHR Stands</p>
            </div>
        </div>
    </body>
    </html>
    ";
}

// Versão texto puro (fallback)
function montarEmailTexto($nome, $email, $telefone, $mensagem) {
    $data = date('d/m/Y H:i');
    $telefoneTexto = $telefone ? $telefone : 'Não informado';
    
    return "
NOVO CONTATO - MHR STANDS
Recebido em: $data

Nome: $nome
Email: $email
Telefone: $telefoneTexto

Mensagem:
$mensagem

---
Este email foi enviado automaticamente pelo formulário de contato do site MHR Stands
    ";
}
?>
