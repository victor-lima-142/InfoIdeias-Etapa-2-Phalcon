{% extends 'layouts/index.volt' %}

{% block content %}

<div id="cadastro_ticket" class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-plus"></i>
                &nbsp;Editar Noticia
            </div>
            {% for dado in dados %}
            {{ form('noticias/atualiza', 'method': 'post', 'enctype' : 'multipart/form-data',
            'name':'atualizar') }}
            <div class="panel-body">
                <div class="col-md-12" id="conteudo">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <p><strong>Data de Criação: </strong>{{ dado.data_cadastro }}</p>
                                    <p><strong>Data da Última Atualização: </strong>{{dado.data_ultima_atualizacao}}</p>
                                </div>
                            </div>
                            <div class="row" id="codigo">
                                <div class="form-group col-sm-12">
                                    <label for="id">Código</label>
                                    <input type="text" name="id" value="{{ dado.id }}" width='100%'
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="Titulo">Título <span class="error">(*)<span></label>
                                    <input type="text" name="titulo" value="{{ dado.titulo }}" width='100%'
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="Texto">Texto</label>
                                    <textarea name="texto" class="form-control">{{ dado.texto }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="Categoria">Adicionar Categoria</label>
                                    <select name="categoria" class="form-control" id="categoria">
                                        <option selected value='0'>Escolher categoria</option>
                                        {% for categoria in categorias %}
                                        <option value="{{categoria.id}}">{{categoria.nome}}</option>
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>
                        </div>{#/.panel-body#}
                    </div>{#/.panel#}
                    <div class="row" style="text-align:right;">
                        <div id="buttons-cadastro" class="col-md-12">
                            <a href="{{ url(['for':'noticia.lista']) }}" class="btn btn-default">Cancelar</a>
                            {{ submit_button('Gravar', "class": 'btn btn-primary') }}
                        </div>
                    </div>
                </div>{#/.conteudo#}
            </div>{#/.panel-body#}
            {{ end_form() }}
            {% endfor %}
        </div>{#/.panel#}
    </div>{#/.col-md-12#}
</div><!-- row -->

{% endblock %}

{% block extrafooter %}

<script>
    $(document).ready(function () {
        $("#codigo").hide();

    });
</script>
{% endblock %}