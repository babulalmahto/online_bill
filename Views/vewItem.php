<!DOCTYPE html>
<html>
    <title>Item page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <body>
        <form action="index.php?mdl=1" method="post" class="w3-light-grey w3-display-topmiddle" style="width:40%">
            <div class="w3-container" class="w3-card-4">
                <div class="w3-red w3-center">
                    <h2>Items Entry Table</h2>
                </div>

                <div>
                    <p><span class="w3-invalid-feedback w3-text-red"><?php echo $this->model->message; ?></span></p>
                    <p><span class="w3-invalid-feedback w3-text-red"><?php echo $this->model->error; ?></span></p>
                </div>

                <label class="w3-text"><b>Item Code</b></label>
                <input class="w3-input w3-border w3-round" name="txtCode" type="text" maxlength="4" placeholder="Enter code.." value="<?php echo $this->model->nCode; ?>">

                <label class="w3-text"><b>Item Description</b></label>
                <input class="w3-input w3-border w3-round" name="txtDescription" type="text" maxlength="50" placeholder="Enter description.." value="<?php echo $this->model->cDescription; ?>">

                <label class="w3-text"><b>Item Rate</b></label>
                <input class="w3-input w3-border w3-round" name="txtRate" type="text" placeholder="Enter rate.." value="<?php echo $this->model->nRate; ?>">

                <input class="w3-input w3-border" name="txtFlag" type="hidden" value="<?php echo $this->model->nFlag; ?>">

                <br>
                <div class="w3-center">
                <button class="w3-btn w3-grey w3-round" id="btnClear" name="btnClear" type="submit" value="Clear">Clear</button>
                <button class="w3-btn w3-btn-primary w3-green w3-round" id="btnSave" name="btnSave" type="submit" value="Save">Save</button>
                <button class="w3-btn w3-blue w3-round" id="btnRead" name="btnRead" type="submit" value="Read">Read</button>
                <button class="w3-btn w3-red w3-round" id="btnDelete" name="btnDelete" type="submit" value="Delete">Delete</button>
                <a href="index.php" class="w3-btn w3-teal w3-round">Close</a>
                </div>
                <br>
            </div>
        </form>
    </body>
</html> 