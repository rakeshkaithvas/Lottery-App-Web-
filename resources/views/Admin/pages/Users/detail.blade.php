@extends('Admin.layouts.app')

@section('content')

@section('title', 'User Details')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

{{-- Amounts --}}
<style>


    .thumbnail {
      max-width: 150px;
      cursor: pointer;
      border-radius: 6px;
    }

    .lightbox {
      position: fixed;
      display: none;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.85);
      justify-content: center;
      align-items: center;
      z-index: 1000;
      flex-direction: column;
      padding: 20px;
    }

    .image-container {
      position: relative;
      overflow: auto;
      max-width: 90vw;
      max-height: 90vh;
      background: #fff;
      border-radius: 8px;
      padding: 10px;
    }

    #lightboxImage {
      max-width: 100%;
      height: auto;
      transform-origin: center center;
      transition: transform 0.3s ease;
      display: block;
    }

    .zoom-controls {
      position: absolute;
      bottom: 10px;
      right: 10px;
      display: flex;
      gap: 10px;
      background: rgba(0, 0, 0, 0.4);
      padding: 5px 10px;
      border-radius: 8px;
      z-index: 10;
    }

    .zoom-controls button {
      background: #fff;
      border: none;
      padding: 8px 15px;
      font-size: 20px;
      border-radius: 5px;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      user-select: none;
    }

    .lightbox-close-hint {
      margin-top: 10px;
      color: #ccc;
      font-size: 14px;
    }
  </style>

<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body p-0">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="mb-3">
                            <span class="d-block fw-regular fs-12">Balance</span>
                        </div>

                    </div>
                    <div>
                        <p class="mb-0">
                            <span class="fs-24 fw-semibold">{{ $setting->currency_symbol }} {{ $user->balance ?? '0'
                                }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body p-0">
                <div class="p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="mb-3">
                            <span class="d-block fw-regular fs-12">Total Deposits</span>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $setting->currency_symbol }} {{ $total_deposit ?? '0' }}</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <!-- View All Button -->
                        <a href="{{ route('all.deposits') }}?email={{ urlencode($user->email) }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body p-0">
                <div class="p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="mb-3">
                            <span class="d-block fw-regular fs-12">Total Withdraws</span>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $setting->currency_symbol }} {{ $total_withdraw ?? '0'
                                }}</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <!-- View All Button -->
                        <a href="{{ route('all.withdraw') }}?email={{ urlencode($user->email) }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Tickets --}}
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body p-0">
                <div class="p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="mb-3">
                            <span class="d-block fw-regular fs-12">Total Ticket</span>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $total_ticket ?? '0'
                                }}</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <!-- View All Button -->
                        <a href="{{ route('ticket.log') }}?email={{ urlencode($user->email) }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body p-0">
                <div class="p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="mb-3">
                            <span class="d-block fw-regular fs-12">Total Ticket Buy Amount</span>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $setting->currency_symbol }} {{ $total_ticket_amount ??
                                    '0' }}</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <!-- View All Button -->
                        <a href="{{ route('ticket.log') }}?email={{ urlencode($user->email) }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body p-0">
                <div class="p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="mb-3">
                            <span class="d-block fw-regular fs-12">Total Win</span>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $total_win ??
                                    '0' }}</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <!-- View All Button -->
                        <a href="{{ route('winner.log') }}?email={{ urlencode($user->email) }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Refer --}}
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body p-0">
                <div class="p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="mb-3">
                            <span class="d-block fw-regular fs-12">Total Win Amount</span>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $total_win ??
                                    '0' }}</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <!-- View All Button -->
                        <a href="{{ route('winner.log') }}?email={{ urlencode($user->email) }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body p-0">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="mb-3">
                            <span class="d-block fw-regular fs-12">Referred By</span>
                        </div>
                        <div>
                            <span class="avatar bg-primary">
                                <i class="bi bi-arrow-down-up fs-18"></i>
                            </span>
                        </div>
                    </div>
                    <div>
                        <p class="mb-0">
                            <span class="fs-20 fw-semibold">{{ $user->referred->referrer->name ?? 'NONE' }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body p-0">
                <div class="p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <div class="mb-3">
                            <span class="d-block fw-regular fs-12">Total Reffered User</span>
                        </div>
                        <div>
                            <p class="mb-0">
                                <span class="fs-24 fw-semibold">{{ $total_reffered_user ??
                                    '0' }}</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <!-- View All Button -->
                        <a href="{{ route('referral.log') }}?email={{ urlencode($user->email) }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




{{-- Dialogs --}}
<div class="modal fade" id="addBalance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Balance</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.balance', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Amount:</label>
                        <input type="number" class="form-control" id="recipient-name" placeholder="Enter amount"
                            name="amount" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="minusBalance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Minus Balance</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('remove.balance', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Amount:</label>
                        <input type="number" class="form-control" id="recipient-name" placeholder="Enter amount"
                            name="amount" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="blockUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="blockUser">
                    Block {{ $user->name }}
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('active.block.user', $user->id) }}" method="POST">
                    @csrf
                    @if(!isset($hideForm))
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Reason:</label>
                        <textarea class="form-control" id="message-text" placeholder="Enter Reason" name="reason" required></textarea>
                    </div>

                    @else
                    Do you really want to execute?
                    @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="confirmBlockUser">@if (isset($hideForm))
                    Inactive
                    @else
                    Block
                @endif</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="activeUser" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel">Active {{ $user->name }}
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you really want to execute?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <a href="{{ route('active.block.user', $user->id) }}"><button type="button" class="btn btn-primary">Yes</button></a>
            </div>
        </div>
    </div>
</div>



<div class="btn-list mb-4">
    <button class="btn btn-success label-btn" data-bs-toggle="modal"
    data-bs-target="#addBalance">
        <i class="ri-add-circle-line label-btn-icon me-2"></i>
        Add Balance
    </button>
    <button class="btn btn-secondary label-btn" data-bs-toggle="modal"
    data-bs-target="#minusBalance">
        <i class="ri-indeterminate-circle-line label-btn-icon me-2"></i>
        Minus Balance
    </button>
    @if($user->status == 'approved')
    <button class="btn btn-danger label-btn" data-bs-toggle="modal"
    data-bs-target="#blockUser">
        <i class="ri-indeterminate-circle-line label-btn-icon me-2"></i>
        Ban User
    </button>
    @else
    <button class="btn btn-warning label-btn" data-bs-toggle="modal"
    data-bs-target="#activeUser">
        <i class="ri-indeterminate-circle-line label-btn-icon me-2"></i>
        Active User
    </button>
    @endif
</div>

<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Details
                </div>
            </div>
            <div style="margin-left: 1rem; margin-top: 1rem; margin-right: 1rem">

                <div class="row mb-3">

                    <div class="col-xl-6">
                        <label for="input-rounded" class="form-label">Full Name<span
                                class="small text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" id="" required value="{{ $user->name }}"
                            placeholder="Enter full name" readonly>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label for="joining_bonus_amount" class="form-label">User Email<span
                                class="small text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control" type="text" name="email" id="" required
                                value="{{ $user->email }}" placeholder="Enter email" readonly>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-xl-6">
                        <label for="input-rounded" class="form-label">Phone Number<span
                                class="small text-danger">*</span></label>
                        <input class="form-control" type="text" name="phone" id="" required value="{{ $user->phone }}"
                            placeholder="Enter phone number" readonly>
                    </div>
                @if (!empty($user->user_document))
                    <img src="{{ asset($user->user_document) }}" alt="User Document" class="thumbnail" id="thumbImage">

                    <div class="lightbox" id="lightbox">
                        <div class="image-container">
                                <img src="" alt="Full Image" id="lightboxImage" />
                                <div class="zoom-controls">
                                <button type="button" id="zoomOut" title="Zoom Out">−</button>
                                <button type="button" id="zoomIn" title="Zoom In">+</button>
                            </div>
                        </div>
                        <div class="lightbox-close-hint">Click outside image to close</div>
                        </div>
                    @else
                        <p>Nothing to show</p>
                    @endif
                </div>
                @php
                   $user_id = request()->segment(4); // '4' is the segment for "27"
                @endphp
                @if (!empty($user->user_document))
                <div style="margin-left: 1rem; margin-top: 1rem; margin-right: 1rem">
                 <div class="row mb-3">
                    <div class="col-xl-6">
                         <label for="input-rounded" class="form-label">Document approval<span
                                class="small text-danger">*</span></label>
                        <a href="{{ route('user.status.update', ['user_id' => $user_id, 'status' => 'verified']) }}" class="btn btn-success me-2">
                Verified
            </a>
            <a href="{{ route('user.status.update', ['user_id' => $user_id, 'status' => 'rejected']) }}" class="btn btn-danger">
                Rejected
            </a>
                   </div>
                </div> 
                @endif

        </div>

            <div class="card-header">
                <div class="">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>

        </div>

    </div>

    </div>

</form>


<script>
  const thumbImage = document.getElementById('thumbImage');
  const lightbox = document.getElementById('lightbox');
  const lightboxImage = document.getElementById('lightboxImage');
  const zoomInBtn = document.getElementById('zoomIn');
  const zoomOutBtn = document.getElementById('zoomOut');

  let scale = 1;
  const scaleStep = 0.1;
  const maxScale = 3;
  const minScale = 0.5;

  thumbImage.addEventListener('click', () => {
    lightboxImage.src = thumbImage.src;
    scale = 1;
    lightboxImage.style.transform = `scale(${scale})`;
    lightbox.style.display = 'flex';
  });

  lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) {
      lightbox.style.display = 'none';
      lightboxImage.src = '';
    }
  });

  zoomInBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    if (scale < maxScale) {
      scale += scaleStep;
      lightboxImage.style.transform = `scale(${scale})`;
    }
  });

  zoomOutBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    if (scale > minScale) {
      scale -= scaleStep;
      lightboxImage.style.transform = `scale(${scale})`;
    }
  });
</script>

@endsection
