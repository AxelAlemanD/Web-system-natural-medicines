
<div class="modal" tabindex="-1" role="dialog" id="createPublication">
    <div class="modal-dialog modal-dialog-centered modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="#" method="POST" id="dataForm" data-saleID={{$sale->id}}>
                    @csrf
                    <div class="row m-0 w-100 justify-content-center align-items-center text-center">
						<div class="row mb-3">
							<x-field label="Cantidad pendiente" name="total_amount" value="{{$sale->numberToCurrency($sale->total_amount - $sale->amount_paid)}}" type="text" placeholder="$0.00" other="required step=0.01 readonly"/>
						</div>
						<div class="row mb-3">
							<x-field label="Cantidad a pagar" name="amount_paid" value="{{$sale->total_amount - $sale->amount_paid}}" type="number" placeholder="$0.00" other="required step=0.01 id=amount_paid max={{$sale->total_amount - $sale->amount_paid}}"/>
						</div>
                        <div class="row pl-5 pr-5 mt-5 pt-5">
							<button type="submit" class="btn btn-primary" onclick="updatePay(event);">
								<i class="feather  feather-save sidemenu_icon"></i>
								Actualizar pago</button>
						</div>
                    </div>
                </form>
              </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
	function updatePay(event) {
            event.preventDefault();
            form        = document.getElementById('dataForm');
            amount_paid = form.querySelector('#amount_paid').value;
            sale_id     = form.getAttribute('data-saleID');
        
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{route('updatePay')}}",
                data: {
                    'sale_id': sale_id,
                    'amount_paid': amount_paid,
                },
                success: function(response) {
                    location.reload();
                }
            });
        }
</script>