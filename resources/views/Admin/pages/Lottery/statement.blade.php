@extends('Admin.layouts.app')

@section('content')

@section('title', 'Purchase Statement')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

<div class="card custom-card">
    <div class="card-body">
        <div class="table-responsive">

            <div class="mb-3">
                <div class="col-xl-12">
                    <label for="input-rounded" class="form-label">Draw Type<span
                            class="small text-danger">*</span></label>
                    <select class="form-control" id="lottery" name="lottery">
                        <option>Select Lottery</option>
                        @foreach ($data as $lottery)
                        <option value={{ $lottery->id }}>{{ $lottery->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="ticket-table-container" style="display: none;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Ticket No.</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="ticket-table-body">
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<script>
    document.getElementById('lottery').addEventListener('change', function() {
    var lotteryId = this.value;

    if (lotteryId === 'Select Lottery') {
        // If "Select Lottery" option is chosen, hide the ticket table container
        document.getElementById('ticket-table-container').style.display = 'none';
        return;
    }

    // Make an AJAX request to fetch the purchased lottery tickets for the selected lottery
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/getLotteryTickets/' + lotteryId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var tickets = JSON.parse(xhr.responseText);
                var tableBody = document.getElementById('ticket-table-body');
                tableBody.innerHTML = '';

                if (tickets.length > 0) {
                    // Populate the table with the fetched ticket data
                tickets.forEach(function(ticket) {
                    var row = '<tr><td>' + ticket.id + '</td><td>' + ticket.user.name +'</td><td>' + ticket.ticket_number +'</td><td>' + ticket.status +'</td></tr>';
                    tableBody.innerHTML += row;
                });
                } else {
                    // If no tickets found, display a message
                    tableBody.innerHTML = '<tr><td colspan="1">No tickets found</td></tr>';
                }


                // Show the ticket table container
                document.getElementById('ticket-table-container').style.display = 'block';
            } else {
                console.error('Error fetching lottery tickets:', xhr.status);
            }
        }
    };
    xhr.send();
});

</script>


@endsection
