# Projeto API Restful para Pastelaria

Esta api trabalha com informações de **Cliente**, **Pastel** e **Pedido**, e seus devidos relacionamentos.

### Informações Úteis
Esta é uma API Restful, logo, trabalha com os métodos GET | POST | PUT/PATCH | DELETE.

Todas as tabelas utilizando o recurso de SoftDeletes, para preservar os dados mesmo quando deletados.

A aplicação que consumirá a API deve ter implementado em seus Headers o ```Accept application/json```, para indicar que sabe lidar com retorno json (devido às validações realizadas pela API Restful)

O projeto trabalha com timezone America/Sao_Paulo.

### Requisitos
```PHP >= 7.3```

## Para instalar

Após realizar o clone do repositório:

- Instale as dependências do Composer;
- Copie o arquivo env.example para .env e crie uma chave para a aplicação com ```php artisan key:generate```;
- Configure um e-mail que será o remetente das notifications enviadas;

Preencher estes campos do .env com seus dados:
```
MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
```

OBS: substitua os campos pelos seus dados de e-mail.

Ao configurar os parâmetros do arquivo .env, rode as migrations e as seeders com ```php artisan migrate --seed```

## Utilização

A o banco de dados da API possui três tabelas já definidas nas migrations: Cliente, Pastel e Pedido.

- Cliente: id, nome, email, telefone, data de nascimento, endereço, complemento, bairro, cep, data de cadastro, created_at e updated_at;
- Pastel: id, nome, preco, foto, created_at e updated_at;
- Pedido: cliente_id, pastel_id, created_at e updated_at;

O primeiro passo para utilização é criar um link do diretório storage para o diretório public da aplicação com o comando ```php artisan storage:link```. Dessa forma as imagens estarão disponíveis na internet quando o deploy for realizado.

