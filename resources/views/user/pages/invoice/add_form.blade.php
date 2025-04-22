@extends('admin.layouts.master')
@section('content')
    <style>
        .scrollable-container {
            max-height: 370px;
            /* Adjust height as needed */
            overflow-y: auto;
            /* Enable vertical scrollbar if content overflows */
            border: 1px solid #e40e0e;
            /* Optional: Adds a border for better visibility */
            padding: 10px;
            /* Optional: Adds some padding inside the container */
        }


        .center-aligned {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
    </style>


    <div class="container-fluid">

        <div class="logo text-center">
            <img src="{{ url('/') }}/admin/assets/images/andy.png" height="135px" alt="logo" />
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-lg-8 col-md-8">
                        <h4 class="card-title" style="color:red">Receipt Form</h4>
                        <h6 class="card-subtitle mb-5">
                            Effortlessly Generate and Manage Your Invoices – <b>Simplify Your Billing Today!</b>
                        </h6>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card overflow-hidden">
                            <div class="d-flex flex-row">
                                <div class="p-3 bg-light-danger">
                                    <h3 class="text-danger box mb-0">
                                        <i class="ti-server"></i>
                                    </h3>
                                </div>
                                <div class="p-3" style="background-color: #ffdbdb2e;!important">
                                    <h6 class="text-danger mb-0">Payment Method</h3>
                                        <span class="fw-bold">BANK DEPOSIT</span><br>
                                        <span class="text-muted">SANTANDER BANK #8151041390</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="form-material mt-4">
                    <div class="row mb-5">

                        <div class="form-group col-md-4">
                            <label for="date">Date:</label>
                            <input type="date" class="form-control" id="date">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="invoice">Invoice #:</label>
                            <input type="text" class="form-control" id="invoice">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fulgon">CONTAINER# :</label>
                            <input type="text" class="form-control" id="fulgon" value="EPG 20" readonly>
                        </div>

                    </div>

                    <div class="row mt-5">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header" style="font-weight:800;">Address 1</div>
                                <div class="card-body" style="background-color:#f1fff770 !important;min-height:9.375rem">
                                    </i><i class="fa fa-map-marker"><span class="card-title fw-bold"
                                            style="margin-left:5px;"> 3115 WASHINGTON STREET,</i>
                                    <h6>ROXBURY, MA. 02130</h6></span>

                                    <p class="card-text">
                                        <i class="fa fa-phone fa-rotate-90"></i><span
                                            style="margin-left:5px;font-weight:500">617- 477-
                                            9072 </span>
                                    </p>
                                    <p class="card-text">
                                        <i class="fa fa-phone fa-rotate-90"></i><span
                                            style="margin-left:5px;font-weight:500">
                                            781- 439-2046</span>

                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header" style="font-weight:800">Address 2</div>
                                <div class="card-body" style="background-color:#0273ff0d !important;min-height:9.375rem">
                                    </i><i class="fa fa-map-marker" style="margin-left:5px;"><span
                                            class="card-title fw-bold"> 57 CHASE STREET,</i>
                                    <h6>METHUEN, MA 01844
                                    </h6></span>

                                    <p class="card-text">
                                        <i class="fa fa-phone fa-rotate-90"></i><span
                                            style="margin-left:5px;font-weight:500">
                                            978-258-0238 </span>


                                    </p>
                                    <p class="card-text">
                                        <i class="fa fa-phone fa-rotate-90"></i><span
                                            style="margin-left:5px;font-weight:500">
                                            978-258-0154 </span>

                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header" style="font-weight:800">Address 3</div>
                                <div class="card-body" style="background-color:#f2f2f7 !important;min-height:9.375rem">
                                    </i><i class="fa fa-map-marker"><span style="margin-left:5px;"
                                            class="card-title fw-bold">BANI, DOMINICAN REPUBLIC,</i>
                                    <h6>ANA PRAVIA STREET # 99 PERAVIA,</h6></span>

                                    <p class="card-text">
                                        <i class="fa fa-phone fa-rotate-90"></i><span
                                            style="margin-left:5px;font-weight:500">809-522-3648</span>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row mt-5">
                    <div class="col-lg-12 col-md-12">
                        <h2 class="card-title text-center mb-5" style="color:red;font-size:30px!important;">Invoice Summary
                        </h2>

                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both">
                            <table class="table   table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center"># Quantity</th>



                                        <th class="text-center">Item Description</th>
                                        <th class="text-center">Price</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">10</td>
                                        <td class="text-center">Plastic Containers</td>
                                        <td class="text-center">$150.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td class="text-center">Wooden Crates</td>
                                        <td class="text-center">$200.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">20</td>
                                        <td class="text-center">Cardboard Boxes</td>
                                        <td class="text-center">$80.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">15</td>
                                        <td class="text-center">Metal Drums</td>
                                        <td class="text-center">$300.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">8</td>
                                        <td class="text-center">Pallets</td>
                                        <td class="text-center">$120.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding: 44px;">
                        <div class="pull-right m-t-30 text-start">
                            <p><span style="font-weight:600;color:red">DEPOSIT/VALUE PAID :</span> </p>
                            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1">$</span>
                                <input type="text" class="form-control" placeholder="200.00" aria-label="Username"
                                    aria-describedby="basic-addon1">
                            </div>
                            <p><span style="font-weight:600;color:red">BALANCE DUE/PENDING :</span></p>
                            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1">$</span>
                                <input type="text" class="form-control" placeholder="170.00" aria-label="Username"
                                    aria-describedby="basic-addon1">
                            </div>


                        </div>
                    </div>
                    <div class="col-md-6 " style="padding: 44px;">
                        <div class="center-aligned pull-right m-t-30 text-end">
                            <p><span style="font-weight:600;color:red">Sub - Total :</span> <b>$ 13,848</b></p>
                            <p><span style="font-weight:600;color:red">Tax (6.5%) :</span><b> $ 138</b></p>
                            <hr />
                            <h3><span style="font-weight:600;color:red"><b>Total :</span></b> $ 13,986</h3>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3 d-flex justify-content-center">
                        <h4 class="card-title" style="color:red; font-weight:600">COMPANY POLICY</h4>
                    </div>
                    <div class="col-md-12 mb-3 d-flex justify-content-center">
                        <input type="checkbox" id="md_checkbox_21" class="material-inputs filled-in chk-col-red"
                            checked="">
                        <label for="md_checkbox_21"><b>WE ARE NOT RESPONSIBLE FOR GOODS FOR DAMAGE FROM FIRE OR FLOODS.</b>
                        </label>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12 col-md-12">
                                <a
                                    class="
                        py-3
                        px-2
                        d-flex
                        align-items-center
                        text-decoration-none
                      ">
                                    <div class="user-img position-relative d-inline-block me-2">
                                        <span
                                            class="
                            round
                            text-white
                            d-inline-block
                            text-center
                            rounded-circle
                            bg-info
                          "><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-message-square feather-sm">
                                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                                                </path>
                                            </svg></span>
                                    </div>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5
                                            class="

                            mb-0

                            font-weight-medium
                          ">
                                            We thank you if you save your invoice for future claims or inconveniences.

                                        </h5>


                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <a
                                    class="
                        py-3
                        px-2
                        d-flex
                        align-items-center
                        text-decoration-none
                      ">
                                    <div class="user-img position-relative d-inline-block me-2">
                                        <span
                                            class="
                            round
                            text-white
                            d-inline-block
                            text-center
                            rounded-circle
                            bg-info
                          "><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-message-square feather-sm">
                                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                                                </path>
                                            </svg></span>
                                    </div>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5
                                            class="

                            mb-0

                            font-weight-medium
                          ">
                                            If you pay immediately, you will be one of the first customers to receive your
                                            merchandise.


                                        </h5>


                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <a
                                    class="
                        py-3
                        px-2
                        d-flex
                        align-items-center
                        text-decoration-none
                      ">
                                    <div class="user-img position-relative d-inline-block me-2">
                                        <span
                                            class="
                            round
                            text-white
                            d-inline-block
                            text-center
                            rounded-circle
                            bg-info
                          "><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-message-square feather-sm">
                                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                                                </path>
                                            </svg></span>
                                    </div>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5
                                            class="

                            mb-0

                            font-weight-medium
                          ">
                                            We pay 5% on the declared value


                                        </h5>


                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <a
                                    class="
                        py-3
                        px-2
                        d-flex
                        align-items-center
                        text-decoration-none
                      ">
                                    <div class="user-img position-relative d-inline-block me-2">
                                        <span
                                            class="
                            round
                            text-white
                            d-inline-block
                            text-center
                            rounded-circle
                            bg-info
                          "><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-message-square feather-sm">
                                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                                                </path>
                                            </svg></span>
                                    </div>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5
                                            class="

                            mb-0

                            font-weight-medium
                          ">
                                            Any UNPAID package that remains in our warehouse in the Dominican Republic for
                                            more than
                                            15 days will be auctioned and the resources obtained through the auction will be
                                            used to cover the
                                            costs of your package.


                                        </h5>


                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="center-aligned">

                            <div class="scrollable-container mt-4">
                                <h5 class="font-weight-medium">Contrato/Contract</h5>
                                {{-- <p>Entrega de Carga: a la hora que el consignatario recibe una carga en su destino final. Este deberá firmar un formulario de entrega y una vez firmado este documento, ni el exportador ni el consignatario tendrá derecho a reclamar artículos perdidos o averiados. Toda carga con balance dejada más de quince días a partir de su llegada al puerto de destino se le cobrará por concepto de almacenamiento un 5% del valor del flete por cada quincena o fracción de esta. Si a los tres meses de su llegada al puerto, la compañía no recibe ningún pago por concepto de almacenamiento, el cliente perderá automáticamente el derecho sobre la carga, dándole de esta manera a la compañía el derecho de disponer de dicha carga a su mejor conveniencia. La compañía no se hace responsable ante las autoridades aduanales del contenido de los bultos, el cliente es el único responsable.</p>
                                <p><strong>NOTA:</strong> La compañía se compromete a pagar los artículos en caso de pérdida o daños irreparables de la siguiente manera:
                                <ul>
                                    <li>A los artículos nuevos se les cobra por seguro un 10% del valor del flete, y en caso de pérdida o daño irreparable del artículo se pagará al cliente el valor de su precio en el mercado, como nuevo, y el cliente deberá tener la factura de compra.</li>
                                    <li>A los artículos usados se les cobra por seguro un 5% del valor del flete, y en caso de pérdida o daño irreparable del artículo se pagará al cliente un 25% de su valor en el mercado.</li>
                                    <li>Solo se le pagará al cliente por valores declarados en la factura en caso de pérdida.</li>
                                </ul>
                                </p>
                                <p><strong>RECLAMACIONES:</strong> Solo se aceptarán reclamaciones si estas son hechas cuando se están recibiendo los artículos; en caso de averías solamente se reemplazará el artículo cuando este no pueda ser reparado. La compañía no reemplazará el artículo por dinero en efectivo, solo se reemplazará el artículo por uno similar en caso de que este no sea reparable.</p>
                                <p><strong>CAJAS DE EFECTOS PERSONALES:</strong> Deben ser de 18”X18”X28”. En estas cajas no se aceptan artículos nuevos sin declarar. No se acepta ningún tipo de artículo por docena, ni para uso comercial. En caso de pérdida de una caja de efectos personales: la compañía pagará un máximo de $100.00 dólares por cada caja después que se hagan las investigaciones de lugar y se le dará un crédito por el envío de otra caja de la misma dimensión (18”X18”X28”). A las cajas de ropa de uso se les aplicarán las mismas cláusulas que a las cajas de efectos personales. No se aceptan joyas, ni teléfonos celulares, y todo artículo cuyo valor exceda los $30.00 debe ser declarado.</p>
                                <p><strong>RECLAMACIONES POR LÁMPARAS O CRISTALES ROTOS:</strong> La compañía no se hace responsable por lámparas o cristales empacados por otra persona que no sea empleado de esta compañía; solo se pagará un máximo de $100.00 por lámparas o cristales rotos irreparables.</p>
                                <p><strong>ENTREGA DE CAJAS:</strong> La compañía solo se hace responsable por artículos nuevos cuando estos están declarados en la factura; la caja o la carga solo se le entregará al exportador o al consignatario que figure en la factura y se le exige que muestre una identificación contra entrega. Las cajas deben tener un sello de seguridad de la compañía cuando el consignatario la va a recibir y si la factura tiene artículos detallados el que recibe debe abrir las cajas en presencia del representante y verificar que todos los artículos que están en la factura declarados se encuentren físicamente. Si no hay ningún artículo detallado en la factura, el representante le entregará la caja sellada por la compañía. El consignatario de la carga debe estar en plena facultad física y mental para recibir dicha carga; de otra manera, la compañía no se hace responsable.</p>
                                <p><strong>ENVÍO DE VEHÍCULOS:</strong> Recojo: La compañía cobrará por la recolección del vehículo, dependiendo de dónde se encuentre este. El cobro se hace por el uso de la tablilla de transportación; si el vehículo se avería en el camino hacia el puerto, el cliente será responsable por los gastos de grúa o cualquier otro gasto que conlleve la transportación de dicho vehículo hasta su destino final.</p>
                                <p><strong>RECLAMACIÓN PARA VEHÍCULOS:</strong> Esta compañía es simplemente un intermediario entre el cliente y la compañía naviera; cualquier reclamación referente a vehículos que lleguen a su destino con cualquier tipo de avería, la reclamación el cliente debe hacerla a la compañía naviera correspondiente que es la responsable de transportarlos.</p>
                                <p><strong>EN CASO DE TARDEZA:</strong> Esta compañía, cuando recibe los vehículos, los transporta en un máximo de siete días al muelle. Después de que un vehículo llega al muelle, la aduana tiene que inspeccionarlo y esa inspección tarda entre 5 y 10 días laborables. No nos hacemos responsables por la tardanza de vehículos por causas ajenas al control de esta compañía.</p> --}}
                                <p><strong>Receiving Cargo:</strong> At the time of receiving cargo, the consignee must
                                    check it to make sure that everything is okay. He or she must sign a document and, as
                                    soon as the consignee signs such document, neither the exporter nor the consignee will
                                    have any rights to complain for lost or damaged items. Any cargo with balance left more
                                    than fifteen days in our warehouse will be charged a 5% of the freight charge every
                                    fifteen days. If the company does not receive any payments during the next three months,
                                    the customer will lose the cargo, and the company will reserve the rights to do anything
                                    with it. The company is not responsible for any illegal items contained in the packages.
                                </p>
                                <p><strong>NOTE:</strong> The company agrees to pay for the articles in case of loss or
                                    irreparable damage, as follows:
                                <ul>
                                    <li>To new articles, a 10% of the value of the freight is charged as an additional
                                        insurance policy. In case of loss or irreparable damage, the client will receive
                                        payment of the total value of the good in the market as new. The client must show
                                        the original receipt from the store where it was purchased.</li>
                                    <li>To used articles, a 5% of the value of the freight is charged as an additional
                                        insurance policy. In case of loss or irreparable damage, the client will receive
                                        payment of 25% of the value of the article in the market.</li>
                                    <li>In case of loss, the client will only receive payment for values declared on this
                                        invoice.</li>
                                </ul>
                                </p>
                                <p><strong>CLAIMS:</strong> We only accept claims at the time of receiving the cargo. After
                                    items have been received; in case damage has occurred it will only be replaced if such
                                    damage cannot be repaired. The company will not replace the item for cash, it will only
                                    be replaced with one similar if it cannot be repaired.</p>
                                <p><strong>BOXES OF PERSONAL BELONGINGS:</strong> Must be 18”X18”X28”. In these boxes, new
                                    articles are not accepted without being declared; articles by dozen are not accepted nor
                                    for commercial use. In case of loss of a box of personal belongings, the company will
                                    pay a maximum of $100.00 dollars per box after an investigation has been made, and a
                                    credit will be given for another box of the same dimensions (18”X18”X28”). The same
                                    clauses apply to boxes of used clothes. Jewelry or cell phones are not accepted, and any
                                    article whose value exceeds $30.00 must be declared.</p>
                                <p><strong>CLAIMS FOR BROKEN LAMPS OR GLASSES:</strong> The company is not responsible for
                                    lamps or glasses packed by anyone other than this company’s employees; it will only pay
                                    a maximum of $100.00 for irreparable broken lamps or glasses.</p>
                                <p><strong>DELIVERY OF BOXES:</strong> The company is only responsible for new articles
                                    declared in the invoice; the box or cargo will only be delivered to the exporter or
                                    consignee who appears in the invoice and will have to show identification at delivery.
                                    The boxes must have a security seal from the company when the consignee is going to
                                    receive it. If the invoice has detailed items, the representative will open the boxes in
                                    the presence of the consignee and check that all the items listed on the invoice are
                                    physically present. If no items are detailed on the invoice, the representative will
                                    deliver the sealed box. The consignee of the cargo must be in full mental and physical
                                    condition to receive the cargo; otherwise, the company will not be responsible.</p>
                                <p><strong>SHIPMENT OF VEHICLES:</strong> Pickup: The company will charge for the pickup of
                                    the vehicle depending on its location. The charge is for the use of the transportation
                                    plate. If the vehicle breaks down along the way to the port, the customer will be
                                    responsible for the costs of towing or any other expense related to transporting it to
                                    the final destination.</p>
                                <p><strong>CLAIMS FOR VEHICLES:</strong> The company is just an intermediary between the
                                    client and the shipping company; any claim related to vehicles arriving at their
                                    destination with any type of damage, the customer should make the claim to the
                                    corresponding shipping company, which is responsible for transporting them.</p>
                                <p><strong>IN CASE OF DELAY:</strong> This company, when receiving vehicles, will transport
                                    them to the dock within a maximum of seven days. After a vehicle arrives at the dock,
                                    customs will need to inspect it, which can take between 5 and 10 business days. We are
                                    not responsible for vehicle delays due to factors beyond this company’s control.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="card">
            <div class="card-body">
                <div class="row mt-5">


                    <div class="col-md-6">
                        <div class="pull-right m-t-30 text-start">
                            <div class="input-group mb-3">
                                <input class="form-control" type="file" id="recipientCedula" name="recipientCedula">
                            </div>
                            <p><span style="font-weight:500;color:red">I accept: Signture of Sender</span> </p>




                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="pull-right text-start">
                            <div class="input-group mb-3">
                                <input class="form-control" type="file" id="recipientCedula" name="recipientCedula">
                            </div>
                            <p><span style="font-weight:500;color:red">Receiver's Signature</span> </p>




                        </div>
                    </div>
                    <div class="col-md-12 mt-5 d-flex justify-content-center mb-5">
                        <a href="{{ route('user.invoice.index') }}"> <button type="button"
                                class="
                        btn btn-primary
                        font-weight-medium
                        rounded-pill
                        px-4
                      ">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-send feather-sm fill-white me-2">
                                        <line x1="22" y1="2" x2="11" y2="13"></line>
                                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                    </svg>
                                    Generate Invoice
                                </div>
                            </button></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
