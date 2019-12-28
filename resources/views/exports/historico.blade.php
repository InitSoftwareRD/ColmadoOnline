<table id="historico" class="table table-sm table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th># Orden</th>
                            <th>Canal</th>
                            <th>Nombres</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Total</th>
                            <th >Pagado</th>
                            <th>Delivery</th>
                            <th>Ping</th>
                            <th>Estatus</th>
                            <th>Fecha</th>
                           
                        </tr>
                    </thead>
                    <tbody>

                       @foreach ($history as $ht)
                       <tr>
                       <th>{{ $ht->id }}</th>
                       <th>{{ $ht->canal  }}</th>    
                       <th>{{ $ht->nombres }}</th>
                       <th>{{ $ht->phone }}</th>
                       <th>{{ $ht->email }}</th>
                       <th>{{ $ht->total }}</th>
                       <th>{{ $ht->pagado }}</th>
                       <th>{{ $ht->delivery }}</th>
                       <th>{{ $ht->ping }}</th>
                       <th>{{ $ht->estatus }}</th>
                       <th>{{ $ht->Fecha }}</th>
                      </tr>
                           
                       @endforeach 
                   
                    </tbody>
            </table>