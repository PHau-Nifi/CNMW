@extends('admin.layouts.index');
@section('content')
    <section class="container-fluid py-4">
        <div class="show" id="handleMoney" tabindex="-1" role="dialog" aria-labelledby="handleMoneyLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="handleMoneyLabel">Thanh toán</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="moneyPayment" action="/admin/buyTicket/handleResult" method="post">
                        @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="total" class="form-control-label">Tổng tiền vé</label>
                            <input id="total" class="form-control" name="total" type="number" value="{{$ticket->totalPrice}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="moneyIn" class="form-control-label">Khách đưa</label>
                            <input id="moneyIn" class="form-control" type="number" placeholder="0">
                        </div>
                        <div class="form-group">
                            <label for="moneyOut" class="form-control-label">Trả khách</label>
                            <input id="moneyOut" class="form-control" type="number"  placeholder="0" readonly>
                        </div>
                        <input type="hidden" name="vnp_BankCode" value="MONEY">
                        <input type="hidden" name="ticket_id" id="ticketMoney" value="{{$ticket->id}}">
                        <input type="hidden" name="type" value="ticket">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary mt-3" onclick="DeleteMoneyPayment({{$ticket->id}})" data-bs-dismiss="modal">Hủy</button>
                        <button type="button p-3" onclick="btnMoneyPayment()" class="btn bg-gradient-primary m-3">Thanh toán</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $('#moneyIn').bind('keyup', (e) => {
                $sum = $('#total').val();
                $moneyOut = parseInt($('#moneyIn').val()) - $sum;
                $('#moneyOut').val($moneyOut);
        })
        btnMoneyPayment = () => {
            moneyOut = parseInt($('#moneyOut').val());
            if (moneyOut >= 0) {
                $('#moneyPayment').submit();
            } else {
                Swal.fire({
                    title: 'Chưa đủ tiền thanh toán',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            }
        }

        DeleteMoneyPayment = (id) => {
            $.ajaxSetup({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (confirm("Hủy vé") === true) {
                $.ajax({
                    url: 'admin/buyTicket/delete/' + id,
                    type: 'DELETE',
                    statusCode: {
                        200: function (data) {
                            alert('Đã hủy');
                            window.location.href = '/admin/buyTicket';
                        },
                        400: (data) => {
                            alert(data.error);
                        }
                    }
                });
            }
        }
    </script>
@endsection