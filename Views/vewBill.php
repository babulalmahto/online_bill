<!DOCTYPE html>
<html>
    <title>bill page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3pro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>
    <body>
        
        <form id="Bill" action="index.php?mdl=3" method="post" class="w3-light-grey w3-display-topmiddle" style="width:65%">
            <div class="w3-container" class="w3-card-4" >
                <div class="w3-container w3-red">
                    <h2>Bill</h2>
                </div>
                <br>

                <span class="w3-invalid-feedback w3-text-red"><?php echo $this->model->error; ?></span>
                <span class="w3-invalid-feedback w3-text-red"><?php echo $this->model->message; ?></span>
                <div class="w3-row">
                    <div class="w3-col s3">
                        <p>Bill No.:</p>
                    </div>
                    <div class="w3-col s3 ">
                        <input class="w3-input w3-border w3-round" style="width: 100px" maxlength="4" id="txtBill" name="txtBill" type="text" value="<?php echo $this->model->nBill; ?>">
                    </div>
                    <div class="w3-col s2">
                        <p>Date:</p>
                    </div>
                    <div class="w3-col s4 ">
                        <input class="w3-input w3-border w3-round" style="width: 170px" name="txtDate" type="date" value="<?php echo $this->model->nDate; ?>">
                    </div>
                    <br><br><br>
                    <div class="w3-col s3">
                        <p>Customer Code:</p>
                    </div>
                    <div class="w3-col s3 ">
                        <input class="w3-input w3-border w3-round" style="width: 100px" maxlength="4" id="txtCustomerCode" name="txtCustomerCode" onkeyup="getName()" type="text" value="<?php echo $this->model->nCustomerCode; ?>">
                    </div>
                    <div class="w3-col s2">
                        <p>Name:</p>
                    </div>
                    <div class="w3-col s4 ">
                        <input class="w3-input w3-border w3-round" style="width: 170px" id="txtName" name="txtName" type="text" value="<?php echo $this->model->cName; ?>" readonly>
                    </div>
                </div>



                <div class="w3-animate-opacity" style="display:block;">
                    <div class="w3-row w3-responsive">
                        <table class="w3-table-centered" id="itemTable" style="overflow: auto;width: 100%;">
                            <thead>
                                <tr class="w3-grey">
                                    <th style="width:50px;">S No.</th>
                                    <th style="width:70px;">Item Code</th>
                                    <th style="width:150px;">Item Name</th>
                                    <th style="width:80px;">Quantity</th>
                                    <th style="width:80px;">Rate (Rs)</th>
                                    <th style="width:80px;">Amount (Rs)</th>
                                    <th><i class="fa fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nMax = count($this->model->nCode);
                                $nCount = 0;
                                for ($nCount = 0; $nCount < $nMax; $nCount++) {
                                    ?>
                                    <tr id="row<?php echo $nCount + 1; ?>">
                                        <td class="w3-center" style="width: 50px; overflow: auto;" class="w3-center"><?php echo$nCount + 1; ?></td>
                                        <td class="w3-center"><input class="w3-border-0 no-outline w3-center form-control" style="width:70px" type="text" name="txtCode<?php echo $nCount + 1; ?>" id="txtCode<?php echo $nCount + 1; ?>" onchange="getItem(<?php echo $nCount + 1; ?>)" value="<?php echo $this->model->nCode[$nCount]; ?>"></td>
                                        <td class="w3-center"><input class="w3-border-0 no-outline w3-center form-control" style="width:150px" type="text" name="txtTableName<?php echo $nCount + 1; ?>" id="txtTableName<?php echo $nCount + 1; ?>" value="<?php echo $this->model->cTableName[$nCount]; ?>" readonly></td>
                                        <td class="w3-center"><input class="w3-border-0 no-outline w3-center form-control" style="width:80px" type="text" name="txtQuantity<?php echo $nCount + 1; ?>" id="txtQuantity<?php echo $nCount + 1; ?>" value="<?php echo $this->model->nQuantity[$nCount]; ?>" onkeyup="calculateTotal()"></td>
                                        <td class="w3-center"><input class="w3-border-0 no-outline w3-center form-control" style="width:80px" type="text" name="txtRate<?php echo $nCount + 1; ?>" id="txtRate<?php echo $nCount + 1; ?>" value="<?php echo $this->model->nRate[$nCount]; ?>" readonly></td>
                                        <td class="w3-center"><input class="w3-border-0 no-outline w3-center form-control" style="width:80px" type="text" name="txtAmount<?php echo $nCount + 1; ?>" id="txtAmount<?php echo$nCount + 1; ?>" readonly value="<?php echo $this->model->nAmount[$nCount]; ?>"></td>
                                        <td class="w3-center" style="width: 20px; overflow: auto;"><input class="w3-btn w3-small w3-border-0 w3-red" type="button" id="cRemove<?php echo $nCount + 1; ?>" onclick="TblRow(<?php echo $nCount + 1; ?>, 'D'); calculateTotal()" value="-"></td>
                                    </tr>
                                    <?php
                                }
                                $nCount++;
                                ?>
                                <tr id="row<?php echo $nCount; ?>">
                                    <td class="w3-center" style="width:50px; overflow: auto;" class="w3-center"><?php echo$nCount; ?></td>
                                    <td class="w3-center" style="width:70px; overflow: auto;"><input class="w3-border-0 no-outline w3-center form-control" style="width:70px;" type="text" name="txtCode<?php echo $nCount; ?>" id="txtCode<?php echo $nCount; ?>" onchange="getItem(<?php echo $nCount; ?>)" value=""></td>
                                    <td class="w3-center" style="width:150px; overflow: auto;"><input class="w3-border-0 no-outline w3-center form-control" style="width:150px;" type="text" name="txtTableName<?php echo $nCount; ?>" id="txtTableName<?php echo $nCount; ?>" value="" readonly></td>
                                    <td class="w3-center" style="width:80px; overflow: auto;"><input class="w3-border-0 no-outline w3-center form-control" style="width:80px;" type="text" name="txtQuantity<?php echo $nCount; ?>" id="txtQuantity<?php echo $nCount; ?>" value="0" onkeyup="calculateTotal()"></td>
                                    <td class="w3-center" style="width:80px; overflow: auto;"><input class="w3-border-0 no-outline w3-center form-control" style="width:80px;" type="text" name="txtRate<?php echo $nCount; ?>" id="txtRate<?php echo $nCount; ?>" value="0" readonly></td>
                                    <td class="w3-center" style="width:80px; overflow: auto;"><input class="w3-border-0 no-outline w3-center form-control" style="width:80px;" type="text" name="txtAmount<?php echo $nCount; ?>" id="txtAmount<?php echo $nCount; ?>" readonly value="0"></td>
                                    <td class="w3-center" style="width: 20px; overflow: auto;"><input class="w3-btn w3-small w3-border-0 w3-red" type="button" id="cRemove<?php echo $nCount; ?>" onclick="TblRow(<?php echo $nCount; ?>, 'D'); calculateTotal()" value="-"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="w3-row w3-responsive">
                    <div class="w3-row w3-section">
                        <div class="w3-col l9 m7 w3-center">Gross:</div>
                        <div class="w3-col l3 m5 w3-right">
                            <input class="w3-border w3-right-align w3-round" id="txt1Total" name="txtTotal" type="text" value="<?php echo $this->model->nTotal; ?>" readonly>
                        </div>
                    </div>
                    <div class="w3-row w3-section">
                        <div class="w3-col l8 m7 w3-center">Discount :
                            <div class="w3-col l3 m5 w3-right">
                                <input class="w3-border no-outline w3-right-align w3-round" style="width:100px" id="txtDiscount1" name="txtDiscount1" onkeyup="calculateTotal()" type="text" value="<?php echo $this->model->nDiscount1; ?>">
                            </div>
                        </div>
                        <div class="w3-col l3 m5 w3-right">
                            <input class="w3-border no-outline  w3-right-align w3-round" id="txtDiscount2" name="txtDiscount2" type="text" value="<?php echo $this->model->nDiscount2; ?>" readonly>
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col l8 m7 w3-center">GST :
                            <div class="w3-col l3 m5 w3-right">
                                <input class="w3-border no-outline w3-right-align w3-round" style="width:100px" id="txtGST1" name="txtGST1" onkeyup="calculateTotal()" type="text" value="<?php echo $this->model->nGst1; ?>">
                            </div>
                        </div>
                        <div class="w3-col l3 m5 w3-right">
                            <input class="w3-border no-outline w3-right-align w3-round" id="txtGST2" name="txtGST2" type="text" value="<?php echo $this->model->nGst2; ?>" readonly>
                        </div>
                    </div>

                    <div class="w3-row w3-section">
                        <div class="w3-col l9 m7 w3-center">Grand Total:</div>
                        <div class="w3-col l3 m5 w3-right">
                            <input class="w3-border w3-right-align w3-round" id="txtGrandTotal" name="txtGrandTotal" type="text" value="<?php echo $this->model->nGrandTotal; ?>" readonly>
                            <input class="w3-border-0 w3-border-bottom no-outline w3-round" name="txtLastRow" id="txtLastRow" value="<?php echo $nCount; ?>" readonly style="display: none">
                            <input type="hidden" name="txtFlag" id="txtFlag" value="<?php echo $this->model->nFlag; ?>">
                        </div>
                    </div>
                </div>


                <br>
                <div class="w3-center">
                    <div class="w3-col l2 m3">
                        <button class="w3-btn w3-grey w3-round" style="width: 100px;" id="btnClear" name="btnClear" type="submit" value="Clear">Clear</button>
                    </div>
                    <div class="w3-col l2 m3">
                        <button class="w3-btn w3-btn-primary w3-green w3-round" style="width: 100px;" id="btnSave" name="btnSave" type="submit" value="Save">Save</button>
                    </div>
                    <div class="w3-col l2 m3">
                        <button class="w3-btn w3-blue w3-round" style="width: 100px;" id="btnSearch" name="btnSearch" type="submit" value="Search">Search</button>
                    </div>
                    <div class="w3-col l2 m3">
                        <button class="w3-btn w3-red w3-round" style="width: 100px;" id="btnDelete" name="btnDelete" type="submit" value="Delete">Delete</button>
                    </div>
                    <div class="w3-col l2 m3">
                        <a href="index.php" class="w3-btn w3-teal w3-round" style="width: 100px;">Close</a>
                    </div>
                </div>
                <br><br>
            </div>
        </form>
    </body>
</html> 


<script>

    function getName() {
        var cCode = document.getElementById("txtCustomerCode").value;
        if (cCode != "") {
            $.getJSON("ajxCustomer.php?mode=" + cCode, function (data) {
                $.each(data, function (index, items) {
                    document.getElementById("txtName").value = items.txtName;
                });
            });
        } else {
            document.getElementById("txtName").value = "";
        }
    }
    function getItem(row) {
        var cItem = document.getElementById("txtCode" + row).value;
        if (cItem != "") {
            $.getJSON("ajxItem.php?mode=" + cItem, function (data) {
                $.each(data, function (index, items) {
                    document.getElementById("txtTableName" + row).value = items.txtTableName;
                    document.getElementById("txtRate" + row).value = items.txtRate;
                });
            });
        } else {
            document.getElementById("txtTableName" + row).value = "";
            document.getElementById("txtRate" + row).value = "";
        }
        TblRow(row, 'A');
    }



    function TblRow(nCurRowNo, cType) {
        var nCtr = 0;
        var html = "";
        var table = document.getElementById("itemTable");
        var row = Number(document.getElementById("txtLastRow").value);
        var count = row + 1;

        if (row == nCurRowNo) {
            html = '<tr id="row' + count + '">';
            html += '<td class="w3-center" style="width:50px">' + count + '</td>';
            html += '<td class="w3-center" style="width:70px"><input class="w3-border-0 no-outline w3-center form-control" style="width: 70px" type="text" name="txtCode' + count + '" id="txtCode' + count + '" onchange="getItem(' + count + ')" value="""></td>';
            html += '<td class="w3-center" style="width:150px"><input class="w3-border-0 no-outline w3-center form-control" style="width: 150px" type="text" name="txtTableName' + count + '" id="txtTableName' + count + '" value="" readonly></td>';
            html += '<td class="w3-center" style="width:80px"><input class="w3-border-0 no-outline w3-center form-control" style="width: 80px" type="text" name="txtQuantity' + count + '" id="txtQuantity' + count + '" onkeyup="calculateTotal()" value="0"></td>';
            html += '<td class="w3-center" style="width:80px"><input class="w3-border-0 no-outline w3-center form-control" style="width: 80px" type="text" name="txtRate' + count + '" id="txtRate' + count + '" value="0" readonly></td>';
            html += '<td class="w3-center" style="width:80px"><input class="w3-border-0 no-outline w3-center form-control" style="width: 80px" type="text" name="txtAmount' + count + '" id="txtAmount' + count + '" readonly value="0"></td></td>';
            html += '<td class="w3-center" style="width: 20px;"><input class="w3-btn w3-small w3-border-0 w3-red fa fa-minus" type="button" id="cRemove' + count + '" onclick="TblRow(' + count + ',\'D\'); calculateTotal()" value="-"></td>';
            html += '</tr>';
            $(table).find('tbody').append(html);
            document.getElementById("txtLastRow").value = count;
        }
        if (cType == "D") {

            var trId = "row" + nCurRowNo;
            var row = document.getElementById(trId);
            row.parentNode.removeChild(row);
            nCtr = 0;

            $('#itemTable tbody tr').each(function (row, tr) {
                if ($(tr).find('td:eq(1)').find('input').val() == "") {
                    nCtr = 0;
                }
            });
            if (nCtr > 0) {
                nCurRowNo = row;
            }
        }
        nCtr = 1;
        $('#itemTable tbody tr').each(function (row, tr) {
            $(tr).find('td:eq(0)').html(nCtr);
            nCtr++;
        });
    }

    function calculateTotal() {
        var cQuantity = 0;
        var dRate = 0;
        var nAmount = "";
        var cTax = 0;
        var cGross = 0;
        var cTax = 0;
        var taxPrice = 0;
        var cDiscount = 0;
        var discountPrice = 0;
        var netPrice = 0;
        $('#itemTable tbody tr').each(function (row, tr) {
            cQuantity = Number($(tr).find('td:eq(3)').find('input').val());
            dRate = Number($(tr).find("td:eq(4) input[type='text']").val());
            nAmount = cQuantity * dRate;
            $(tr).find("td:eq(5) input[type='text']").val(nAmount);
            cGross += nAmount;
            document.getElementById("txt1Total").value = cGross.toFixed(2);
        });
        $('#txtDiscount1').each(function () {
            cDiscount = document.getElementById("txtDiscount1").value;
            discountPrice = (cGross * cDiscount) / 100;
            document.getElementById("txtDiscount2").value = discountPrice.toFixed(2);
        });
        $('#txtGST1').each(function () {
            cTax = document.getElementById("txtGST1").value;
            taxPrice = ((cGross - discountPrice) * cTax) / 100;
            document.getElementById("txtGST2").value = taxPrice.toFixed(2);
            netPrice = cGross - discountPrice + taxPrice;
            document.getElementById("txtGrandTotal").value = netPrice.toFixed(2);
        });
    }
    function openCity(evt, cityName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " w3-red";
    }

//    function calculateTotal() {
//        var yourQuantity = document.getElementById("txtQuantity").value;
//        var yourRate = document.getElementById("txtRate").value;
//        var totalAmount = yourQuantity * yourRate;
//        document.getElementById("txtAmount").value = totalAmount;
//        document.getElementById("txtTotal").value = totalAmount;
//
//        var yourDiscount = document.getElementById("txtDiscount1").value;
//        var totalDiscount = (totalAmount * yourDiscount) / 100;
//        document.getElementById("txtDiscount2").value = totalDiscount;
//
//        var yourGST = document.getElementById("txtGST1").value;
//        var totalGST = (totalAmount * yourGST) / 100;
//        document.getElementById("txtGST2").value = totalGST;
//
//        var grandTOTAL = totalAmount - totalDiscount + totalGST;
//        document.getElementById("grandTotal").value = grandTOTAL;
//    }
</script>