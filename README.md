cli-server
==========
**Experiências com o servidor embutido do PHP.**

Veja esse vídeo http://youtu.be/0AC99SBbdgM

No exemplo do video eu copiei o arquivo já compilado "power.phar" para uma pasta (somente este arquivo é usado).
Em seguida criei um atalho para a área de trabalho do Windows com o seguinte comando:

    php power.phar
    
Depois é só clicar no atalho (como no video).

**Lembre-se que esse script só funcionará no Windows**

:)
==

A intenção aqui é construir aplicações de **desktop** rodando no server embutido do **PHP**.

Se tiver alguma **idéia** faça um **fork** e depois um **pull request** que será publicado.

:P
==
**Compilando e rodando o projeto**


A aplicação em si é composta somente pelos arquivos 'index.php' e as pastas 'php', 'style' e 'script'. Depois de testado em um servidor comum ou no próprio PHP builtin server você pode compilar em Phar usando (por exemplo) este compilador https://github.com/pedra/makephar .

Para facilitar os teste crie um host próprio adicionando a seguinte linha no final do arquivo HOSTS do windows. Geralmente este arquivo fica em C:\Windows\System32\drivers\etc\hosts.

    127.0.0.2 power.off

Depois, abra o terminal e digite:

    cd /pasta/do/projeto
    explorer http://power.off
    php -S power.off:80
    
O seu navegador default será aberto e a página inicial do projeto será exibida. Acompanhe no terminal as informações e possíveis erros. Para parar o servidor digite "CTRL + C" sobre o terminal.



