# API sistema interno

# Conhecimento Geral

Algumas informações na API é válida para o sistema inteiro, portanto você deve ter o conhecimento destes dados de antemão.

## Request Headers

1.  Authorization

    token recebido no login

        Authorization: Bearer <token-exemplo>


## Erros

Todas as respostas desta API com o HTTP Status Code diferente da categoria 2xx (200, 201 etc...) e 3xx são consideradas um erro. Todos os erros, com exceção de validações, possuem dentro do corpo da resposta o atributo `message` que indica a mensagem de erro. Exemplo:

        `{
            "message": "Esse recurso não existe, verifique a rota"
        }`

1. Erro 4xx -> erro de requisição
2. Erro 5xx -> erro interno

## Problemas no JSON enviado

Quando existe um problema na validação do JSON a API retorna:

1. HTTP Status Code 422 (Unprocessable Entity)
2. Content-Type: application/json
3. Array de mensagens por atributo errado

    Exemplo

           {
             "email": 
             [
               "The email field is required."
             ],
             
             "pass_user": [
               "The pass user field is required."
             ]
           
            

# Group Autenticação

### Login [POST /v1/login]

+ Request
    + Attributes
        + email: foo@bar.com (string, required) - E-mail de login do usuário [E-mail]
        + pass_user: 123abc (string, required) - Senha de acesso ao sistema [Senha de acesso]
        
+ Response 200
    + Attributes
        + token: `<token>` (string) - Token para as próximas requisições
        + name: Fernando Silva (string) - Nome do Usuário para a exibição dos dados
       
### Logout [GET /v1/logout]

+ Request
    + Headers

            Authorization: Bearer <token>
+ Response 200

# Group Customers 

### Cadastro [POST /v1/customers]

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>

    + Attributes (Customer)


+ Response 201 (application/json)
    
### Listagem [GET /v1/customers]

+ Request
    + Headers

            Authorization: Bearer <token>
        

+ Response  200 (application/json)

        
### Edição [PATCH /v1/customers/{id}]
+ Parameters

    + id: 1 (number)
    
+ Request
    + Headers

            Authorization: Bearer <token-exemplo>

    + Attributes (Customer)


+ Response 200 (application/json)
    + Attributes (Customer)
        
### Exclusão [DELETE /v1/customers/{id}]
+ Parameters

    + id: 1 (number)
+ Request
    + Headers

            Authorization: Bearer <token-exemplo>


+ Response 200 (application/json)

# Group Customers Group

### Cadastro [POST /customers_groups]

+ Request
    + Headers

            Authorization: Bearer <token>

    + Attributes (CustomerGroup)

+ Response  201 (application/json)
    
### Listagem [GET /customers_groups] 

+ Request
    + Headers

            Authorization: Bearer <token>
        

+ Response  200 (application/json)

        
# Group Fornecedores 

### Cadastro [POST /v1/providers] 

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>

    + Attributes (Provider)


+ Response 201 (application/json)
    + Attributes
        + provider (object)
            + id: 1 (number) - Id do fornecedor criado
        + message: Inclusão feita com sucesso! (string) - Mensagem de êxito

### Listagem [GET /v1/providers]


+ Request
    + Headers

            Authorization: Bearer <token-exemplo>


+ Response  200 (application/json)
  
### Edição [PATCH /v1/providers/{id}]
+ Parameters
    + id: `1` (number, required) - ID do fornecedor a ser editado

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>
    + Attributes (Provider)


+ Response 200 (application/json)
    + Attributes
        + provider (object)
            + id: 1 (number) - Id do fornecedor editado
        + message: Edição feita com sucesso! (string) - Mensagem de êxito

### Exclusão [DELETE /v1/providers/{id}]
+ Parameters
    + id: `1` (number, required) - ID do fornecedor a ser editado

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>


+ Response 200 (application/json)
    + Attributes
        + message: Exclusão feita com sucesso! (string) - Mensagem de êxito        

# Group Marca do Produto
### Cadastro [POST /v1/product_producers] 

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>

    + Attributes (ProductProducer)


+ Response 201 (application/json)
    + Attributes
        + productProducer (object)
            + id: 1 (number) - Id da marca criada
        + message: Inclusão feita com sucesso! (string) - Mensagem de êxito

### Listagem [GET /v1/product_producers]


+ Request
    + Headers

            Authorization: Bearer <token-exemplo>


+ Response  200 (application/json)
  
### Edição [PATCH /v1/product_producers/{id}]
+ Parameters
    + id: `1` (number, required) - ID do fornecedor a ser editado

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>
    + Attributes (ProductProducer)


+ Response 200 (application/json)
    + Attributes
        + productProducer (object)
            + id: 1 (number) - Id da marca criada
        + message: Edição feita com sucesso! (string) - Mensagem de êxito

### Exclusão [DELETE /v1/product_producers/{id}]
+ Parameters
    + id: `1` (number, required) - ID da marca a ser editado

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>


+ Response 200 (application/json)
    + Attributes
        + message: Exclusão feita com sucesso! (string) - Mensagem de êxito

# Group Modelo do Produto
### Cadastro [POST /v1/product_models] 

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>

    + Attributes (ProductModel)


+ Response 201 (application/json)
    + Attributes
        + productModels (object)
            + id: 1 (number) - Id do modelo criado
        + message: Inclusão feita com sucesso! (string) - Mensagem de êxito

### Listagem [GET /v1/product_models]


+ Request
    + Headers

            Authorization: Bearer <token-exemplo>


+ Response  200 (application/json)
  
### Edição [PATCH /v1/product_models/{id}]
+ Parameters
    + id: `1` (number, required) - ID do modelo a ser editado

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>
    + Attributes (ProductModel)


+ Response 200 (application/json)
    + Attributes
        + productModels (object)
            + id: 1 (number) - Id do modelo criado
        + message: Edição feita com sucesso! (string) - Mensagem de êxito

### Exclusão [DELETE /v1/product_models/{id}]
+ Parameters
    + id: `1` (number, required) - ID do modelo a ser excluido

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>


+ Response 200 (application/json)
    + Attributes
        + message: Exclusão feita com sucesso! (string) - Mensagem de êxito
        
# Group Equipamento
### Cadastro [POST /v1/equipments] 

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>

    + Attributes (Equipment)


+ Response 201 (application/json)
    + Attributes
        + equipment (object)
            + id: 1 (number) - Id do equipamento criado/instalado
        + message: Inclusão feita com sucesso! (string) - Mensagem de êxito

### Listagem [GET /v1/equipments]


+ Request
    + Headers

            Authorization: Bearer <token-exemplo>


+ Response  200 (application/json)
  
### Edição [PATCH /v1/equipments/{id}]
+ Parameters
    + id: `1` (number, required) - ID do equipamento a ser editado

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>
    + Attributes (Equipment)


+ Response 200 (application/json)
    + Attributes
        + equipment (object)
            + id: 1 (number) - Id do equipamento criado
        + message: Edição feita com sucesso! (string) - Mensagem de êxito

### Exclusão [DELETE /v1/equipments/{id}]
+ Parameters
    + id: `1` (number, required) - ID do equipamento a ser excluido

+ Request
    + Headers

            Authorization: Bearer <token-exemplo>


+ Response 200 (application/json)
    + Attributes
        + message: Exclusão feita com sucesso! (string) - Mensagem de êxito



## Data Structures

### Provider
+ tradeName: Fornecedor A (string, required) - Nome fantasia do fornecedor
+ companyName: Fornecedor A LTDA (string) - Razão Social do fornecedor
+ cityId: 9480 (number, required) - Id da cidade do fornecedor. Veja a sessão de localização desta documentação para saber como obter o cityId
+ logoUrl: http://www.acs.com.br (string) - Url para o logo do fornecedor
+ federalTaxId: 12345678889010 (string) - CNPJ do fornecedor
+ stateTaxId: 123456789 (string) - Inscrição Estadual do fornecedor
+ cityTaxId: 234567890 (string) - Inscrição Municipal do fornecedor
+ creationingDate: `2018-01-01` (string) - Data de criação do fornecedor
+ openingDate: `2018-01-01` (string) - Data de inauguração do fornecedor
+ balance: 1 (number) - Saldo em reais do fornecedor
+ address1: Av Paulista (string) - Endereço primário do fornecedor
+ address2: Av Brasil (string) - Endereço secundário do fornecedor
+ address3: Av Panamá (string) - Endereço terciário do fornecedor
+ addressNumber: 39 (number) - número do endereço do fornecedor
+ zipcode: 12040000 (string) - CEP do fornecedor
+ notes: O que dá desconto na madeira (string) - Observação geral do forncedor
+ statusId: 1 (number) - Id do status do fornecedor obtido em /v1/useful/status
+ contacts (array[ProviderContact], required)

### ProviderContact
+ description: O de camiseta azul (string) - Descrição do contato
+ phone: 1234567890 (string) - Telefone para contato
+ email: fabrio@fabio.com.br
+ name: Fabio (string, required)

### Customer

+ id: 1 (number) - ID
+ city (object)
    + id: 9480 (required, number)
    + stateId: 26 (number) - ID do estado
+ statusId: 1 (number) - Id do status do cliente
+ balance: 10.55 (number) - Saldo em reais
+ address1: Av Paulista (string) - Rua
+ address2: APTO 3 - Complemento do endereço
+ address3: Centro (string) - Bairro
+ addressNumber: 39 (number) - Número do endereço
+ zipcode: 1204000 (string) - CEP
+ notes: O filho do Joaquim (string) - Observações extras
+ name: Teste da Silva (string, required) - Nome completo (PF) | Nome fantasia (PJ)         
+ birthdate: `1990-12-01` (string) - Data de nascimento
+ nickname: Grande João (string) - Apelido (PF) | Razão Social (PJ)
+ logoUrl: http://www.acs.com.br (string) - Url para o logo 
+ stateTaxId: 123456789 (string) - Inscrição Estadual
+ cityTaxId: 234567890 (string) - Inscrição Municipal

### CustomerGroup

+ id: 1 (number) - ID
+ name: Exemplo (string) - Nome do grupo
+ color: Exemplo (string) - Cor
+ description: Descrição de exemplo (string) - Descrição do grupo

### ProductProducer 
+ id: 1 (number) - ID
+ name: Exemplo (string) - Nome do grupo

### ProductModel 
+ id: 1 (number) - ID
+ productProducerId: 1 (number) - ID da marca
+ model: Exemplo (string) - Modelo do equipamento

### Equipment
+ id: 1 (number) - ID
+ customerId: 1 (number) - ID do cliente
+ productProducerId: 1 (number) - ID da marca
+ productModelId: 1 (number) - ID do modelo
+ installAt: `2019-03-01` (string) - Data de instalação do equipamento
+ description: Exemplo (string) - Descrição do equipamento/instalação



    

