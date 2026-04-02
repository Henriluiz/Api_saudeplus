<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #f0f0f0;
            padding: 40px 20px;
            color: #333;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .header {
            background-color: #1a1a1a;
            padding: 32px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .body {
            padding: 40px 32px;
        }

        .greeting {
            font-size: 16px;
            color: #333;
            margin-bottom: 12px;
        }

        .description {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .code-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #999;
            margin-bottom: 10px;
        }

        .code-box {
            background-color: #f7f7f7;
            border: 1px dashed #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 16px;
        }

        .code {
            font-size: 36px;
            font-weight: 700;
            letter-spacing: 10px;
            color: #1a1a1a;
            font-family: 'Courier New', monospace;
        }

        .expiration {
            font-size: 13px;
            color: #e05c3a;
            text-align: center;
            margin-bottom: 32px;
        }

        .divider {
            border: none;
            border-top: 1px solid #eeeeee;
            margin-bottom: 24px;
        }

        .warning {
            font-size: 13px;
            color: #999;
            line-height: 1.6;
        }

        .footer {
            background-color: #fafafa;
            padding: 20px 32px;
            text-align: center;
            font-size: 12px;
            color: #bbb;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h1>Recuperação de Conta</h1>
        </div>

        <div class="body">
            <p class="greeting">Olá, {{ $nomeUsuario }}!</p>
            <p class="description">
                Recebemos uma solicitação para recuperar o acesso à sua conta.
                Use o código abaixo para redefinir sua senha.
            </p>

            <p class="code-label">Seu código de verificação</p>
            <div class="code-box">
                <span class="code">{{ $codigo }}</span>
            </div>

            <p class="expiration">
                ⏱ Este código expira em {{ $expiracaoMinutos }} minutos.
            </p>

            <hr class="divider">

            <p class="warning">
                Se você não solicitou a recuperação de conta, ignore este e-mail.
                Sua senha permanecerá a mesma.
            </p>
        </div>

        <div class="footer">
            Este é um e-mail automático, por favor não responda.
        </div>

    </div>
</body>
</html>