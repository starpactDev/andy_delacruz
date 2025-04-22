<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }

    .main-section {
        min-height: 100dvh;
        padding: 5vh 0;
        background-color: rgb(255, 255, 255);
    }

    .page {
        margin: 0 auto;
        border: 1px solid black;
        width: 25rem;
        padding: 0 0 2rem 0;
    }

    .head {
        text-align: center;
    }

    .head img {
        width: 100%;
    }

    .invoice-id {
        border-top: 2px solid black;
        border-bottom: 2px solid black;
        text-align: center;
        padding: 0.5rem 0;
    }

    address {
        margin: 0.5rem 0;
        font-weight: 600;
        letter-spacing: 0.1ch;
    }

    .sender {
        padding: 1rem 0.5rem;
        border-bottom: 2px solid black;
    }

    .receiver {
        padding: 1rem 0.5rem;
        display: flex;
        justify-content: space-between;
        font-weight: 600;
        border-top: 2px solid black;
        border-bottom: 4px solid black;
    }

    .right-side {
        text-align: center;
        width: 40%;
    }

    .bar-code {
        text-align: center;
        padding: 0.5rem 1rem;
        max-width: 100%;
        /* Ensures the barcode doesn't overflow the container */
        overflow: hidden;
        /* Prevents the image from spilling out */
        border-top: 2px solid black;
        border-bottom: 4px solid black;
    }

    .bar-code img {
        max-width: 100%;
        /* Makes the image responsive */
        height: auto;
        /* Maintains the aspect ratio */
    }

    .top-right-buttons {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .top-right-buttons button {
        margin-left: 10px;
    }

    @media print {
        .top-right-buttons {
            display: none;
        }

        .page {
            width: 100%;
            margin: 0 auto;
            page-break-after: always;
        }

        .page:last-child {
            page-break-after: auto;
        }
    }

    @media (max-width: 580px) {
        .top-right-buttons {
            flex-direction: column;
            align-items: flex-start;
        }

        .top-right-buttons .btn {
            margin: 5px 0;
            width: 100%;
            text-align: center;
        }
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="top-right-buttons">
                    <button class="btn btn-info" onclick="window.print()">
                        <i class="fas fa-print"></i> Print
                    </button>
                    <button class="btn btn-warning" id="backButton">
                        <i class="fa fa-arrow-left"></i> Back
                    </button>
                </div>
            </div>
        </div>

        <section class="main-section">
            @for ($i = 1; $i <= $orderDetails->label_count; $i++)
                <div class="page mb-5">
                    <div class="head">
                        <img src="{{ url('/') }}/admin/assets/images/andy.png" alt="logo">
                    </div>
                    <div class="invoice-id">
                        <h4>Invoice Id : <span>{{ $orderDetails->order_number }}</span></h4>
                    </div>
                    <div class="sender">
                        <h4>Sender:</h4>
                        <address>
                            <h5>{{ $orderDetails->sender->first_name }} {{ $orderDetails->sender->last_name }}</h5>
                            <p class="text-muted">
                                <b>Email:&nbsp;</b>{{ $orderDetails->sender->email }} <br />
                                <b>Tel:&nbsp;</b>{{ $orderDetails->sender->telephone }} <br />
                                <b>Cell:&nbsp;</b>{{ $orderDetails->sender->cell }} <br />
                                <b>Address:&nbsp;</b>{{ $orderDetails->sender->street_address }}
                                {{ $orderDetails->sender->apt }} <br />
                                <b>City:&nbsp;</b>{{ $orderDetails->sender->city }} <br />
                                <b>State:&nbsp;</b>{{ $orderDetails->sender->state }} <br />
                                <b>Zip:&nbsp;</b>{{ $orderDetails->sender->zip }} <br />
                            </p>
                        </address>
                    </div>
                    <div class="receiver">
                        <div class="left-side">
                            <h4>Receiver</h4>
                            <h5>{{ $orderDetails->receiver->first_name }} {{ $orderDetails->receiver->last_name }}
                            </h5>
                            <p class="text-muted">
                                <b>Email:&nbsp;</b>{{ $orderDetails->receiver->email }} <br />
                                <b>Tel:&nbsp;</b>{{ $orderDetails->receiver->telephone }} <br />
                                <b>Cell:&nbsp;</b>{{ $orderDetails->receiver->cell }} <br />
                                <b>WhatsApp:&nbsp;</b>{{ $orderDetails->receiver->whatsapp }} <br />
                                <b>Address:&nbsp;</b>{{ $orderDetails->receiver->address }} <br />
                                <b>Neighbourhood:&nbsp;</b>{{ $orderDetails->receiver->neighborhood }} <br />
                                <b>City:&nbsp;</b>{{ $orderDetails->receiver->city }} <br />
                                <b>Province:&nbsp;</b>{{ $orderDetails->receiver->province }} <br />
                            </p>
                        </div>
                        <div class="right-side">
                            Total Packages:<br>
                            {{ $i }} of {{ $orderDetails->label_count }}
                        </div>
                    </div>
                    <div class="bar-code">
                        <img src="{{ asset('barcodes/barcode_' . $orderDetails->order_number . '.png') }}" alt="Barcode">
                    </div>
                </div>
            @endfor
        </section>
    </div>

    <script>
        // Go back to the previous page when the Back button is clicked
        document.getElementById("backButton").addEventListener("click", () => {
            window.history.back();
        });
    </script>
</body>

</html>
