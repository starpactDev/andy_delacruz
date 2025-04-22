<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>EMBARQUE PATON GOMEZ - Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ url('/') }}/invoice/assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet"
        href="{{ url('/') }}/invoice/assets/fonts/font-awesome/css/font-awesome.min.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ url('/') }}/invoice/assets/img/favicon.ico" type="image/x-icon">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ url('/') }}/invoice/assets/css/style.css">
</head>

<body>

    <!-- Invoice 1 start -->
    <div class="invoice-1 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner clearfix">
                        <div class="invoice-info clearfix" id="invoice_wrapper">
                            <div class="invoice-headar">
                                <div class="row g-0">
                                    <div class="col-sm-6">
                                        <div class="invoice-logo">
                                            <!-- logo started -->
                                            <div class="logo">
                                                <img src="{{ url('/') }}/admin/assets/images/andy.png"
                                                    alt="logo" />
                                            </div>
                                            <!-- logo ended -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6 invoice-id">
                                        <div class="info">
                                            <h1 class="color-white inv-header-1">Invoice</h1>
                                            <p class="color-white mb-1">Invoice Number <span>#INV001</span></p>
                                            <p class="color-white mb-1">Invoice Date <span>15 Aug 2024</span></p>
                                            <p class="color-white mb-0">CONTAINER # <span>EPG20</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-top">
                                <div class="row">

                                    <div class="col-sm-9">
                                        <div class="invoice-box">
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="invoice-number mb-30">
                                                        <h4 class="inv-title-1">Address 1</h4>
                                                        <h5 class="name "><i class="fa fa-map-marker"
                                                            style="margin-right: 5px;"></i>3115 WASHINGTON STREET</h5>
                                                        <p class="invo-addr-1 mt-10">
                                                            ROXBURY, MA. 02130 <br />
                                                            <i class="fa fa-phone" style="margin-right: 5px;"></i> 617-
                                                            477-
                                                            9072 <br />
                                                            <i class="fa fa-phone" style="margin-right: 5px;"></i> 781-
                                                            439-2046<br />
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="invoice-number mb-30">
                                                        <h4 class="inv-title-1">Address 2</h4>
                                                        <h2 class="name "><i class="fa fa-map-marker"
                                                            style="margin-right: 5px;"></i>57 CHASE STREET</h2>
                                                        <p class="invo-addr-1 mt-10">
                                                            METHUEN, MA 01844 <br />
                                                            <i class="fa fa-phone"
                                                                style="margin-right: 5px;"></i>978-258-0238
                                                            <br />
                                                            <i class="fa fa-phone" style="margin-right: 5px;"></i>
                                                            978-258-0154<br />
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="invoice-number mb-30">
                                                        <h4 class="inv-title-1">Address 3</h4>
                                                       <h2 class="name "> <i class="fa fa-map-marker"
                                                        style="margin-right: 5px;"></i>BANI, DOMINICAN REPUBLIC</h2>
                                                        <p class="invo-addr-1 mt-10">
                                                            ANA PRAVIA STREET # 99 PERAVIA <br />
                                                            <i class="fa fa-phone"
                                                                style="margin-right: 5px;"></i>809-522-3648
                                                            <br />

                                                        </p>
                                                    </div>
                                                </div>
                                            </div>







                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="invoice-box">
                                            <div class="invoice-number mb-30">
                                                <div class="invoice-number-inner">
                                                    <h4 class="inv-title-1">Invoice To</h4>
                                                    <h2 class="name">Animas Roky</h2>
                                                    <p class="invo-addr-1">
                                                        Apexo Inc <br />
                                                        <i class="fa fa-envelope"
                                                        style="margin-right: 5px;"></i>animas@gmail.com
                                                    <br />
                                                        <i class="fa fa-phone"
                                                        style="margin-right: 5px;"></i>809-522-3648
                                                    <br />

                                                    <i class="fa fa-map-marker"
                                                    style="margin-right: 5px;"></i>160 Park Street, India
                                                <br />
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-center">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-striped invoice-table">
                                        <thead class="bg-active">
                                            <tr class="tr">
                                                <th class="text-center">Quantity</th>
                                                <th class="pl0 text-start">Item Description</th>
                                                <th class="text-end">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tr">
                                                <td class="text-center">
                                                   10
                                                </td>
                                                <td class="pl0">Plastic Containers</td>

                                                <td class="text-end">$150.00</td>
                                            </tr>
                                            <tr class="bg-grea">
                                                <td class="text-center">
                                                  16
                                                </td>
                                                <td class="pl0">Metal Containers</td>
                                                <td class="text-end">$200.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                  06
                                                </td>
                                                <td class="pl0">Glass Bottles</td>
                                                <td class="text-end">$180.00</td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">

                                                       13

                                                </td>
                                                <td class="pl0">Cardboard Boxes</td>
                                                <td class="text-end">$75.00</td>
                                            </tr>
                                            <tr class="tr2">
                                                <td></td>

                                                <td class="text-center fw-bold">SubTotal</td>
                                                <td class="text-end fw-bold">$710.99</td>
                                            </tr>
                                            <tr class="tr2">
                                                <td></td>

                                                <td class="text-center fw-bold">Tax (6.5%)</td>
                                                <td class="text-end fw-bold">$85.99</td>
                                            </tr>
                                            <tr class="tr2">
                                                <td></td>

                                                <td class="text-center fw-bold">Discount</td>
                                                <td class="text-end fw-bold">$10.00</td>
                                            </tr>
                                            <tr class="tr2">
                                                <td></td>

                                                <td class="text-center  active-color ">Grand Total</td>
                                                <td class=" text-end active-color">$785.99</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="invoice-bottom">
                                <div class="row" style="background-color: #ffdddd47;padding-top: 25px;margin-bottom:20px">
                                    <div class="col-lg-6 col-md-8 col-sm-7">
                                        <div class="mb-30 dear-client">
                                            <h3 class="inv-title-1">Deposit/Value Paid :     <span style="color:green">$ 200</span></h3>
                                            <h3 class="inv-title-1">Balance Due :     <span style="color:rgb(228, 23, 23)">$ 500</span></h3>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4 col-sm-5">
                                        <div class="mb-30 payment-method">
                                            <h3 class="inv-title-1">Payment Method</h3>
                                            <ul class="payment-method-list-1 text-14">
                                                <li><strong>BANK DEPOSIT</strong></li>
                                                <li><strong>SANTANDER BANK</strong> </li>
                                                <li><strong>#8151041390</strong> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="important-note mb-30">
                                            <h3 class="inv-title-1 text-center">COMPANY POLICY</h3>
                                            <ul class="important-notes-list-1">
                                                <li><b> WE ARE NOT RESPONSIBLE FOR GOODS FOR DAMAGE FROM FIRE OR FLOODS.</b></li>
                                                <li> We thank you if you save your invoice for future claims or inconveniences.</li>
                                                <li>If you pay immediately, you will be one of the first customers to receive your
                                                    merchandise.</li>
                                                <li> We pay 5% on the declared value</li>
                                                <li>   Any UNPAID package that remains in our warehouse in the Dominican Republic for
                                                    more than
                                                    15 days will be auctioned and the resources obtained through the auction will be
                                                    used to cover the
                                                    costs of your package.</li>
                                            </ul>
                                            <h5 class="font-weight-bold" style="font-size:16px">Contrato/Contract</h5>
                                            <ul class="important-notes-list-1">
                                                <li><strong>Receiving Cargo:</strong>
                                                    <ul>
                                                        <li>At the time of receiving cargo, the consignee must check it to make sure that everything is okay. He or she must sign a document and, as soon as the consignee signs such document, neither the exporter nor the consignee will have any rights to complain for lost or damaged items.</li>
                                                        <li>Any cargo with balance left more than fifteen days in our warehouse will be charged a 5% of the freight charge every fifteen days. If the company does not receive any payments during the next three months, the customer will lose the cargo, and the company will reserve the rights to do anything with it.</li>
                                                        <li>The company is not responsible for any illegal items contained in the packages.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>NOTE:</strong> The company agrees to pay for the articles in case of loss or irreparable damage, as follows:
                                                    <ul>
                                                        <li>To new articles, a 10% of the value of the freight is charged as an additional insurance policy. In case of loss or irreparable damage, the client will receive payment of the total value of the good in the market as new. The client must show the original receipt from the store where it was purchased.</li>
                                                        <li>To used articles, a 5% of the value of the freight is charged as an additional insurance policy. In case of loss or irreparable damage, the client will receive payment of 25% of the value of the article in the market.</li>
                                                        <li>In case of loss, the client will only receive payment for values declared on this invoice.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>CLAIMS:</strong>
                                                    <ul>
                                                        <li>We only accept claims at the time of receiving the cargo. After items have been received, in case damage has occurred it will only be replaced if such damage cannot be repaired. The company will not replace the item for cash, it will only be replaced with one similar if it cannot be repaired.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>BOXES OF PERSONAL BELONGINGS:</strong>
                                                    <ul>
                                                        <li>Must be 18”X18”X28”. In these boxes, new articles are not accepted without being declared; articles by dozen are not accepted nor for commercial use.</li>
                                                        <li>In case of loss of a box of personal belongings, the company will pay a maximum of $100.00 dollars per box after an investigation has been made, and a credit will be given for another box of the same dimensions (18”X18”X28”).</li>
                                                        <li>The same clauses apply to boxes of used clothes. Jewelry or cell phones are not accepted, and any article whose value exceeds $30.00 must be declared.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>CLAIMS FOR BROKEN LAMPS OR GLASSES:</strong>
                                                    <ul>
                                                        <li>The company is not responsible for lamps or glasses packed by anyone other than this company’s employees; it will only pay a maximum of $100.00 for irreparable broken lamps or glasses.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>DELIVERY OF BOXES:</strong>
                                                    <ul>
                                                        <li>The company is only responsible for new articles declared in the invoice; the box or cargo will only be delivered to the exporter or consignee who appears in the invoice and will have to show identification at delivery.</li>
                                                        <li>The boxes must have a security seal from the company when the consignee is going to receive it. If the invoice has detailed items, the representative will open the boxes in the presence of the consignee and check that all the items listed on the invoice are physically present. If no items are detailed on the invoice, the representative will deliver the sealed box.</li>
                                                        <li>The consignee of the cargo must be in full mental and physical condition to receive the cargo; otherwise, the company will not be responsible.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>SHIPMENT OF VEHICLES:</strong>
                                                    <ul>
                                                        <li>Pickup: The company will charge for the pickup of the vehicle depending on its location. The charge is for the use of the transportation plate.</li>
                                                        <li>If the vehicle breaks down along the way to the port, the customer will be responsible for the costs of towing or any other expense related to transporting it to the final destination.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>CLAIMS FOR VEHICLES:</strong>
                                                    <ul>
                                                        <li>The company is just an intermediary between the client and the shipping company; any claim related to vehicles arriving at their destination with any type of damage, the customer should make the claim to the corresponding shipping company, which is responsible for transporting them.</li>
                                                    </ul>
                                                </li>
                                                <li><strong>IN CASE OF DELAY:</strong>
                                                    <ul>
                                                        <li>This company, when receiving vehicles, will transport them to the dock within a maximum of seven days. After a vehicle arrives at the dock, customs will need to inspect it, which can take between 5 and 10 business days.</li>
                                                        <li>We are not responsible for vehicle delays due to factors beyond this company’s control.</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="invoice-contact clearfix">
                                <div class="row g-0">
                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                        <div class="contact-info">
                                            <div class="signature-row">
                                                <div class="signature-container">
                                                    <div class="signature-line">
                                                        <img src="{{ url('/') }}/invoice/assets/img/sign.png" alt="Signature 1" class="signature-image">
                                                    </div>
                                                    <div class="signature-name">
                                                        <p>I accept: Signture of Sender</p>
                                                    </div>
                                                </div>
                                                <div class="signature-container">
                                                    <div class="signature-line">
                                                        <img src="{{ url('/') }}/invoice/assets/img/sign.png" alt="Signature 2" class="signature-image">
                                                    </div>
                                                    <div class="signature-name">
                                                        <p>Receiver's Signature</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-btn-section clearfix d-print-none">
                            <a href="javascript:window.print()" class="btn btn-lg btn-print">
                                <i class="fa fa-print"></i> Print Invoice
                            </a>
                            <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                                <i class="fa fa-download"></i> Download Invoice
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Invoice 1 end -->

    <script src="{{ url('/') }}/invoice/assets/js/jquery.min.js"></script>
    <script src="{{ url('/') }}/invoice/assets/js/jspdf.min.js"></script>
    <script src="{{ url('/') }}/invoice/assets/js/html2canvas.js"></script>
    <script src="{{ url('/') }}/invoice/assets/js/app.js"></script>
</body>

</html>
