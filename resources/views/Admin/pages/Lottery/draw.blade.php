@extends('Admin.layouts.app')

@section('content')

@section('title', 'Manual Draw')

@include('Admin.partials.alerts.success')
@include('Admin.partials.alerts.errors')

<div class="card custom-card">
    <div class="card-body">
        <div class="table-responsive">

            <div class="mb-3">
                <div class="col-xl-12">
                    <label for="input-rounded" class="form-label">Select Lottery<span
                            class="small text-danger">*</span></label>
                    <select class="form-control" id="lottery" name="lottery">
                        <option>Select Lottery</option>
                        @foreach ($data as $lottery)
                        <option value={{ $lottery->id }}>{{ $lottery->name }}</option>

                        @endforeach
                    </select>
                </div>
                <p class="op-7 mt-2">Here you only get the lottery which is available for draw in this date</p>
            </div>

            <div id="ticket-table-container" style="display: none;">
                <a href="" id="draw_ticket"><button class="btn btn-danger mb-2">Draw Now</button></a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Ticket No.</th>
                        </tr>
                    </thead>
                    <tbody id="ticket-table-body">
                    </tbody>


                </table>
            </div>

            <div class="mb-3" id="ticket-grid-container" style="display: none;">
                @if(!$data->isEmpty())
                <button class="btn btn-danger mb-2" id="draw_ticket" onclick="drawNow('{{ $lottery->id }}')">Draw Now</button>
            @endif
                {{-- <button class="btn btn-danger mb-2" id="draw_ticket" onclick="drawNow('{{ $lottery->id }}')">Draw Now</button> --}}

                {{-- <button class="btn btn-danger mb-2" id="draw_ticket">Draw Now</button> --}}
                {{-- <a href="" id="draw_ticket"><button class="btn btn-danger mb-2">Draw Now</button></a> --}}
                <div class="row" id="ticket-grid">
                    <!-- Tickets will be dynamically added here -->
                </div>
            </div>

        </div>
    </div>

</div>


<style>
    .card.selected {
        border: 2px solid blue; /* Add border to selected cards */
    }
</style>

<script>
    var selectedWinners = []; // Array to store selected winners' IDs
    var totalWinners = 0; // Variable to store the total winners allowed

    document.getElementById('lottery').addEventListener('change', function() {
        var lotteryId = this.value;

        if (lotteryId === 'Select Lottery') {
            // If "Select Lottery" option is chosen, hide the ticket grid container
            document.getElementById('ticket-grid-container').style.display = 'none';
            return;
        }

        // Make an AJAX request to fetch the selected lottery data
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/getLottery/' + lotteryId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var lotteryData = JSON.parse(xhr.responseText);
                    totalWinners = parseInt(lotteryData.total_winner);

                    var drawButton = document.getElementById('draw_ticket');
                    drawButton.setAttribute('href', 'javascript:void(0)'); // Prevent default link behavior
                    drawButton.onclick = function() { drawNow(lotteryId); }; // Attach onclick event handler
                    updateDrawButtonState(); // Update draw button state

                    // Make another AJAX request to fetch the purchased lottery tickets for the selected lottery
                    var ticketsXhr = new XMLHttpRequest();
                    ticketsXhr.open('GET', '/getLotteryTickets/' + lotteryId, true);
                    ticketsXhr.onreadystatechange = function() {
                        if (ticketsXhr.readyState === XMLHttpRequest.DONE) {
                            if (ticketsXhr.status === 200) {
                                var tickets = JSON.parse(ticketsXhr.responseText);
                                var ticketGrid = document.getElementById('ticket-grid');
                                ticketGrid.innerHTML = '';

                                if (tickets.length > 0) {
                                    // Populate the grid with the fetched ticket data
                                    tickets.forEach(function(ticket) {
                                        var col = document.createElement('div');
                                        col.className = 'col-md-3';

                                        var card = document.createElement('div');
                                        card.className = 'card mb-3';
                                        card.onclick = function() { toggleSelection(this, ticket.id); }; // Attach onclick event handler

                                        var cardBody = document.createElement('div');
                                        cardBody.className = 'card-body';
                                        cardBody.innerHTML = '<h5 class="card-title">' + ticket.user.name + '</h5>' +
                                            '<p class="card-text">Ticket No.: ' + ticket.ticket_number + '</p>';

                                        card.appendChild(cardBody);
                                        col.appendChild(card);
                                        ticketGrid.appendChild(col);
                                    });
                                } else {
                                    // If no tickets found, display a message
                                    ticketGrid.innerHTML = '<p>No tickets found</p>';
                                }

                                // Show the ticket grid container
                                document.getElementById('ticket-grid-container').style.display = 'block';
                            } else {
                                console.error('Error fetching lottery tickets:', ticketsXhr.status);
                            }
                        }
                    };
                    ticketsXhr.send();
                } else {
                    console.error('Error fetching lottery data:', xhr.status);
                }
            }
        };
        xhr.send();
    });

    function toggleSelection(card, ticketId) {
        var index = selectedWinners.indexOf(ticketId);
        if (index === -1) {
            // Check if the total selected winners exceeds the total winners allowed
            if (selectedWinners.length >= totalWinners) {
                alert('You can only select up to ' + totalWinners + ' winners.');
                return; // Exit the function
            }
            // Add the ticket ID to the selected winners array
            selectedWinners.push(ticketId);
            card.classList.add('selected'); // Add selected class to the card
        } else {
            // Remove the ticket ID from the selected winners array
            selectedWinners.splice(index, 1);
            card.classList.remove('selected'); // Remove selected class from the card
        }

        // Update draw button state
        updateDrawButtonState();
    }

    function updateDrawButtonState() {
        var drawButton = document.getElementById('draw_ticket');
        // if (selectedWinners.length === totalWinners) {
        //     // If the required number of winners are selected, enable the draw button
        //     // alert('You should need to select ' + totalWinners + ' winners');
        // } else {
        //     // If the required number of winners are not selected, disable the draw button
        //     drawButton.disabled = true;
        // }
    }

    function drawNow(lotteryId) {
    if (selectedWinners.length !== totalWinners) {
        alert('Please select ' + totalWinners + ' winners.');
        return;
    }

    // Construct the URL with selected winners as query parameters
    var url = '/admin/lotteries/draw/' + lotteryId + '?winners=' + encodeURIComponent(JSON.stringify(selectedWinners));

    // Redirect to the URL
    window.location.href = url;
}

</script>

<script>
    document.getElementById('lottery').addEventListener('change', function() {
        var selectedLotteryId = this.value;
        console.log(selectedLotteryId); // You can use the selected lottery ID as needed
    });
</script>





@endsection

{{-- <script>
    var selectedWinners = []; // Array to store selected winners' IDs
    var totalWinners = 0; // Variable to store the total winners allowed

    document.getElementById('lottery').addEventListener('change', function() {
        var lotteryId = this.value;

        if (lotteryId === 'Select Lottery') {
            // If "Select Lottery" option is chosen, hide the ticket table container
            document.getElementById('ticket-table-container').style.display = 'none';
            return;
        }

        // Make an AJAX request to fetch the selected lottery data
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/getLottery/' + lotteryId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var lotteryData = JSON.parse(xhr.responseText);
                    totalWinners = parseInt(lotteryData.total_winner);

                    var drawButton = document.getElementById('draw_ticket');
                    drawButton.setAttribute('href', 'javascript:void(0)'); // Prevent default link behavior
                    drawButton.onclick = function() { drawNow(lotteryId); }; // Attach onclick event handler

                    // Make another AJAX request to fetch the purchased lottery tickets for the selected lottery
                    var ticketsXhr = new XMLHttpRequest();
                    ticketsXhr.open('GET', '/getLotteryTickets/' + lotteryId, true);
                    ticketsXhr.onreadystatechange = function() {
                        if (ticketsXhr.readyState === XMLHttpRequest.DONE) {
                            if (ticketsXhr.status === 200) {
                                var tickets = JSON.parse(ticketsXhr.responseText);
                                var tableBody = document.getElementById('ticket-table-body');
                                tableBody.innerHTML = '';

                                if (tickets.length > 0) {
                                    // Populate the table with the fetched ticket data
                                    tickets.forEach(function(ticket) {
                                        var row = '<tr>' +
                                            '<td>' + ticket.id + '</td>' +
                                            '<td>' + ticket.user.name + '</td>' +
                                            '<td>' + ticket.ticket_number + '</td>' +
                                            '<td>' +
                                            '<input type="checkbox" name="winner" value="' + ticket.id + '" onchange="updateSelectedWinners(this)">' +
                                            '</td>' +
                                            '</tr>';
                                        tableBody.innerHTML += row;
                                    });
                                } else {
                                    // If no tickets found, display a message
                                    tableBody.innerHTML = '<tr><td colspan="4">No tickets found</td></tr>';
                                }

                                // Show the ticket table container
                                document.getElementById('ticket-table-container').style.display = 'block';
                            } else {
                                console.error('Error fetching lottery tickets:', ticketsXhr.status);
                            }
                        }
                    };
                    ticketsXhr.send();
                } else {
                    console.error('Error fetching lottery data:', xhr.status);
                }
            }
        };
        xhr.send();
    });

    function updateSelectedWinners(checkbox) {
        var ticketId = checkbox.value;

        // Check if the checkbox is checked
        if (checkbox.checked) {
            // Check if the total selected winners exceeds the total winners allowed
            if (selectedWinners.length >= totalWinners) {
                checkbox.checked = false; // Uncheck the checkbox
                alert('You can only select up to ' + totalWinners + ' winners.');
                return; // Exit the function
            }
            // Add the ticket ID to the selected winners array
            selectedWinners.push(ticketId);
        } else {
            // Remove the ticket ID from the selected winners array
            selectedWinners = selectedWinners.filter(id => id !== ticketId);
        }
    }

    function drawNow(lotteryId) {
        if (selectedWinners.length === 0) {
            alert('Please select at least one winner.');
            return;
        }

        // Construct the URL with selected winners as query parameters
        var url = '/admin/draw/' + lotteryId + '?winners=' + encodeURIComponent(JSON.stringify(selectedWinners));

        // Redirect to the URL
        window.location.href = url;
    }
</script>
 --}}


