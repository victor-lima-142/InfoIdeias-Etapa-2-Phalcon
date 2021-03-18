{% extends 'layouts/index.volt' %}

{% block extrafooter %}
<link href="{{ static_url(" css/datatables.min.css") }}" rel="stylesheet">
{% endblock %}

{% block content %}
<div class="row">
    <div class="col-md-12" id="conteudo">
        <!-- <div class="col-md-6 col-sm-6"> -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- <a href="#" class="pull-right">View all</a> -->
                <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                &nbsp;Notícias
                <form class="navbar-form navbar-right" id="search_ticket" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                            <input id="dataTableSearch" type="text" class="form-control" placeholder="Search">
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <a id="button-abrir-ticket" href="{{ url(['for':'noticia.cadastrar']) }}"
                        class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Nova
                        Noticia</a>

                </div>
                <table id="lista-noticia" class="table dataTable table-hover">
                    <thead>
                        <tr>
                            <td class="text-center">Cod</td>
                            <td class="text-center">Titulo</td>
                            <td class="text-center">Texto</td>
                            <td class="text-center">Ações</td>
                            <td class="text-center">Dt. Publicacao</td>
                        </tr>
                    </thead>
                    <tbody>
                        {% for noticia in noticias %}

                        <tr>
                            <td class="text-center"><a href="#">{{noticia.id}}</a></td>
                            <td class="titulo text-center">{{noticia.titulo}}</td>
                            <td class="text-center">{{noticia.texto}}</td>
                            <td class="text-center">
                                <a href="/noticias/editar/{{noticia.id}}">
                                    <span class=" glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="/noticias/excluir/{{noticia.id}}">
                                    <span class=" glyphicon glyphicon-remove-sign"></span>
                                </a>
                                {% if noticia.publicado == 0 %}
                                <button class="btn btn-submit" value="{{noticia.id}}" type="submit">
                                    <input type="checkbox" disabled value="{{noticia.id}}">
                                </button>
                                {% endif %}
                                {% if noticia.publicado != 0 %}
                                <button class="btn btn-submit-despublica" value="{{noticia.id}}" type="submit">
                                    <input type="checkbox" checked disabled value="{{noticia.id}}">
                                </button>
                                {% endif %}
                            </td>
                            <td class="text-center">
                                {% if noticia.publicado == 0 %}
                                <span>Não publicado</span>
                                {% endif %}
                                {% if noticia.publicado != 0 %}
                                {{noticia.data_publicado}}
                                {% endif %}
                            </td>
                        </tr>

                        {% endfor %}

                    </tbody>
                </table>
            </div><!-- panel-body -->
        </div>
    </div>
</div><!-- row -->

{% endblock %}

{% block extrafooter %}


<script>

    $(document).ready(function () {
        $('.btn-submit').click(function () {
            var direcao = '/noticias/publica/' + this.value;
            var idNoticia = this.value

            $.ajax({
                url: direcao,
                type: 'POST',
                data: {
                    id: idNoticia
                },
                dataType: "json",
                success: function (response) {
                    console.log(response)
                },
                error: function (response) {
                    console.log(response)
                }
            });
            location.reload();
        });


        $(".btn-submit-despublica").click(function () {
            var direcao = '/noticias/despublica/' + this.value;
            var idNoticia = this.value
            $.ajax({
                url: direcao,
                type: 'POST',
                data: {
                    id: idNoticia
                },
                dataType: "json",
                success: function (response) {
                    console.log(response)
                },
                error: function (response) {
                    console.log(response)
                }
            });
            location.reload();
        })
    });
</script>


{% endblock %}