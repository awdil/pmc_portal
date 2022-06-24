<!-- Mainly scripts -->
<script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('assets/js/inspinia.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
<script src="{{ asset('assets/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/js/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/toastr/toastr.min.js') }}"></script>

 <!-- blueimp gallery -->
 <script src="{{ asset('assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js') }}"></script>

<script>

    function hideLoading(){
        $('.loading').hide();
    }

    function showLoading(){
        $('.loading').show();
    }
        
    $(document).ready(function () {

        $('.client-checkbox').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        var mem = $('.datepicker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            startDate: new Date(),
            format: "dd/mm/yyyy",
        });

        $(document).on('click','.delete-record',function(e){
            e.preventDefault();

            var url = $(this).attr('href');
            var table = $(this).data('table');

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function () {

                $.ajax({

                    url: url,
                    type: "DELETE",
                    // data : filters,
                    headers: {
                      'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    cache   : false,
                    success : function(data){
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                        $('#'+table).DataTable().ajax.reload( null, false );
                    },
                    error : function(){

                    },
                    beforeSend : function(){

                    },
                    complete   : function () {

                    }
                });
            });
        }); 

        $(".load_select").select2({
            // theme: 'bootstrap4',
            placeholder: "Please select",
            allowClear: true
        });

        $(".select-2").select2({
            // theme: 'bootstrap4',
            placeholder: "Please select",
            allowClear: true
        });
    });

    $(document).on('change','.load_select',function(e){


        var target = $(this).data('target');
        var url    = $(this).data('url');

        console.log(target,url);

        $.ajax({

            url: url+'?id='+$(this).val(),
            type: "GET",
            cache   : false,
            success : function(data){

                var options = '<option value=""></option>';

                if(data)
                {
                    $.each(data, function( index, value ) {
                        options += '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                }

                console.log(options);

                $('select[name="'+target+'"]').html(options).attr('disabled', false);
            },
            error : function(){

            },
            beforeSend : function(){
                showLoading();
            },
            complete   : function () {
                hideLoading();
            }
        });
    });
</script> 