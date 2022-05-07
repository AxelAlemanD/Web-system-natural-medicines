
<div class="modal" tabindex="-1" role="dialog" id="returnProduct">
    <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Devolver producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                    <p class="mb-5 text-muted">
                        Los clientes suelen cambiar de opinión, que no cunda el pánico, a continuación puedes colocar la cantidad que fue devuelta. <br>
                    </p>
                    <form action="#" method="POST" id="dataFormProduct" data-saleID={{$sale->id}}>
                        @csrf
                        <div class="row m-0 w-100 justify-content-center align-items-center text-center">
                            <div class="row mb-3">
				    			<x-field label="" name="productId" value="" type="number" placeholder="id" other="readonly id=currentProductId style=display:none;"/>
				    		</div>
				    		<div class="row mb-3">
				    			<x-field label="Productos comprados" name="quantity" value="" type="number" placeholder="Cantidad" other="readonly id=currentProductQuantity"/>
				    		</div>
				    		<div class="row mb-3" id="divRefundAmount">
                                <x-field label="Cantidad devuelta" name="refundAmount" value="" type="number" placeholder="Ingresa la cantidad que fue devuelta" other="id=refundAmount min=1"/>
				    		</div>
                            <div class="row pl-5 pr-5 mt-5 pt-5">
				    			<button type="submit" class="btn btn-primary" onclick="returnProduct(event);">
				    				Devolver producto</button>
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
     * Load information of product selected in window modal
    */
    function loadProductOnModal(event){
        let btn                 = event.target.closest('#btnReturnProduct');
        let productId           = btn.getAttribute('data-product-id');
        let productQuantity     = btn.getAttribute('data-product-quantity');
        let fieldQuantity       = document.querySelector('#currentProductQuantity');
        let fieldId             = document.querySelector('#currentProductId');
        let fieldRefundAmount   = document.querySelector('#refundAmount');

        fieldQuantity.value = productQuantity;
        fieldId.value       = productId;

        fieldRefundAmount.setAttribute('max', productQuantity);
    }

    /**
     * Send the id of the new customer and assign the new values to the labels
    */
	function returnProduct(event) {
        event.preventDefault();
        let form            = document.querySelector('#dataFormProduct');
        let sale_id         = form.getAttribute('data-saleID');
        let product_id      = form.querySelector('#currentProductId').value;
        let refund_amount   = parseInt(form.querySelector('#refundAmount').value, 10);
        let maxQuantity     = parseInt(document.querySelector('#currentProductQuantity').value, 10);
    
        if (refund_amount <= maxQuantity) {
            $.ajax({
                type: "PUT",
                dataType: "json",
                url: "{{route('returnProduct', '')}}"+"/"+sale_id,
                data: {
                    'product_id'        : product_id,
                    'current_quantity'  : maxQuantity,
                    'refund_amount'     : refund_amount,
                },
                success: function(response) {
                    console.log(response.url);
                    if(response.url){
                        window.location.href = response.url; // Redirect to index
                    }else{
                        location.reload(); // Reload page
                    }
                }
            });
        } else {
            // Show error message
            let divRefundAmount =   form.querySelector('#divRefundAmount').querySelector('.form-group');
            let warning         =   document.createElement('p');
            warning.innerText   =   'La cantidad a devolver no debe superar los '+maxQuantity+' productos';
            warning.style.color =    'red';

            divRefundAmount.appendChild(warning);
        }
    }
</script>