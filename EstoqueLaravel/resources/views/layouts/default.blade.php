@extends('adminlte::page')
    
@section('plugins.Sweetalert2', true)
    
@section('js')
    <script>
        function ConfirmaExclusao(id) {
            swal.fire({
                title: 'Confirma a exclusão?', text: "Esta ação não poderá ser revertida!",
                type: 'warning', showCancelButton: true, confirmButtonColor: '#035c77',
                cancelButtonColor: '#e76800', confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar!', closeOnConfirm: false, 
            }).then(function(isConfirm) {
                if (isConfirm.value) {
           		 	$.get('/'+ @yield('table-delete') +'/'+id+'/destroy', function(data){
                        console.log(data);
                        if (data.status == 200) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                    });

                                    $.ajax({
                                        url: '/'+ @yield('table-delete') +'/'+id+'/stock',
                                        type: 'POST',
                                        method: 'POST',
                                        dataType: 'json',
                                        ContentType: 'application/json',
                                        data: {
                                            id: id,
                                            _token: '{!! csrf_token() !!}',
                                        },    
                                        success: function (response) {
                                            var json = $.parseJSON(response);
                                                console.log(json);
                                        },error:function(response){ 
                                            console.log(response);
                                            console.log("ERROR");
                                        }
                                    });
    
                            // $.post({
                            //     beforeSend: function(xhr, type) {
                            //         if (!type.crossDomain) {
                            //             xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                            //         }
                            //     },
                            //     url: '/'+ @yield('table-delete') +'/'+id+'/stock',
                            //     dataType : 'json',
                            //     type: 'POST',
                            //     data: { 
                            //         id: id,
                            //         _token: '{{csrf_token()}}' 
                            //     },
                            //     contentType: false,
                            //     processData: false,
                            //     success:function(response) {
                            //         console.log(response);
                            //     },error:function(response){ 
                            //         console.log(response);
                            //         console.log("ERROR");
                            //     }
                            // });
                            swal.fire(
                                'Deletado!',
                                'Exclusão confirmada.',
                                'success'
                            ).then(function(isConfirm) {
                                window.location.reload();
                            });
                        }
                        else
                            swal.fire(
                                'Erro!',
                                'Ocorreram erros na exclusão. Entre em contato com o suporte.',
                                'error'
                            );
                    });
                }
            })
        }
    </script>
@stop
