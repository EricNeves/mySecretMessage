<h4 align="center">
  <br />
  <img src="resources/github/icon.png">
  <br />
    My Secret Message
  <br />
</h4>

<p align="center">
  <img src="https://img.shields.io/github/last-commit/EricNeves/mySecretMessage?style=flat-square&logo=github&logoColor=white&color=blue&labelColor=%23102C57">
  <img src="https://img.shields.io/github/languages/top/ericneves/mySecretMessage?style=flat-square&logo=php&logoColor=%23f3f3f3&label=%20PHP&color=%23379777&labelColor=%23333">
  <img src="https://img.shields.io/github/license/ericneves/mySecretMessage?style=flat-square&logo=git&logoColor=%23F4CE14&labelColor=%230d1117&color=%23F4CE14">
</p>

<p align="center">
  Projeto web desenvolvido com <strong>PHP</strong> e <strong>Angular</strong>, implementando melhorias na estrutura da aplicação em <strong>PHP</strong> através do uso de um dos modelos da <strong>Arquitetura Limpa</strong>, conhecido como <strong>Ports and Adapters</strong> ou <strong>Arquitetura Hexagonal</strong>.
</p>

<p align="center">Data de criação: Aug 4, 2024</p>

https://github.com/user-attachments/assets/7884329d-ccad-4ae3-b954-28686556a9ba

#### Intro 📃

**My Secret Message** é um projeto web desenvolvido com **PHP** e **Angular**, projetado para o compartilhamento seguro de mensagens secretas. Para acessar a mensagem, o destinatário precisa de uma chave secreta (**secret key**), garantindo que apenas pessoas autorizadas possam visualizá-la. Além disso, o criador da mensagem pode definir um tempo de expiração, após o qual a mensagem se torna inacessível, proporcionando uma camada adicional de segurança e controle.


Esse projeto traz como principal **feature** a implementação de um dos modelos de **Arquitetura Limpa** conhecido porpulamente como **Hexagonal** ou **Ports** and **Adapters**.

Esse modelo arquitetônico tem como principal recurso a utilização de **Portas** e **Adaptadores**, mas afinal, o que isso significa ?

> [!NOTE] 
> 
> **Exemplo** - Maria comprou um cartão microSD para usar em sua câmera fotográfica, mas ao tentar inseri-lo, percebeu que sua câmera suporta apenas cartões SD de tamanho padrão. Para resolver o problema, Maria foi até uma loja de informática e adquiriu um adaptador de microSD para SD, permitindo que o cartão funcionasse perfeitamente em sua câmera.
>
> 

Esse exemplo ilustra perfeitamente o conceito de **Ports** and **Adapters** na arquitetura de software. No contexto do sistema, as **portas** representam interfaces ou pontos de entrada e saída definidos, enquanto os **adaptadores** são responsáveis por conectar diferentes componentes do sistema, permitindo que trabalhem juntos, mesmo que usem formatos ou tecnologias diferentes. 

Na estrutura da aplicação, as regras de negócio podem incluir um sistema de cadastro de usuários que utiliza a interface **UserRepositoryPort** (**ports/out**). Como adaptador, posso implementar o repositório **UserPostgresRepository** (**adapters/out**), o que me dá a flexibilidade de integrar diferentes tipos de bancos de dados, como em **memória**, **SQL**, **NoSQL**, entre outros. Isso torna a aplicação altamente flexível e preparada para mudanças futuras, permitindo a substituição ou adição de novas tecnologias sem impactar a lógica central do sistema.

> [!NOTE]
> **Citações Relacionadas**
>  
> - **Livro Arquitetura Limpa**: "Portanto, as arquiteturas devem ser tão agnósticas em sua forma quanto práticas."
> - **Livro Arquitetura Limpa**: "A dificuldade em realizar uma mudança deve ser proporcional apenas ao escopo da mudança e não à forma da mudança."
> - **Livro Arquitetura Limpa**: "A arquitetura representa decisões significativas de design que moldam um sistema, onde a significância é medida pelo custo de mudança."
>

#### Features 🔭

Abaixo está a lista de **tecnologias** e **recursos** utilizados neste projeto, juntamente com a implementação da **infraestrutura** da API. Importante destacar que a API foi desenvolvida sem o uso de **frameworks**, utilizando exclusivamente **PHP**.

- API
  - PHP:8.2
    - Hexagonal Architecture
    - Routes
    - Request/Response
    - Controllers
    - Middlewares
    - JWT
    - Libraries
        - phpunit/phpunit:10.5
        - vlucas/phpdotenv:5.6
        - predis/predis:2.2
        - ramsey/uuid:4.7
  - PostgreSQL:15.4
  - Redis:latest
- Web
  - Angular:17
    - Routes
    - Guards
    - Interceptors
    - Services
    - Events
  - Libraries
    - typescript:5.4
    - primeflex:3.3
    - primeicons:7
    - primeng:17.8
- DevOps
  - Docker
  - Docker Compose

#### How to use ? 💡

> [!NOTE]
>
> Para garantir a execução bem-sucedida da aplicação, é essencial seguir os passos abaixo.
>

```sh

# project dir
$ cd mySecretMessage

# install web dependencies
$ cd web && pnpm install

# install www dependencies
$ cd www && composer install && cp .env.exemple .env

# run docker
$ cd ./mySecretMessage && docker compose -f "docker-compose.yml" up -d --build

```

#### Tests 🔋

```sh

# unit tests
$ cd www && composer test:unit

# integration tests
$ cd www && composer test:integration

```

#### Author 🦆

<table>
  <tr>
    <td align="center">
      <a href="https://www.instagram.com/ericneves_dev/">
        <img src="https://avatars.githubusercontent.com/u/32256029" width="100px;" alt=""/>
        <br />
        <sub>
          <b>Eric Neves</b>
        </sub>
      </a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="https://www.instagram.com/ericneves_dev/">
        <img src="https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white" width="100%">
      </a> 
      <br />
      <a href="https://linkedin.com/in/ericnevesrr"> 
        <img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white" width="100%">
      </a>
    </td>
  </tr>
</table>

#### License 📋

<img src="https://img.shields.io/github/license/ericneves/mySecretMessage?style=flat-square&logo=git&logoColor=%23F4CE14&labelColor=%230d1117&color=%23F4CE14">
