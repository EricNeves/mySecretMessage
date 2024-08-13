<h4 align="center">
  <br />
  <img src="resources/github/icon.png">
  <br />
    My Secret Message
  <br />
</h4>

<p align="center">
  <img src="https://img.shields.io/github/last-commit/ericneves/myFavoriteBooks?display_timestamp=author&style=for-the-badge&logo=github" alt="Github">
  <img src="https://img.shields.io/github/languages/count/ericneves/myFavoriteBooks?style=for-the-badge&logo=rocket&color=%23F5455C">
  <img src="https://img.shields.io/github/languages/top/ericneves/myFavoriteBooks?style=for-the-badge&logo=PHP&logoColor=%23fff&labelColor=%23777BB4&color=%23333">
  <img src="https://img.shields.io/github/license/ericneves/myFavoriteBooks?style=for-the-badge&logo=git&logoColor=%23C71D23&color=%23C71D23">
</p>

<video width="600" align="center" controls>
  <source src="resources/github/record.webm" type="video/webm">
  Seu navegador não suporta a tag de vídeo.
</video>

<p align="center">
  Projeto web desenvolvido com <strong>PHP</strong> e <strong>Angular</strong>, implementando melhorias na estrutura da aplicação em <strong>PHP</strong> através do uso de um dos modelos da <strong>Arquitetura Limpa</strong>, conhecido como <strong>Ports and Adapters</strong> ou <strong>Arquitetura Hexagonal</strong>.
</p>

<p align="center">Data de criação: Aug 4, 2024</p>

#### Intro 📃

My Secret Message é um projeto web desenvolvido com PHP e Angular, trazendo como principal feature a implementação de um dos modelos de Arquitetura Limpa conhecido porpulamente como Hexagonal ou Ports and Adapters.

Essa modelo arquitetônico tem como principal recurso a utilização de Portas e Adaptadores, mas afinal, o que isso significa ?

> [!NOTE] Exemplo
> Maria comprou um cartão microSD para usar em sua câmera fotográfica, mas ao tentar inseri-lo, percebeu que sua câmera suporta apenas cartões SD de tamanho padrão. Para resolver o problema, Maria foi até uma loja de informática e adquiriu um adaptador de microSD para SD, permitindo que o cartão funcionasse perfeitamente em sua câmera.
>

Esse exemplo ilustra perfeitamente o conceito de Ports and Adapters na arquitetura de software. No contexto do sistema, as 'portas' representam interfaces ou pontos de entrada e saída definidos, enquanto os 'adaptadores' são responsáveis por conectar diferentes componentes do sistema, permitindo que trabalhem juntos, mesmo que usem formatos ou tecnologias diferentes. 

No âmbito da aplicação, posso ter dentro das regras de negócio um cadastro de usuário que utiliza uma interface UserRepositoryPort (ports/out) e como adpatador posso implementar o recurso UserPostgresRepository (adapters/out),  