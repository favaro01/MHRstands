# MHR Stands - Website

## 🚀 Instalação do Sistema de Email

### 1. Instalar o PHPMailer via Composer

```bash
composer install
```

Se não tiver o Composer instalado, baixe em: https://getcomposer.org/

### 2. Configurar o Email SMTP

Edite o arquivo `enviar-email.php` na linha 41 e configure:

```php
$config = [
    'smtp_host' => 'smtp.gmail.com',           // Servidor SMTP
    'smtp_port' => 587,                        // Porta (587 = TLS, 465 = SSL)
    'smtp_secure' => 'tls',                    // TLS ou SSL
    'smtp_user' => 'seu-email@gmail.com',      // Seu email
    'smtp_pass' => 'sua-senha-app',            // Senha de app
    'from_email' => 'seu-email@gmail.com',     // Email de envio
    'from_name' => 'MHR Stands - Site',        // Nome do remetente
    'to_email' => 'contato@mhrstands.com.br',  // Email que recebe
    'to_name' => 'MHR Stands'                  // Nome do destinatário
];
```

### 3. Configurar Gmail (se usar Gmail)

#### Opção A: Senha de App (Recomendado)
1. Ative a verificação em 2 etapas: https://myaccount.google.com/security
2. Gere uma senha de app: https://myaccount.google.com/apppasswords
3. Use essa senha no campo `smtp_pass`

#### Opção B: Permitir apps menos seguros (Não recomendado)
1. Acesse: https://myaccount.google.com/lesssecureapps
2. Ative "Permitir apps menos seguros"

### 4. Outros Provedores de Email

#### Office 365 / Outlook
```php
'smtp_host' => 'smtp-mail.outlook.com',
'smtp_port' => 587,
'smtp_secure' => 'tls',
```

#### Hostinger
```php
'smtp_host' => 'smtp.hostinger.com',
'smtp_port' => 587,
'smtp_secure' => 'tls',
```

#### Locaweb
```php
'smtp_host' => 'smtp.umbler.com',
'smtp_port' => 587,
'smtp_secure' => 'tls',
```

## 📧 Como funciona

1. Cliente preenche o formulário no site
2. JavaScript envia os dados via AJAX para `enviar-email.php`
3. PHP processa e envia o email via SMTP usando PHPMailer
4. Retorna uma resposta JSON com sucesso ou erro
5. Site exibe mensagem de confirmação

## ✨ Recursos

- ✅ Email em HTML com design profissional
- ✅ Email alternativo em texto puro
- ✅ Validação de campos
- ✅ Proteção contra spam
- ✅ CORS habilitado
- ✅ Suporte a fallback (mail() nativo do PHP)
- ✅ Mensagens de erro amigáveis

## 🔧 Troubleshooting

### Erro: "Could not instantiate mail function"
- Instale o PHPMailer: `composer install`

### Erro: "SMTP connect() failed"
- Verifique as credenciais SMTP
- Confira se a porta está correta
- Teste se o firewall está bloqueando

### Email não chega
- Verifique a pasta de spam
- Confirme que o email destinatário está correto
- Teste com outro provedor de email

## 📝 Licença

© 2024 MHR Stands. Todos os direitos reservados.
