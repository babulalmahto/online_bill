<!DOCTYPE html>
<html>
    <title>Report 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3pro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>
    <body>
        <form action="index.php?mdl=4" method="post" class="w3-light-grey w3-display-topmiddle" style="width:65%">
            <div class="w3-container" class="w3-card-4">
                <div class="w3-container w3-red">
                    <h2>Report 1</h2>
                </div>
                <br>

                <span class="w3-invalid-feedback w3-text-red"><?php echo $this->model->error; ?></span>

                <div class="w3-row w3-section">
                    <div class="w3-col l8 m7 w3-left">Statement of sales for
                        <input class="w3-border no-outline w3-round" style="width:150px" type="date" name="txtFromDate" id="txtFromDate"  value=""> To <input class="w3-border no-outline w3-round" style="width:150px" type="date" name="txtToDate" id="txtToDate" value="">
                    </div>
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
                                    <th class="w3-center" style="overflow: auto; width: 170px;">Bill Date</th>
                                    <th class="w3-center" style="overflow: auto; width: 120px;">Bill No.</th>
                                    <th class="w3-center" style="overflow: auto; width: 200px;height: 50px">Customer Name</th>
                                    <th class="w3-center" style="overflow: auto; width: 150px;">Gross</th>
                                    <th class="w3-center" style="overflow: auto; width: 150px;">Discount Price</th>
                                    <th class="w3-center" style="overflow: auto; width: 150px;">GST Price</th>
                                    <th class="w3-center" style="overflow: auto; width: 150px;">Net Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nCtr = 0;
                                $cCustName = "";
                                $cTotal = 0;
                                $nGrandTotal = 0;
                                $nGrossTotal = 0;
                                $nDisTotal = 0;
                                $nGstTotal = 0;
                                $nNetTotal = 0;
                                $nBillNum = 0;
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
                                        $cTotal = $cTotal + $this->model->nNet[$nCount];
                                        $nGrandTotal += $this->model->nNet[$nCount];
                                        $cNameChanged = "N";
                                        ?>
        <!--                                        <tr>
                                                    <td class="w3-center"><?php // echo $this->model->nGross[$nctr];  ?></td>
                                                    <td class="w3-center"><?php // echo $this->model->nDis[$nctr];  ?></td>
                                                    <td class="w3-center"><?php // echo $this->model->nGST[$nctr];  ?></td>
                                                    <td class="w3-center"><?php // echo $this->model->nNet[$nctr];  ?></td>
                                                </tr>-->
                                        <?php
                                    } else {
                                        if ($nCount == 0) {
                                            $cNameChanged = "N";
                                        } else {
                                            $cNameChanged = "Y";
                                        }
                                        $cName = $this->model->cCustName[$nCount];
                                        $cTotal = 0;
                                        $nGrossTotal = $nGrossTotal + $this->model->nGross[$nCount];
                                        $nDisTotal += $this->model->nDis[$nCount];
                                        $nGstTotal += $this->model->nGST[$nCount];
                                        $nNetTotal += $this->model->nNet[$nCount];
                                        $nGrandTotal = $nGrossTotal - $nDisTotal + $nGstTotal;
                                        $nBillNum = $this->model->nBillNo[$nCount];
                                        $cTotal = $this->model->nNet[$nCount];
                                        ?>
                                        <tr>
                                            <td class="w3-center"><?php echo $this->model->nDate[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nBillNo[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->cCustName[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nGross[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nDis[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nGST[$nCount]; ?></td>
                                            <td class="w3-center"><?php echo $this->model->nNet[$nCount]; ?></td>
                                        </tr>
                                        <?php
                                    }

                                    if ($nCount == ($nMax - 1)) {
                                        ?>
                                        <tr style="font-weight:bold;text-align: right;height: 40px">
                                            <td colspan="3">Total:</td>
                                            <td><?php echo $nGrossTotal; ?></td>
                                            <td><?php echo $nDisTotal; ?></td>
                                            <td><?php echo $nGstTotal; ?></td>
                                            <td><?php echo $nNetTotal; ?></td>
                                        </tr>
                                        <tr style="font-weight:bold;text-align: right;height: 40px">
                                            <td colspan="6">Grand Total:</td>
                                            <td><?php echo $nGrandTotal; ?></td>
                                        </tr>

                                        <?php
                                    }
                                } $nCount++;
                                ?>
                            </tbody>
                        </table>
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
                        <button type="button" class="w3-btn w3-blue w3-round w3-teal" style="width: 100px" name="btnPrint" id="btnPrint" onclick="printDiv()">Print</button> 
                    </div>
                    <div class="w3-col l3 m3">
                        <a href="index.php" class="w3-btn w3-red w3-round" style="width: 100px;">Close</a>
                    </div>
                </div>
                <br><br>
            </div>
            <script>
                function printDiv() {
                    var Header = document.getElementById("ShowOnPrint").innerHTML;
                    var printContents = document.getElementById("PrintContainer").innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = Header + printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
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