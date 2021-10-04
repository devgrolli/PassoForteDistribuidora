@extends('adminlte::page')

@section('plugins.Sweetalert2', true)

@section('js')
    <script>
        function ConfirmaExclusao(id) {
            swal.fire({
                title: 'Confirma a exclusão?',
                text: "Esta ação não poderá ser revertida!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#035c77',
                cancelButtonColor: '#e76800',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar!',
                closeOnConfirm: false,
            }).then(function(isConfirm) {
                if (isConfirm.value) {
                    $.get('/' + @yield('table-delete') + '/' + id + '/destroy', function(data) {
                        console.log(data);
                        if (data.status == 200) {
                            swal.fire(
                                'Deletado!',
                                'Exclusão confirmada.',
                                'success'
                            ).then(function(isConfirm) {
                                window.location.reload();
                            });
                        } else
                            swal.fire(
                                'Erro!',
                                'Ocorreram erros na exclusão. Entre em contato com o suporte.',
                                'error'
                            );
                    });
                }
            })
        }

        function editarModal(id) {
            $.getJSON('/' + @yield('table-delete') + '/edit/' + id, function(data) {
                $('.id-div').val(data.id);
                switch (@yield('table-delete')) {
                case 'produtos':
                    $('.nome-div').val(data.nome);
                    $('.un-div').val(data.unidade);
                    $('.marca-div').val(data.marca);
                    $('.select_search').val(data.categorias_id);
                    break;
                case 'usuarios':
                    $('.nome-div').val(data.name);
                    $('.email-div').val(data.email);
                    break;
                default:
                    $('.nome-div').val(data.nome);
                    $('.descricao-div').val(data.descricao);
                }
            }).fail(function() {
                swal.fire(
                    'Erro!',
                    'Ocorreu um erro ao processar os dados, contate o suporte.',
                    'error'
                );
            });
        }
    </script>
@stop
