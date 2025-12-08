# 📧 CONFIGURAÇÃO DO EMAIL - MHR Stands

## ✅ Sistema já instalado e pronto para usar!

### 📝 PASSO 1: Configurar suas credenciais de email

Abra o arquivo `enviar-email.php` e edite as linhas 41-50:

```php
$config = [
    'smtp_host' => 'smtp.gmail.com',           // ⬅️ Seu servidor SMTP
    'smtp_port' => 587,                        // ⬅️ Porta (587 para TLS)
    'smtp_secure' => 'tls',                    // ⬅️ TLS ou SSL
    'smtp_user' => 'seu-email@gmail.com',      // ⬅️ SEU EMAIL AQUI
    'smtp_pass' => 'sua-senha-app',            // ⬅️ SUA SENHA AQUI
    'from_email' => 'seu-email@gmail.com',     // ⬅️ Email que vai enviar
    'from_name' => 'MHR Stands - Site',        // ⬅️ Nome do remetente
    'to_email' => 'contato@mhrstands.com.br',  // ⬅️ Email que vai receber
    'to_name' => 'MHR Stands'                  // ⬅️ Nome do destinatário
];
```

---

## 🔐 PASSO 2: Configurar Gmail (se usar Gmail)

### Opção 1: Senha de App (RECOMENDADO e MAIS SEGURO)

1. **Ative a verificação em 2 etapas:**
   - Acesse: https://myaccount.google.com/security
   - Clique em "Verificação em duas etapas"
   - Siga as instruções para ativar

2. **Gere uma senha de app:**
   - Acesse: https://myaccount.google.com/apppasswords
   - Selecione "App: Email" e "Dispositivo: Outro"
   - Digite "MHR Stands Website"
   - Clique em "Gerar"
   - **Copie a senha de 16 caracteres gerada**
   - Cole essa senha no campo `smtp_pass` do arquivo `enviar-email.php`

### Opção 2: Permitir apps menos seguros (NÃO RECOMENDADO)

1. Acesse: https://myaccount.google.com/lesssecureapps
2. Ative "Permitir apps menos seguros"

⚠️ **ATENÇÃO:** Esta opção é menos segura e pode não funcionar em contas novas.

---

## 📨 Outros Provedores de Email

### Microsoft / Outlook / Office 365
```php
'smtp_host' => 'smtp-mail.outlook.com',
'smtp_port' => 587,
'smtp_secure' => 'tls',
'smtp_user' => 'seu-email@outlook.com',
'smtp_pass' => 'sua-senha',
```

### Hostinger
```php
'smtp_host' => 'smtp.hostinger.com',
'smtp_port' => 587,
'smtp_secure' => 'tls',
'smtp_user' => 'contato@seudominio.com',
'smtp_pass' => 'sua-senha',
```

### Locaweb
```php
'smtp_host' => 'smtp.locaweb.com.br',
'smtp_port' => 587,
'smtp_secure' => 'tls',
'smtp_user' => 'contato@seudominio.com',
'smtp_pass' => 'sua-senha',
```

### Titan (GoDaddy)
```php
'smtp_host' => 'smtp.titan.email',
'smtp_port' => 587,
'smtp_secure' => 'tls',
'smtp_user' => 'contato@seudominio.com',
'smtp_pass' => 'sua-senha',
```

---

## 🧪 PASSO 3: Testar o envio

1. Abra o site `index.html` em seu navegador
2. Preencha o formulário de contato
3. Clique em "Enviar Mensagem"
4. Verifique se aparece a mensagem de sucesso
5. Confira sua caixa de entrada (e spam) do email configurado

---

## ✨ Funcionalidades

✅ Envio via SMTP (100% confiável)  
✅ Email em HTML com design profissional  
✅ Validação de campos obrigatórios  
✅ Mensagens de erro e sucesso  
✅ Loading durante o envio  
✅ Proteção contra spam  
✅ Responsivo (mobile friendly)  

---

## 🐛 Solução de Problemas

### "Erro ao enviar mensagem"

**Causa:** Credenciais incorretas ou servidor SMTP bloqueado

**Solução:**
- Verifique se o email e senha estão corretos
- Use senha de app se for Gmail
- Verifique se a porta 587 não está bloqueada pelo firewall
- Teste com outro provedor de email

---

### "SMTP connect() failed"

**Causa:** Não consegue conectar ao servidor SMTP

**Solução:**
- Verifique se o `smtp_host` está correto
- Confirme se a porta está correta (587 para TLS, 465 para SSL)
- Teste mudar `smtp_secure` de 'tls' para 'ssl' e a porta para 465
- Verifique se seu servidor web permite conexões externas

---

### Email não chega

**Causa:** Email pode estar no spam ou configuração incorreta

**Solução:**
- Verifique a pasta de SPAM/Lixo eletrônico
- Confirme se o `to_email` está correto
- Adicione o email remetente aos contatos
- Teste enviar para outro email

---

### "Call to undefined function PHPMailer..."

**Causa:** PHPMailer não foi instalado corretamente

**Solução:**
- Verifique se a pasta `phpmailer` existe
- Dentro dela deve ter a pasta `src` com os arquivos PHP
- Se não tiver, baixe manualmente: https://github.com/PHPMailer/PHPMailer/releases

---

## 📂 Estrutura de Arquivos

```
MHRstands/
├── index.html          ← Página principal com formulário
├── enviar-email.php    ← Script de envio (CONFIGURE AQUI)
├── phpmailer/          ← Biblioteca PHPMailer
│   └── src/
│       ├── PHPMailer.php
│       ├── SMTP.php
│       └── Exception.php
└── README.md           ← Instruções gerais
```

---

## 🚀 Deploy em Servidor

1. **Upload dos arquivos:**
   - Envie todos os arquivos via FTP/SFTP para seu servidor
   - Mantenha a estrutura de pastas

2. **Permissões:**
   - Arquivos: 644 (rw-r--r--)
   - Pastas: 755 (rwxr-xr-x)

3. **Teste:**
   - Acesse seu site e teste o formulário
   - Verifique os logs de erro do PHP se necessário

---

## 🔒 Segurança

⚠️ **IMPORTANTE:** Nunca compartilhe suas senhas ou credenciais SMTP

✅ Use senhas de app quando possível  
✅ Mantenha o `enviar-email.php` protegido  
✅ Não versione senhas no Git  
✅ Use HTTPS em produção  

---

## 💡 Dicas Finais

- O PHPMailer já está incluído no projeto (pasta `phpmailer`)
- Não precisa instalar Composer ou bibliotecas adicionais
- Funciona em qualquer servidor com PHP 7.0+
- Compatível com hospedagens compartilhadas

---

## 📞 Suporte

Se tiver problemas, verifique:
1. As credenciais estão corretas?
2. O servidor permite conexões SMTP?
3. A porta 587 está liberada?
4. Testou com outro email?

---

**Desenvolvido para MHR Stands**  
© 2024 - Todos os direitos reservados
