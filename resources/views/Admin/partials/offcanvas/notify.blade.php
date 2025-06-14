<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel1">
    <div class="offcanvas-header border-bottom border-block-end-dashed">
        <h5 class="offcanvas-title" id="offcanvasRightLabel1"
            style="font-family: Heebo, sans-serif !important; font-weight: 700">
            Notifications
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3">

        {{-- Pending Withdraw --}}
        <div style="display: none" id="isWithdraw" class="pt-3 pb-3">
            <a href="{{ route('pending.withdraw') }}">
                <div class="alert pt-3 pb-3 alert-danger d-flex align-items-center" role="alert">
                    <div class="btn btn-icon btn-md btn-danger-transparent rounded-pill">
                        <i class="bi bi-wallet"></i>
                    </div>

                    <div class="p-2" style="font-weight: 600; font-size: 15px">
                        Pending Withdraw Request
                    </div>
                    <div style="margin-left: auto;">
                        <span class="btn btn-danger"><i class="bi bi-box-arrow-up-right"></i></span>
                    </div>
                </div>
            </a>
        </div>

        {{-- Pending Deposit Request --}}
        <div style="display: none" id="isDeposit" class="pt-3 pb-3">
            <a href="{{ route('pending.deposits') }}">
                <div class="alert pt-3 pb-3 alert-primary d-flex align-items-center" role="alert">
                    <div class="btn btn-icon btn-md btn-primary-transparent rounded-pill">
                        <i class="bi bi-wallet"></i>
                    </div>

                    <div class="p-2" style="font-weight: 600; font-size: 15px">
                        Pending Deposit Request
                    </div>
                    <div style="margin-left: auto;">
                        <span class="btn btn-primary"><i class="bi bi-box-arrow-up-right"></i></span>
                    </div>
                </div>
            </a>
        </div>


    </div>
</div>
