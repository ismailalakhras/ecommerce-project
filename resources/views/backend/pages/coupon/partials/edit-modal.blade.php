<div class="modal fade" id="editCouponModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;">
        <div class="modal-content" style="width:50rem">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Coupon Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-9 mx-auto" style="width: 100%">
                        <div class="card">
                            <div class="card-body">
                                <form id="editCouponForm" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="card-body">
                                        <label style="color: rgb(0, 60, 255); margin-bottom:5px">Code <span
                                                style="color: red">*</span></label>
                                        <input class="form-control mb-3" type="text" name="code">

                                        <label style="color: rgb(0, 60, 255); margin-bottom:5px">Type <span
                                                style="color: red">*</span></label>
                                        <select class="form-control mb-3" name="type">
                                            <option value="">Select Type</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percentage">Percentage</option>
                                        </select>

                                        <label style="color: rgb(0, 60, 255); margin-bottom:5px">Value <span
                                                style="color: red">*</span></label>
                                        <input class="form-control mb-3" type="number" name="value" step="0.01"
                                            min="0">

                                        <label style="color: rgb(0, 60, 255); margin-bottom:5px">Minimum Amount</label>
                                        <input class="form-control mb-3" type="number" name="minimum_amount"
                                            step="0.01" min="0">

                                        <label style="color: rgb(0, 60, 255); margin-bottom:5px">Usage Limit</label>
                                        <input class="form-control mb-3" type="number" name="usage_limit"
                                            min="1">

                                        <label style="color: rgb(0, 60, 255); margin-bottom:5px">Used Count</label>
                                        <input class="form-control mb-3" type="number" name="used_count" min="0"
                                            value="0">

                                        <label style="color: rgb(0, 60, 255); margin-bottom:5px">Is Active <span
                                                style="color: red">*</span></label>
                                        <select class="form-control mb-3" name="is_active">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>

                                        <label style="color: rgb(0, 60, 255); margin-bottom:5px">Starts At</label>
                                        <input class="form-control mb-3" type="datetime-local" name="starts_at">

                                        <label style="color: rgb(0, 60, 255); margin-bottom:5px">Expires At</label>
                                        <input class="form-control mb-3" type="datetime-local" name="expires_at">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button id="update-coupon-btn" type="button" class="btn btn-primary">Save
                                                changes</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
