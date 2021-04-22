<!DOCTYPE HTML PUBLIC>
<HTML>
 <HEAD>
  <TITLE> Select2 </TITLE>
    <link href="select22/select2.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="select22/select2.js"></script>
    <script src="select22/select2_locale_pt-BR.js"></script>


<script>
        $(document).ready(function() {
  
            $('#e7').select2({
                minimumInputLength: 3,
                                placeholder: "Localize o cliente por nome",
                        ajax: {
                            url: '{{ route('getselectbusca') }}',
                            dataType: 'json',
                            delay: 10,
                            data: function (term, page) {
                                //console.log('page: '+page);
                                //console.log('term: '+term);
                                return {
                                    q: term
                                  };
                            },
                            results: function (data, page) {

                                            var itensList = [];
                                            var oItem = {};


                                            $.each( data, function( key, value ) {
                                              //console.log( key + ": " + value.CLIENTES_ID +' - '+ value.CLIENTES_NOMEDARADIO );

                                              itensList.push({'id':value.CLIENTES_ID,'text':value.CLIENTES_NOMEDARADIO}); 

                                            }); 

                                            //console.log(itensList);

                                return {
                                    results: itensList
                                };
                            }
                        }
                    });

        });
    </script>


</head>
<body>
    <input type="hidden" id="e7" style="width:300px" class="input-xlarge" />
</body>
</html>
