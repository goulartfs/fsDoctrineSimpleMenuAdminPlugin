# fsDoctrineSimpleMenuAdminPlugin

Esse plugin é para fácil administração de menu utilizando jQueryUi e Bootstrap

## Instalação e Configuração

### Instalação

Copie o diretório deste plugin para o diretório de plugins do Symfony.


### Configuração

Ative o plugin na classe projectConfiguration do projeto0:

    public function setup()
    {
      $this->enablePlugins('fsDoctrineSimpleMenuAdminPlugin');
    }

Caso não esteja utilizando o jqueryUi e/ou bootstrap na publique os assets do plugin, estará disponível na /web os arquivos js e css:

    php symfony plugin:publish-assets

Adicione os arquivo js e css do plugin para o funcionamento.
Para o funcionamento correto é obrigatório a inclusão do menu.admin.js

Exemplo do código:

    javascripts:    [/fsDoctrineSimpleMenuAdminPlugin/js/menu.admin.js]

Para adição de listagem de modelos e módulos na administração do menu é necessário adicionar configuração ao app.yml 
seguindo devidamente os parametros abaixo

app.yml
--------

all:
  fsmenu:
    model:  #blocos geraros a partir de modelos deve pertencer a este array
      "page":                           #tipo do modelo
        title: Páginas                  #Título que aparecerá no box de seleção
        model: Page                     #Model que será buscado a lista de objetos
        value: getAnchor                #Getter que será utilizado para o value do option e geração da rota
        option: getTitle                #Getter que será utilizado para printar a label do option
        route: '@load_page?anchor='     #Rota que será gerado o link ao renderizar o menu
      "document": 
        title: Documentos
        model: Document
        value: getId
        option: getLocationType
        route: '/uploads/'
        alter_option_label: [Termos e Condições, Política de Privacidade] #[Opcional] Array com label alternativo de option
        is_generated_after: 1           #[Opcional] True se a geração da rota será realizada no momento em que o menu é renderizado, o valor retornado será o toString da classe
    module: #blocos gerados a partir de módulos
      "Biblioteca": { title: Biblioteca, route: "@biblioteca" } #title = Label da option / route = Value da option, rota que será gerada na renderização do menu
      "Contato": { title: Contato, route: "@contato" }
