<div class="container-fluid">
    <div class="card shadow mb-4">

        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-info ib">Edit</h6>
            </div>
            <div class="card-body">
                <form id="edit-form">
                    <div class="form-group">
                        <label for="invoice-number">Inoice number</label>
                        <input type="text" class="form-control" id="invoice-number" placeholder="invoice-number" name="invoice-number">
                    </div>
                    <div class="form-group">
                        <label for="doi">Date of Invoice</label>
                        <input type="date" class="form-control" id="doi" placeholder="Date" name="doi">
                    </div>
                    <div class="form-group">
                        <label for="icode">Item code</label>

                        <input type="number" class="form-control" id="icode" placeholder="item code" name="icode">
                    </div>
                    <div class="form-group">
                        <label for="idec">Description</label>
                        <textarea name="idec" class="form-control" id="idec" cols="30" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="iqty">Rate</label>
                        <input type="number" class="form-control" id="iqty" placeholder="Qty" name="iqty">
                    </div>
                    <div class="form-group">
                        <label for="irate">Rate</label>
                        <input type="number" class="form-control" id="irate" placeholder="Rate" name="irate">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" id="amount" placeholder="Amount" name="amount">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>