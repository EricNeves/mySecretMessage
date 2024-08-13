<h4 align="center">
  <br />
  <img src="resources/github/icon.png">
  <br />
    My Secret Message
  <br />
</h4>

<p align="center">
</p>

<p align="center">
  Projeto web desenvolvido com <strong>PHP</strong> e <strong>Angular</strong>, implementando melhorias na estrutura da aplicação em <strong>PHP</strong> através do uso de um dos modelos da <strong>Arquitetura Limpa</strong>, conhecido como <strong>Ports and Adapters</strong> ou <strong>Arquitetura Hexagonal</strong>.
</p>

<p align="center">Data de criação: Aug 4, 2024</p>

#### Intro 📃

My Secret Message é um projeto web desenvolvido com PHP e Angular que consiste no compartilhamento de uma mensagem secreta, que necessita de uma secret key para ser visualizada, além do mais, a mensagem possui um tempo de expiração que pode ser definida pelo criado da mensagem.


Esse projeto traz como principal feature a implementação de um dos modelos de Arquitetura Limpa conhecido porpulamente como Hexagonal ou Ports and Adapters.

Essa modelo arquitetônico tem como principal recurso a utilização de Portas e Adaptadores, mas afinal, o que isso significa ?

> [!NOTE] 
> 
> Exemplo - Maria comprou um cartão microSD para usar em sua câmera fotográfica, mas ao tentar inseri-lo, percebeu que sua câmera suporta apenas cartões SD de tamanho padrão. Para resolver o problema, Maria foi até uma loja de informática e adquiriu um adaptador de microSD para SD, permitindo que o cartão funcionasse perfeitamente em sua câmera.
>
> 

Esse exemplo ilustra perfeitamente o conceito de Ports and Adapters na arquitetura de software. No contexto do sistema, as 'portas' representam interfaces ou pontos de entrada e saída definidos, enquanto os 'adaptadores' são responsáveis por conectar diferentes componentes do sistema, permitindo que trabalhem juntos, mesmo que usem formatos ou tecnologias diferentes. 

No âmbito da aplicação, posso ter dentro das regras de negócio um cadastro de usuário que utiliza uma interface UserRepositoryPort (ports/out) e como adpatador posso implementar o recurso UserPostgresRepository (adapters/out), isso me dá o poder de implementar diferentes tipos de banco de dados, seja em memória, SQL, NoSQL e entre outros. Isso possibilita que a minha aplicação esteja flexivel à mudanças.

> [!NOTE] 
> Citação - Livro Arquitetura Limpa - O software deve ser tão agnóstico em sua forma quanto prática.
>
> 