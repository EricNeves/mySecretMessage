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