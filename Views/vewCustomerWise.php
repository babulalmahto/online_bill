<!DOCTYPE html>
<html>
    <title>Report 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3pro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>
    <body>
        <form action="index.php?mdl=5" method="post" class="w3-light-grey w3-display-topmiddle" style="width:65%">
            <div class="w3-container" class="w3-card-4">
                <div class="w3-container w3-red">
                    <h2>Report 2</h2>
                </div>
                <br>

                <span class="w3-invalid-feedback w3-text-red"><?php echo $this->model->error; ?></span>

                <div class="w3-row w3-section">
                    <div class="w3-col l8 m7 w3-left">Customer wise sale for
                        <input class="w3-border no-outline w3-round" style="width:150px" type="date" name="txtFromDate" id="txtFromDate"  value=""> To <input class="w3-border no-outline w3-round" style="width:150px" type="date" name="txtToDate" id="txtToDate" value="">
                    </div>
                </div>

                <p class="w3-center w3-margin">Or</p>
                <div class="w3-row w3-section">
                    <div class="w3-col l3">Customer wise sale for :-</div>
                    <div class="w3-col l3 m4"><input class="w3-input w3-border-0 w3-border-bottom no-outline w3-round" placeholder="Customer Name" id="txtName" name="txtName" value="<?php echo implode(", ", $this->model->cCustName); ?>"></div>
                </div>


                <div id = "ShowOnPrint" style = "display:none">
                    <header class = "w3-container w3-tyle">
                        <h2 align = "center">Statement of Sales from <?php echo $this->model->nDate1; ?> To <?php echo $this->model->nDate2; ?></h2>  
                    </header>
                </div> 
                <hr>

                <div class="w3-border w3-round tabcity w3-animate-opacity" id="PrintContainer" style="display:block;">
                    <div class="w3-row w3-responsive">
                        <table class="w3-table-centered" id="itemTable">
                            <thead>
                                <tr class="w3-grey">
                                    <th class="w3-center" style="overflow: auto; width: 200px;height: 50px">Sl No</th>
                                    <th class="w3-center" style="overflow: auto; width: 170px;">Bill Date</th>
                                    <th class="w3-center" style="overflow: auto; width: 120px;">Bill No.</th>
                                    <th class="w3-center" style="overflow: auto; width: 150px;">Customer Name</th>
                                    <th class="w3-center" style="overflow: auto; width: 150px;">Name</th>
                                    <th class="w3-center" style="overflow: auto; width: 150px;">Quantity</th>
                                    <th class="w3-center" style="overflow: auto; width: 130px;">Rate</th>
                                    <th class="w3-center" style="overflow: auto; width: 150px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nCtr = 0;
                                $cCustName = "";
                                $cNameChanged = "Y";
                                $nMax = count($this->model->nBillNo);
                                for ($nCount = 0; $nCount < $nMax; $nCount++) {
                                    $cFound = "N";
                                    $nMax2 = count($this->model->cCustName);
                                    for ($nctr = $nCount; $nctr < $nMax2; $nctr++) {
                                        if ($cCustName == $this->model->cCustName[$nctr]) {

                                            $cFound = "Y";
                                            break;
                                        }
                                    }
                                    if ($cFound == "Y") {

                                        $grossAmt = $this->model->nGross[$nCount];
                                        $discAmt = $this->model->nDisc[$nCount];
                                        $taxAmt = $this->model->nTax[$nCount];
                                        $netAmt = $this->model->nNetTotal[$nCount];
                                        $cNameChanged = "N";
                                        ?>
                                        <tr>
                                            <td class="w3-center"><?php echo $nCount + 1; ?></td>
                                            <td class="w3-center"></td>
                                            <td class="w3-center"></td>
                                            <td class="w3-center"></td>
                                            <td class="w3-center"><?php echo $this->model->cItName[$nctr]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nQuantity[$nctr]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nRate[$nctr]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nNet[$nctr]; ?></td>
                                        </tr>
                                        <?php
                                    } else {
                                        if ($nCount == 0) {
                                            $cNameChanged = "N";
                                        } else {
                                            ?>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th class="w3-center">Gross: <?php echo $grossAmt; ?></th>
                                                <th class="w3-center">Discount: <?php echo $discAmt; ?></th>
                                                <th class="w3-center">GST: <?php echo $taxAmt; ?></th>
                                                <th class="w3-center">Net Amount: <?php echo $netAmt; ?></th>
                                            </tr>
                                            <?php
                                        }
                                        $cCustName = $this->model->cCustName[$nCount];
                                        $this->model->dTotal += $this->model->nNetTotal[$nCount];
                                        ?>
                                        <tr>
                                            <td class="w3-center"><?php echo $nCount + 1; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nDate[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nBillNo[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->cCustName[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->cItName[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nQuantity[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nRate[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nNet[$nCount]; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    if ($nCount == ($nMax - 1)) {
                                        ?>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="w3-center">Gross: <?php echo $grossAmt; ?></th>
                                            <th class="w3-center">Discount: <?php echo $discAmt; ?></th>
                                            <th class="w3-center">GST: <?php echo $taxAmt; ?></th>
                                            <th class="w3-center">Net Amount: <?php echo $netAmt; ?></th>
                                        </tr>
                                        <?php
                                    }
                                }
                                $nCount++;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="w3-row w3-responsive">
                    <div class="w3-col l9 m7 s5">&nbsp;</div>
                    <div class="w3-col l1 m1 s2">Total:</div>
                    <div>
                        <input class="w3-col l2 m3 s5 w3-input no-outline w3-right-align w3-round" style="width: 130px" name="txtTotal" id="txtTotal" value="<?php echo $this->model->dTotal; ?>" readonly>
                    </div>
                </div>
                <div id="TotalAmount" style="display:none">
                    <div class="w3-container">
                        <div class="w3-row w3-margin-top">
                            <div class="w3-right">
                                Total: <input class="w3-input no-outline w3-right-align w3-round" style="width: 200px" name="txtTotal" id="txtTotal" value="<?php echo $this->model->dTotal; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w3-center">
                    <div class="">&nbsp;</div>
                    <div class="w3-col l3 m3">
                        <input class="w3-btn w3-grey w3-round" style="width: 100px;" type="submit" value="Clear" name="btnClear" id="btnClear">
                    </div>
                    <div class="w3-col l3 m3">
                        <input class="w3-btn w3-green w3-round" style="width: 100px;" type="submit" value="Show" name="btnShow" id="btnShow" onclick="total()">
                    </div>
                    <div class="w3-col l3 m3">
                        <button type="button" class="w3-btn w3-teal w3-round" style="width: 100px" name="btnPrint" id="btnPrint" onclick="printDiv()">Print</button> 
                    </div>
                    <div class="w3-col l3 m3">
                        <a href="index.php" class="w3-btn w3-red w3-round" style="width: 100px;">Close</a>
                    </div>
                </div>
                <br><br>
            </div>
            <script><script>
                function printDiv() {
                        var Header = document.getElementById("ShowOnPrint").innerHTML;
                        var printContents = document.getElementById("PrintContainer").innerHTML;
                        var total = document.getElementById("TotalAmount").innerHTML;
                        var originalContents = document.body.innerHTML;
                        document.body.innerHTML = Header + printContents + total;
                        window.print();
                        document.body.innerHTML = originalContents;
                }
                
                function getName() {
                var cCode = document.getElementById("txtCode").value;
                if (cCode != "") {
                    $.getJSON("ajxReport2.php?mode=" + cCode, function (data) {
                        $.each(data, function (index, items) {
                            document.getElementById("txtName").value = items.txtName;
                        });
                    });
                } else {
                    document.getElementById("txtName").value = "";
                }

            </script>

        </form>
    </body>
</html> 

<!--<script>

    function getName() {
        var cCode = document.getElementById("txtFromDate").value;
        if (cCode != "") {
            $.getJSON("ajxCustomerReport1.php?mode=" + cCode, function (data) {
                $.each(data, function (index, items) {
                    document.getElementById("txtCustName").value = items.txtCustName;
                });
            });
        } else {
            document.getElementById("txtCustName").value = "";
        }
    }

    function getBillDetails(row) {
        var cItem = document.getElementById("txtFromDate" + row).value;
        if (cItem != "") {
            $.getJSON("ajxBillDetails.php?mode=" + cItem, function (data) {
                $.each(data, function (index, bills) {
                    document.getElementById("txtDate" + row).value = bills.txtDate;
                    document.getElementById("txtBillNo" + row).value = bills.txtBillNo;
                    document.getElementById("txtGross" + row).value = bills.txtGross;
                    document.getElementById("txtDisc" + row).value = bills.txtDisc;
                    document.getElementById("txtGst" + row).value = bills.txtGst;
                    document.getElementById("txtNet" + row).value = bills.txtNet;
                });
            });
        } else {
            document.getElementById("txtDate" + row).value = "";
            document.getElementById("txtBillNo" + row).value = "";
            document.getElementById("txtGross" + row).value = "";
            document.getElementById("txtDisc" + row).value = "";
            document.getElementById("txtGst" + row).value = "";
            document.getElementById("txtNet" + row).value = "";
        }
        TblRow(row, 'A');
    }
</script>-->