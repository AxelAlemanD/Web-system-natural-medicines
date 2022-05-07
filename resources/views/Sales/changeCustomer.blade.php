
<div class="modal" tabindex="-1" role="dialog" id="changeCustomer">
    <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar de cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                    <p class="mb-5 text-muted">
                        A veces solemos cometer errores, no te preoucupes, puedes cambiar el cliente al que pertenece la venta, solo debes seleccionarlo en la parte de abajo 😉.
                    </p>
                    <form action="#" method="POST" id="dataFormClient" data-saleID={{$sale->id}}>
                        @csrf
                        <div class="row m-0 w-100 justify-content-center align-items-center text-center">
				    		<div class="row mb-3">
				    			<x-field label="Cliente actual" name="user_id" value="{{$sale->user->getFullName()}}" type="text" placeholder="Cliente" other="readonly id=currentCustomer"/>
				    		</div>
				    		<div class="row mb-3">
				    			<div class="form-group">
                                    <label class="form-label">Cliente:</label>
                                    <select class="form-control custom-select select2" data-placeholder="Selecciona un cliente" id="new_customer" required>
                                        <option value="-1" selected disabled>Selecciona un cliente</option>
                                    </select>
                                </div>
				    		</div>
                            <div class="row pl-5 pr-5 mt-5 pt-5">
				    			<button type="submit" class="btn btn-primary" onclick="changeCustomer(event);">
				    				Cambiar cliente</button>
				    		</div>
                        </div>
                    </form>
              </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>


    /**
     * Get and add the clients to the select
    */
    window.onload = function() {
        fetch('{{route('getCustomers')}}').then((res) => {
            return res.json();
        }).then((data) => {
            let select = document.getElementById('new_customer');
            
            data.customers.forEach(customer => {
                let option          =   document.createElement('option');
                option.value        =   customer.id;
                option.innerText    =   customer.first_name+' '+customer.last_name;

                select.add(option);
            });
        })
    };
    
    /**
     * Send the id of the new customer and assign the new values to the labels
    */
	function changeCustomer(event) {
            event.preventDefault();
            let form            = document.getElementById('dataFormClient');
            let new_customer    = form.querySelector('#new_customer').value;
            let sale_id         = form.getAttribute('data-saleID');
        
            $.ajax({
                type: "PUT",
                dataType: "json",
                url: "{{route('changeCustomer', '')}}"+"/"+sale_id,
                data: {
                    'new_customer': new_customer,
                },
                success: function(response) {
                    location.reload();
                    // let customerName        =   document.querySelector('#customerName');
                    // let customerPhoneNumber =   document.querySelector('#customerPhoneNumber');
                    // let customerAddress     =   document.querySelector('#customerAddress');
                    // let currentCustomer     =   document.querySelector('#currentCustomer');
                    
                    // customerName.innerText          =   response.customer.first_name+' '+response.customer.last_name;
                    // customerPhoneNumber.innerText   =   response.customer.phone_number;
                    // customerAddress.innerText       =   response.customer.address;
                    // currentCustomer.value           =   response.customer.first_name+' '+response.customer.last_name;
                }
            });
        }
</script>